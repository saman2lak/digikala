@extends('layouts.layout-cart')
@section('cart')
<div class="container-fluid">
    <div class="row mx-2 my-2 justify-content-center">
        @if(session()->has('ok_msg'))
        <div class="alert alert-success col-md-12 w-100 p-2">{{session()->get('ok_msg')}}</div>
        @endif
        @if(session()->has('err_msg'))
        <div class="alert alert-danger col-md-12 w-100 p-2">{{session()->get('err_msg')}}</div>
        @endif
        @if(count($errors) > 0)
        @foreach($errors->all() as $err)
        <div class="alert alert-danger col-md-12 w-100 p-2">{{$err}}</div>
        @endforeach
        @endif
        <div class="col-md-12 w-100" style="display: contents">
            <div class="dk_card col-md-9 p-2">
                <form action="{{route('checkout.store')}}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="name" class="form-control col-md-6 mb-2"
                            placeholder="نام و نام خانوادگی خود را وارد نمایید">
                    </div>
                    <div class="input-group">
                        <input type="text" name="zipcode" class="form-control col-md-6 mb-2"
                            placeholder="کد پستی خود را وارد نمایید">
                    </div>
                    <div class="input-group">
                        <input type="text" name="phone" class="form-control col-md-6 mb-2"
                            placeholder="شماره تماس خود را وارد نمایید">
                    </div>
                    <div class="input-group">
                        <textarea name="address" class="form-control col-md-6 mb-2" cols="10" rows="10"
                            placeholder="آدرس خود را وارد نمایید"></textarea>
                    </div>
                    <div class="input-group">
                        <button type="submit" class="btn btn-success">پرداخت</button>
                    </div>
                </form>

                <hr>

                <div>سبد خرید شما</div>
                <table class="table-hover dk_card_table w-100 text-center">
                    <thead>
                        <tr>
                            <th scope="col">تصویر</th>
                            <th scope="col">نام</th>
                            <th scope="col">تعداد</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Cart::content() as $row)
                        <tr>
                            <td scope="col">
                                <a href="{{route('product.show',$row->model->slug)}}">
                                    {{-- <img class="card-img-top align-self-center" src="{{asset("storage/".$row->model->image)}}"
                                    alt="Card image cap"> --}}
                                    <img class="card-img-top align-self-center"
                                        src="{{productImage($row->model->image)}}" alt="Card image cap">
                                </a>
                            </td>
                            <td scope="col">{{$row->model->name}}</td>

                            <td scope="col"">
                                {{$row->qty}}

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class=" dk_card col-md-3 p-2">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">جمع کل سبد خرید</th>
                                            <td>{{$newSubTotal}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">مالیات</th>
                                            <td>{{$newTax}}</td>
                                        </tr>
                                        <tr class="text-primary">
                                            <th scope="row"> مجموع</th>
                                            <td>{{$newTotal}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                @if(session()->has('coupon'))
                                <table class="table text-danger">
                                    <tbody>
                                        <tr>
                                            <th scope="row">کد تخفیف</th>
                                            <td>
                                                @if (isset(session()->get('coupon')['code']))
                                                <span>{{session()->get('coupon')['code']}}</span>
                                                @endif

                                                <form action="{{route('coupon.delete')}}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn" type="submit">
                                                        <i class="fas fa-eraser" data-toggle="tooltip"
                                                            data-placement="top" title="پاک کردن کد تخفیف"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"> مقدار تخفیف</th>
                                            <td>{{$discount}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                @else
                                <div>
                                    <form action="{{route('coupon.store')}}" method="POST">
                                        @csrf
                                        <input class="input w-75" type="text" placeholder="کد تخفیف" name="coupon_code"
                                            style="line-height: 33px;">
                                        <button class="btn btn-success" type="submit">ثبت</button>
                                    </form>
                                </div>
                                @endif
                                <div>
                                    مقدار قابل پرداخل
                                    <span>{{ $newTotal }}</span>
                                </div>

            </div>

        </div>
    </div>
</div>
@endsection
