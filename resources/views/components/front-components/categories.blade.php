<div class="menu-list">
    <ul id="menu-content2" class="menu-content collapse out">
        @foreach ($categories as $category)
            @php
                $randomId = mt_rand(1000, 9999);
                $randomChars = chr(mt_rand(97, 122)) . chr(mt_rand(97, 122));
                $randomGeneratedId = $randomChars . $randomId;
            @endphp
            <li data-toggle="collapse" data-target="#{{ $randomGeneratedId }}" class="collapsed">
                <a
                    href="{{ $category->children->count() > 0 ? '#' : route('filter.by.category', ['id' => $category->id]) }}">{{ $category->name }}<span
                        class="{{ $category->children->count() > 0 ? 'arrow' : '' }}"></span></a>
                @if ($category->children->count() > 0)
                    <ul class="sub-menu collapse" id="{{ $randomGeneratedId }}">
                        @foreach ($category->children as $child)
                            <li><a
                                    href="{{ route('filter.by.category', ['id' => $child->id]) }}">{{ $child->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>
