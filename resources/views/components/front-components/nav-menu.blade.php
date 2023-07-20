{{-- початок компоненту навігаційного меню в header частині --}}
@foreach ($navItems as $navItem)
<li class="nav-item dropdown">
    <a class="nav-link {{ $navItem->getSubItem->count() > 0 ? 'dropdown-toggle' : '' }}"
        href="#" id="karlDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">{{ $navItem->title }}</a>{{-- //делаем роут с передачей title и id пункута меню. --}}

    @if ($navItem->getSubItem->count() > 0)
        <div class="dropdown-menu" aria-labelledby="karlDropdown">

            @foreach ($navItem->getSubItem as $item)
                <a class="dropdown-item"
                    href="index.html">{{ $item->title }}</a>{{-- //делаем роут с передачей title и id пункута меню. --}}
            @endforeach
        </div>
    @endif
</li>
@endforeach
{{-- кінець компоненту навігаційного меню в header частині --}}