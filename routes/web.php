<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\SaveForLaterController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();
Route::get('/',[LandingPageController::class, 'index'])->name('landing_page');

Route::get('/products',[ShopController::class, 'index'])->name('products');
Route::get('/product/{product}',[ShopController::class, 'show'])->name('product.show');

Route::get('/cart',[CartController::class, 'index'])->name('cart.index');
Route::post('/cart',[CartController::class, 'store'])->name('cart.store');
Route::get('/cart/empty',[CartController::class, 'emptyCart'])->name('cart.empty');
Route::delete('/cart/{product}',[CartController::class, 'destroy'])->name('cart.remove');
Route::put('/cart/{product}',[CartController::class, 'update'])->name('cart.update');

Route::post('/cart/saveForLater/{product}',[SaveForLaterController::class, 'saveForLater'])->name('cart.saveForLater');
Route::delete('/cart/saved/{product}',[SaveForLaterController::class, 'destroySaved'])->name('cart.remove.saved');
Route::post('/cart/switchToCart/{product}',[SaveForLaterController::class, 'switchToCart'])->name('cart.switchToCart');

Route::post('/coupon',[CouponController::class, 'store'])->name('coupon.store');
Route::delete('/coupon',[CouponController::class, 'destroy'])->name('coupon.delete');

Route::get('/checkout',[CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth');
Route::post('/checkout',[CheckoutController::class, 'store'])->name('checkout.store')->middleware('auth');
Route::get('/checkout/callback',[CheckoutController::class, 'callback'])->name('checkout.callback')->middleware('auth');
Route::get('/checkout/successfull/{refid}',[CheckoutController::class, 'successfull'])->name('checkout.successfull')->middleware('auth');
