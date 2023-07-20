  {{-- компонент sidebar categories --}}
  @foreach ($categories as $category)
  <li data-toggle="collapse" data-target="#{{ Str::slug($category->name) }}" class="collapsed">
      {{-- <a href="#">Woman wear <span class="arrow"></span></a> --}}
      <a href="{{ $category->children->count() > 0 ? '#' : 'http://some.url' }}">{{ $category->name }}<span
              class="{{ $category->children->count() > 0 ? 'arrow' : '' }}"></span></a>{{-- //делаем роут с передачей title и id пункута меню. --}}
      @if ($category->children->count() > 0)
          <ul class="sub-menu collapse" id="{{ Str::slug($category->name) }}">
              @foreach ($category->children as $child)
                  <li><a href="https://www.facebook.com/home.php">{{ $child->name }}</a></li>
                  {{-- //делаем роут с передачей title и id пункута меню. --}}
              @endforeach
          </ul>
      @endif
  </li>
@endforeach
{{-- кінець компоненту sidebar categories --}}