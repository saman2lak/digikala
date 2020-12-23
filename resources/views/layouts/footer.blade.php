<ul class="p-0">
    @foreach($items as $menu_item)
    <li class="my-2">
        <a class="text-light" href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a>
    </li>
    @endforeach
</ul>
