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
        @if(Cart::count() > 0)
        <div class="col-md-12 w-100" style="display: contents">
            <div class="dk_card col-md-9 p-2">
                <table class="table-hover dk_card_table w-100 text-center">
                    <thead>
                        <tr>
                            <th scope="col">تصویر</th>
                            <th scope="col">نام</th>
                            <th scope="col">جزئیات</th>
                            <th scope="col">قیمت</th>
                            <th scope="col">تعداد</th>
                            <th scope="col">عملیات</th>
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
                            <td scope="col">{{$row->model->slug}}</td>
                            <td scope="col">{{$row->model->presentPrice($row->model->price)}}</td>
                            <td scope="col"">
                                        <form action=" {{route('cart.update',$row->rowId)}}" method="post">
                                @csrf
                                @method('put')
                                <div class="quantity">
                                    <input type="number" name="qty_number" step="1" min="0" value="{{$row->qty}}"">
                                            </div>
                                            <button type=" submit" class="btn">بروزرسانی تعداد</button>
                                    </form>

                            </td>
                            <td scope="col">
                                <form action="{{route('cart.remove',$row->rowId)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn" type="submit" data-toggle="tooltip" data-placement="top"
                                        title="حذف سبد خرید">
                                        <i class="fas fa-trash-alt text-danger" style="font-size: 25px"></i>
                                    </button>
                                </form>
                                <form action="{{route('cart.saveForLater',$row->rowId)}}" method="post">
                                    @csrf
                                    <button class="btn" type="submit" data-toggle="tooltip" data-placement="top"
                                        title="ذخیره سبد خرید">
                                        <i class="fas fa-save text-info" style="font-size: 25px"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="dk_card col-md-3 p-2">
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

                                <form action="{{route('coupon.delete')}}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn" type="submit">
                                        <i class="fas fa-eraser" data-toggle="tooltip" data-placement="top"
                                            title="پاک کردن کد تخفیف"></i>
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
                <a href="{{route('checkout.index')}}" class="btn btn-success">مرحله بعدی</a>
            </div>

            @include('layouts.layout-saveForLaterCart')

        </div>
        @else
        <div class="col-md-12 w-100 text-center" style="display: contents">
            <div class="dk_card col-md-8 p-2">
                <div class="p-3">
                    <i class="far fa-surprise fa-7x" style="opacity: 0.8"></i>
                </div>
                <div class="p-3">سبد خرید شما خالی است</div>

                @include('layouts.layout-saveForLaterCart')

            </div>
        </div>

        @endif
    </div>
</div>
@endsection
