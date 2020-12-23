<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Zarinpal\Zarinpal;
use SoapClient;

class CheckoutController extends Controller
{

    public function store(Request $request)
    {
        $insertedShipping = Shipping::create($request->all());

        // generate product ids for order table
        $product_ids= array();
        foreach (Cart::instance('default')->content() as $product) {
            array_push($product_ids,$product->id);
        }

        // save order
        $ifExistOrder = Order::where([
            'user_id'=>auth()->user()->id,
            'status'=>'pending'
        ])->first();
        if ($ifExistOrder) {
            // update existance order
            $ifExistOrder->shipping_id=$insertedShipping->id;
            $ifExistOrder->product_ids=json_encode($product_ids);
            $ifExistOrder->save();

        }else {
            Order::create([
            'user_id'=>auth()->user()->id,
            'shipping_id'=>$insertedShipping->id,
            'payment_id'=>0,
            'status'=>'pending',
            'product_ids'=>json_encode($product_ids),
            ]);
        }

        $this->ZarinPalDoPay();
    }


    public function ZarinPalDoPay(){
        $MerchantID = '1646f288-49c9-11e6-a153-005056a205be';
        $Description = 'توضیحات تراکنش تستی'; // Required
        $Email = auth()->user()->email; // Optional
        $CallbackURL = url(route('checkout.callback'));// Required

        $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $this->getNumbers()->get('newTotal'),
                'Description' => $Description,
                'Email' => $Email,
                'CallbackURL' => $CallbackURL,
            ]
        );

        //Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {
            $ifExist = Payment::where([
                'session_id'=>session()->getId(),
                'status'=>'pending'
                ])->first();

              if ($ifExist) {
                  $ifExist->price = $this->getNumbers()->get('newTotal');
                  $ifExist->authority = $result->Authority;
                  $ifExist->status = 'pending';
                  $ifExist->refid=0;
                  $ifExist->save();
              }else {
                $payment = Payment::create([
                  'authority'=>$result->Authority,
                  'price'=>$this->getNumbers()->get('newTotal'),
                  'status'=>'pending',
                  'refid'=>0,
                  'session_id'=>session()->getId(),
                ]);
              }
            // Header('Location: https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority);
            return redirect()->to('https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority)->send();
        } else {
            echo 'ERR: ' . $result->Status;
        }
    }


    public function callback(){
        $Authority = request('Authority');
        $MerchantID = '1646f288-49c9-11e6-a153-005056a205be';
        $price = Payment::where('session_id',session()->getId())->first()->price;
        if (request('Status') == 'OK') {

            $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $price,
                ]
            );
            if ($result->Status == 100) {
                $successPay = Payment::where('session_id',session()->getId())->first();
                $payment_id = $successPay->id;
                $successPay->status = 'complete';
                $successPay->refid =$result->refID;
                $successPay->save();

                //update order table to complete
                $ifExistOrder = Order::where([
                'user_id'=>auth()->user()->id,
                'status'=>'pending'
                ])->first();
                if ($ifExistOrder) {
                $ifExistOrder->status='complete';
                $ifExistOrder->payment_id = $payment_id;
                $ifExistOrder->save();
                }
                  // empty cart
                Cart::instance('default')->destroy();
                return redirect()->route('checkout.successfull',$result->RefID);

            } else {
                echo 'Transaction failed. Status:'.$result->Status;
            }
        } else {
            echo 'Transaction canceled by user';
        }


    }

    public function successfull($refid=0)
    {
      //
      $categories = Category::all();
      //
      return view('checkout_success')->with([
          'categories'=>$categories,
          'refid'=>$refid,
      ]);
    }

    private function getNumbers(){
        $tax = config('cart.tax')/100;
        $discount = session()->get('coupon')['discount'] ??0;
        $newSubTotal = Cart::subtotal(0,'.','') - $discount;
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


    public function index()
    {
        $categories = Category::all();
        $discount = $this->getNumbers()->get('discount');
        $newTotal = $this->getNumbers()->get('newTotal');
        $newTax = $this->getNumbers()->get('newTax');
        $newSubTotal = $this->getNumbers()->get('newSubTotal');
        return view('checkout',compact('categories','discount','newTotal','newTax','newSubTotal'));
    }







}