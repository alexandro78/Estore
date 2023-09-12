<div class="menu-list">
    <ul id="menu-content2" class="menu-content collapse out">
        @foreach ($categories as $category)
            @php
                $randomId = mt_rand(1000, 9999);
                $randomChars = chr(mt_rand(97, 122)) . chr(mt_rand(97, 122));
                $randomGeneratedId = $randomChars . $randomId;
            @endphp
            <li data-toggle="collapse" data-target="#{{ $randomGeneratedId }}" class="collapsed">
                @if ($category->children->count() > 0)
                    <a href="#">{{ $category->name }}<span
                            class="{{ $category->children->count() > 0 ? 'arrow' : '' }}"></span></a>
                @else
                    <a wire:click="$emit('clickedOnCategory', {{ $category->id }})" href="#">{{ $category->name }}<span
                            class="{{ $category->children->count() > 0 ? 'arrow' : '' }}"></span></a>
                @endif
                @if ($category->children->count() > 0)
                    <ul class="sub-menu collapse" id="{{ $randomGeneratedId }}">
                        @foreach ($category->children as $child)
                            <li>
                                <a wire:click="$emit('clickedOnCategory', {{ $child->id }})" href="#">{{ $child->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</div>



