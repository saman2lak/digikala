@extends('layouts.layout-cart')
@section('cart')
<div class="container-fluid">
    <div class="row mx-2 my-2 justify-content-center">
        <div class="col-md-12 w-100" style="display: contents">
            <div class="dk_card col-md-9 p-2" style="min-height: 300px;">
                سفارش شما با موفقیت ثبت شد
                رسید پرداخت شما {{$refid}}
            </div>
        </div>
    </div>
</div>
@endsection
