<div class="main-menu-area">
    <nav class="navbar navbar-expand-lg align-items-start">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#karl-navbar"
            aria-controls="karl-navbar" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"><i class="ti-menu"></i></span></button>

        <div class="collapse navbar-collapse align-items-start collapse" id="karl-navbar">
            <ul class="navbar-nav animated" id="nav">
                @foreach ($navItems as $navItem)
                    @if ($navItem->getSubItem->count() > 0)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                                href="{{ Route::has($navItem->route) ? route("$navItem->route") : '#' }}"
                                id="karlDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">{{ $navItem->title }}</a>
                            @foreach ($navItem->getSubItem as $item)
                                <div class="dropdown-menu" aria-labelledby="karlDropdown">
                                    <a id="check-active-item"
                                        class="dropdown-item {{ Route::currentRouteName() == $item->route ? 'active-inner-nav-item' : '' }}"
                                        href="{{ Route::has($item->route) ? route("$item->route") : '#' }}">{{ $item->title }}</a>
                                </div>
                            @endforeach
                        </li>
                    @else
                        <li class="nav-item active"><a
                                class="nav-link  {{ Route::currentRouteName() == $navItem->route ? 'active-nav-item' : '' }}"
                                href="{{ Route::has($navItem->route) ? route("$navItem->route") : '#' }}">{{ $navItem->title }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </nav>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Find the item with the id "check-active-item"
        var checkActiveItem = document.getElementById("check-active-item");

        // Check if the "active-nav-item" class is present in the element
        if (checkActiveItem && checkActiveItem.classList.contains("active-inner-nav-item")) {
            // Find the element with the class "nav-link dropdown-toggle"
            var dropdownToggle = document.querySelector(".nav-link.dropdown-toggle");

            // If the item is found, add the class "active-nav-item"
            if (dropdownToggle) {
                dropdownToggle.classList.add("active-nav-item");
            }
        }
    });
</script>
