@if(Cart::instance('saveForLater')->count() !=0)


    <div class="dk_card col-md-8 mt-3 p-2 ">
    <div class="border-bottom border-info w-100">سبد خرید ذخیره شده</div>

    <table class="table-hover dk_card_table w-100 text-center mt-3">
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
        @foreach(Cart::instance('saveForLater')->content() as $row)
            <tr>
                <td scope="col">
                    <a href="{{route('product.show',$row->model->slug)}}">
                        <img class="card-img-top align-self-center"
                             src="{{asset("images/11.png")}}"
                             alt="Card image cap">
                    </a>
                </td>
                <td scope="col">{{$row->model->name}}</td>
                <td scope="col">{{$row->model->slug}}</td>
                <td scope="col">{{$row->model->price}}</td>
                <td scope="col">
                    <form action="{{route('cart.update',$row->rowId)}}" method="post">
                        @csrf
                        @method('put')
                        <span class="input-number-decrement">–</span>
                        <input class="input-number" name="qty_number" type="text"
                               value="{{$row->qty}}" min="0" max="100">
                        <span class="input-number-increment">+</span>
                        <button type="submit" class="btn">بروزرسانی تعداد</button>
                    </form>

                </td>
                <td scope="col" class="d-flex">
                    <form action="{{route('cart.remove.saved',$row->rowId)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn" type="submit">
                            <i class="fas fa-trash-alt text-danger" style="font-size: 25px"></i>
                        </button>
                    </form>
                    <form action="{{route('cart.switchToCart',$row->rowId)}}" method="post">
                        @csrf
                        <button class="btn" type="submit" data-toggle="tooltip" data-placement="top" title="اضافه کردن به سبد خرید">
                            <i class="fas fa-cart-plus text-success" style="font-size: 25px"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endif
