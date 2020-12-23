<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class SaveForLaterController extends Controller
{

    public function saveForLater($id)
    {
        $isExist = Cart::search(function ($cartItem,$rowId)use ($id){
            return $rowId === $id;
        });
        if($isExist->isNotEmpty()){
            $item = Cart::get($id);
            Cart::instance('saveForLater')->add($item->id,$item->name, 1,$item->price)->associate(Product::class);
            Cart::instance('default')->remove($id);
            return redirect(route('cart.index'))->with('ok_msg','محصول به لیست ذخیره ها اضافه شد.');
        }
    }

    public function destroySaved($id)
    {
        Cart::instance('saveForLater')->remove($id);
        return redirect(route('cart.index'))->with('ok_msg','محصول از لیست ذخیره ها پاک شد.');
    }

    public function switchToCart($id)
    {
        $item = Cart::instance('saveForLater')->get($id);
        Cart::instance('saveForLater')->remove($id);
        $isExist = Cart::instance('default')->search(function ($cartItem,$rowId)use ($id){
            return $rowId === $id;
        });
        if($isExist->isNotEmpty()){
            return redirect(route('cart.index'))->with('ok_msg','سبد خرید از قبل وجود دارد.');
        }else{
            Cart::instance('default')->add($item->id,$item->name, 1,$item->price)->associate(Product::class);
            return redirect(route('cart.index'))->with('ok_msg','سبد خرید به سبد پیش فرض اضافه شد.');
        }
    }
}
