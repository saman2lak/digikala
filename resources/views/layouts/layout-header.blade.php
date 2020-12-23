<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand" href="{{route('landing_page')}}">
        <img src="/storage/{{setting('site.logo')}}" alt="" width="100px">
    </a>
    <form class="form-inline my-2 my-lg-0 col-md-6 position-relative">
        <input class="form-control mr-sm-2 w-100" type="search" placeholder="لطفا نام محصول را برای جستجو وارد نمایید"
            aria-label="Search">
        <button class="btn btn-danger my-2 my-sm-0 position-absolute rounded-0"
            style="left: 15px;height: 100%;width: 8%;" type="submit">
            <i class="fas fa-search" style="font-size: 25px"></i>
        </button>
    </form>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                @guest
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    ورود / ثبت نام
                    <i class="fas fa-chevron-down mr-3"></i>
                </a>
                @else
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    {{auth()->user()->name}} عزیز خوش آمدید
                    <i class="fas fa-chevron-down mr-3"></i>
                </a>
                @endguest
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <ul class="p-0 text-right">
                        @guest
                        <li class="list-unstyled dropdown-item p-1">
                            <a class="btn btn-info w-100" href="{{route('login')}}">ورود به سایت</a>
                        </li>
                        <li class="list-unstyled dropdown-item">
                            <span class="ml-1">کاربر جدید هستید؟</span><a class="text-info"
                                href="{{route('register')}}">ثبت نام</a>
                        </li>
                        @else
                        <li class="list-unstyled dropdown-item">
                            <a class="text-info" href="">لیست سفارشات</a>
                        </li>
                        <li class="list-unstyled dropdown-item">
                            <a class="text-info" href="{{route('logout')}}">خروج</a>
                        </li>
                        @endguest
                        <div class="dropdown-divider"></div>
                        <li class="list-unstyled dropdown-item p-0">

                            <a href="" class="text-dark d-block m-1">
                                <i class="far fa-user" style="font-size: 25px;margin-right: 20px;"></i>
                                <span class="mr-1" style="font-size: 17px">پروفایل</span>
                            </a>
                        </li>
                        <li class="list-unstyled dropdown-item p-0 m-1">
                            <a href="" class="text-dark d-block">
                                <i class="fas
                                  fa-shopping-basket" style="font-size: 23px;margin-right: 17px;"></i>
                                <span class="mr-1" style="font-size: 17px">پیگیری سفارش</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item mr-2">
                <a class="btn btn-outline-info" href="{{route('cart.index')}}">
                    <i class="fa fa-shopping-bag" style="font-size: 20px"></i>
                    <span class="pl-5 text-right">سبد خرید</span>
                    <span class="text-white rounded-circle bg-info" style="padding: 1px 9px 0px 9px;">
                        @if(Cart::instance('default')->count() > 0)
                        {{Cart::instance('default')->count()}}
                        @else
                        0
                        @endif
                    </span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<ul class="dk_manu nav bg-secondary">
    @foreach($categories as $cate)
    <li class="nav-item">
        <a class="nav-link" href="{{route('products',['category'=>$cate->slug])}}">{{$cate->name}}</a>
    </li>
    @endforeach


</ul>
