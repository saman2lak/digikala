@extends('layouts.layout-product')
@section('product_details')
<div class="container-fluid">
    <div class="dk_product row bg-white">
        <div class="col-md-4 pt-2 pb-2">
            {{-- <img src="{{asset("images/11.png")}}" width="300px"> --}}
            <div class="text-center">
                <img src="{{productImage($product->image)}}" width="300px" height="300px" style="object-fit: cover;"
                    id="currentImg">
            </div>
            <div class="product_images_section row justify-content-center">
                @if ($product->images)
                @foreach (json_decode($product->images) as $row)
                <div class="product_images_thumb">
                    <img class="product_images_thumb_img" src="{{asset("storage/".$row)}}" alt=""
                        v-on:click="imgGallery">
                </div>
                @endforeach
                @endif

            </div>
        </div>
        <div class="col-md-5 pt-2 pb-2">
            <div>{{$product->name}}</div>
            <small class="small">{{$product->details}}</small>
            <hr>
            <div>{{$product->presentPrice($product->price)}}</div>
            <form action="{{route('cart.store')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$product->id}}">
                <input type="hidden" name="name" value="{{$product->name}}">
                <input type="hidden" name="price" value="{{$product->price}}">
                <button type="submit" class="btn btn-info">
                    <i class="fas fa-shopping-bag"></i>
                    افزودن به سبد خرید
                </button>
            </form>
        </div>
        <div class="col-md-3 pt-2 pb-2">
            <ul>
                <li class="pb-1">ویژگی های محصول:</li>
                @foreach($features as $row)
                <li>
                    <small>
                        {{$row->name}} : {{$row->value}}
                    </small>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="dk_product bg-white" style="color:#5d5d5d !important;">
        <ul class="dk_product_navTab nav nav-tabs p-0" id="myTab" role="tablist" style="background: #f3f3f3;">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">
                    <i style="font-size: 25px;" class="fas fa-glasses"></i>
                    نقد و بررسی
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">
                    <i style="font-size: 25px;" class="fas fa-list-ul"></i>
                    مشخصات
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">
                    <i style="font-size: 25px;" class="far fa-comments"></i>
                    نظرات کاربران
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about"
                    aria-selected="false">
                    <i style="font-size: 25px;" class="far fa-question-circle"></i>
                    پرسش و پاسخ
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    <div class="col-md-8">
                        <p class="p-3 text-justify">
                            111
                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                            چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی
                            تکنولوژی
                            مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه
                            درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت
                            بیشتری
                            را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در
                            این
                            صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان
                            رسد
                            وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                            اساسا مورد استفاده قرار گیرد.
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="/images/naghd section icon.svg" class="p-4" alt="">
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <p class="p-3">
                    222
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                    چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی
                    مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه
                    درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری
                    را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این
                    صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد
                    وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                    اساسا مورد استفاده قرار گیرد.
                </p>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <p class="p-3">
                    333
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                    چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی
                    مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه
                    درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری
                    را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این
                    صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد
                    وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                    اساسا مورد استفاده قرار گیرد.
                </p>
            </div>
            <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="contact-tab">
                <p class="p-3">
                    444
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                    چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی
                    مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه
                    درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری
                    را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این
                    صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد
                    وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                    اساسا مورد استفاده قرار گیرد.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <div class="dk_product bg-white p-4" style="color:#5d5d5d !important;">
        <div>محصولاتی که ممکن است خوشتان بیاید</div>
        <hr>
        <div class="col-md-12 w-100 " style="display: flex">
            @foreach($mightAlsoLike as $productLike)
            <a href="{{route('product.show',$productLike->slug)}}" class="col-md-12  " style="display: contents">
                <div class="card col-md-3 text-center border-0 hvr-float ">
                    <img class="card-img-top align-self-center" src="{{asset("images/11.png")}}" alt="Card image cap">
                    {{--<img class="card-img-top align-self-center" src="{{asset("images/".$productLike->slug.".png")}}"
                    alt="Card image cap">--}}
                    <div class="card-body">
                        <h5 class="card-title text-secondary">{{$productLike->name}}</h5>
                        <p class="card-text">{{$productLike->presentPrice($productLike->price)}} تومان</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('extraJs')
<script>
    // (function(){
    //     const currentImg = document.querySelector("#currentImg");
    //     const images = document.querySelectorAll(".product_images_thumb");
    //     images.forEach((element)=>element.addEventListener('click',function(e){
    //         currentImg.src = this.querySelector("img").src;
    //         images.forEach((element)=>element.classList.remove("selected"));
    //         this.classList.add("selected");
    //     }));

    // })();

        // $('.product_images_thumb').click(function() {
        // $(".product_images_thumb").removeClass("selected");
        // var id = $('img', this).attr('src');
        // $("#currentImg").attr("src",id);
        // $(this).addClass("selected");
        // });

</script>
@endsection
