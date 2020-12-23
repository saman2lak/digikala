<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feature;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get Products
        $categories = Category::all();
        if(request()->category){
            // $products = Product::with('categories')->whereHas('categories',function($query){
            $products = Product::whereHas('categories',function($query){
                $query->where('slug',request()->category);
            });
            $category_name= $categories->where('slug',request()->category)->first()->name;
        }else{
            $products = Product::inRandomOrder();
            $category_name= 'همه محصولات';
        }

        //Sort Products
        if(request()->sort =='low_high'){
            $products = $products->orderBy('price');
        }elseif (request()->sort =='high_low'){
            $products = $products->orderBy('price','desc');
        }

        $products = $products->paginate(8);

        return view('products',compact('products','categories','category_name'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //show one product
        $product = Product::where('slug',$slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug','!=',$slug)->take(4)->get();
        $categories = Category::all();
        $features = $product->features()->get();
        return view('product',compact('product','mightAlsoLike','categories','features'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
