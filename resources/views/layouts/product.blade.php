<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-md-12 w-100" style="display: contents">
            @foreach($products as $product)
            <a href="{{route('product.show',$product->slug)}}" class="col-md-12  " style="display: contents">
                <div class="card col-md-3 text-center border-0 hvr-float ">
                    {{-- <img class="card-img-top align-self-center" src="{{asset("images/11.png")}}" alt="Card image
                    cap"> --}}
                    <img class="card-img-top align-self-center" src="{{productImage($product->image)}}"
                        alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title text-secondary">{{$product->name}}</h5>
                        <p class="card-text">{{$product->presentPrice($product->price)}} تومان</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
