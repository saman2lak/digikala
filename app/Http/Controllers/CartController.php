<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{

    private function getNumbers(){
        $tax = config('cart.tax')/100;
        $discount = session()->get('coupon')['discount'] ??0;
        $newSubTotal = Cart::subtotal(2,'.','')- $discount;
        $newTax = $newSubTotal * $tax;
        $newTotal = $newSubTotal * (1+$tax);

        // dd($newSubTotal);

        return collect([
            'tax'=>$tax,
            'discount'=>$discount,
            'newSubTotal'=>$newSubTotal,
            'newTax'=>$newTax,
            'newTotal'=>$newTotal,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        // if(session()->has('coupon')){
        //     $discount = $this->getNumbers()->get('discount');
        //     $newTotal = $this->getNumbers()->get('newTotal');
        //     $newTax = $this->getNumbers()->get('newTax');
        //     $newSubTotal = $this->getNumbers()->get('newSubTotal');
        // }else{
        //     $discount = 0;
        //     $newTotal = $this->getNumbers()->get('newTotal');
        //     $newTax = $this->getNumbers()->get('newTax');
        //     $newSubTotal = $this->getNumbers()->get('newSubTotal');
        // }
        $discount = $this->getNumbers()->get('discount');
        $newTotal = $this->getNumbers()->get('newTotal');
        $newTax = $this->getNumbers()->get('newTax');
        $newSubTotal = $this->getNumbers()->get('newSubTotal');
        return view('cart',compact('categories','discount','newTotal','newTax','newSubTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isExist = Cart::instance('default')->search(function ($cartItem,$rowId)use ($request){
            return $cartItem->id === $request->id;
        });
        if($isExist->isNotEmpty()){
            return redirect(route('cart.index'))->with('ok_msg','محصول از قبل در سبد خرید وجود دارد.');
        }else{
            Cart::add($request->id,$request->name, 1,$request->price)->associate(Product::class);
            return redirect(route('cart.index'))->with('ok_msg','محصول با موفقیت اضافه شد.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'qty_number' => 'required|numeric|between:1,10'
        ]);
        if($validator->fails()){
            return back()->with('err_msg','تعداد کالا باید کمتر از 10 عدد انتخاب شود');
        }
        Cart::instance('default')->update($id, $request->qty_number); // Will update the quantity
        return back()->with('ok_msg','محصول با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('ok_msg','محصول با موفقیت از سبد خرید پاک شد');
    }

    public function emptyCart()
    {
        Cart::destroy();
    }
}
