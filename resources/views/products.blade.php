@extends('layouts.layout-landing')
@section('contents')
<div class="col-md-4 mt-2">
    <h4 class="border-bottom border-danger pb-2">{{$category_name}}</h4>
    <div>

        {{-- {{ dd(request()->input())}} --}}
        <span>مرتب سازی بر اساس:</span>
        <a class="btn btn-outline-info"
            href="{{route('products',['category'=>request()->category,'sort'=>'low_high','page'=>$products->currentPage()])}}">ارزانترین</a>
        <a class="btn btn-outline-info"
            href="{{route('products',['category'=>request()->category,'sort'=>'high_low','page'=>$products->currentPage()])}}">گرانترین</a>
    </div>
</div>

@include('layouts.product')
<div class="col-md-12">
    {{ $products->appends(request()->input())->links('vendor.pagination.default') }}
</div>
<style>
    .pagination li {
        padding: 10px;
    }
</style>
@endsection
