<div>

    <div class="widget price mb-50">
        <h6 class="widget-title mb-30">Filter by Price</h6>
        <div class="widget-desc">
            <div class="slider-range">
                <div data-min="0" data-max="10000" data-unit="$"
                    class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                    data-value-min="0" data-value-max="7000" data-label-result="Price:">
                    <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                </div>
                <div class="range-price">Price: 0 - 10000 </div>
            </div>
        </div>
    </div>

    <div class="widget color mb-70">
        <h6 class="widget-title mb-30">Filter by Color</h6>
        <div class="widget-desc">
            <ul class="d-flex justify-content-between">
                @foreach ($products as $product)
                    <li class="{{ $product->color_code }}"><a class="color-link"
                            data-color-code="{{ $product->color_code }}"
                            href="#"><span>({{ $product->count }})</span></a></li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="widget size mb-50">
        <h6 class="widget-title mb-30">Filter by Size</h6>
        <div class="widget-desc">
            <ul class="d-flex justify-content-between">
                <li><a class="size-link" href="#">XS</a></li>
                <li><a class="size-link" href="#">S</a></li>
                <li><a class="size-link" href="#">M</a></li>
                <li><a class="size-link" href="#">L</a></li>
                <li><a class="size-link" href="#">XL</a></li>
                <li><a class="size-link" href="#">XXL</a></li>
                <li><a class="size-link" href="#">XXXL</a></li>
            </ul>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            const colorLinks = document.querySelectorAll('.color-link');
            const sizeLinks = document.querySelectorAll('.size-link');

            // Добавляем обработчик события при клике для каждой ссылки
            colorLinks.forEach(function(colorlink) {
                colorlink.addEventListener('click', function(event) {
                    event.preventDefault(); // Предотвращаем переход по ссылке

                    const colorCode = this.getAttribute('data-color-code');
                    const data = {
                        color: colorCode,
                    };

                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '/color-filter');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText);
                            console.log('Ссылка была кликнута');
                        }
                    };
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.send(JSON.stringify(data));
                    Livewire.emit('updateFilter');
                });
            });

            sizeLinks.forEach(function(sizelink) {
                sizelink.addEventListener('click', function(event) {
                    event.preventDefault(); // Предотвращаем переход по ссылке
                    console.log(777777);
                    const sizeValue = this.textContent; // Получить значение элемента размера (например, "XS", "S" и т.д.)
                    console.log(sizeValue);

                    const data = {
                        size: sizeValue,
                    };

                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '/size-filter');
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            console.log(xhr.responseText);
                            console.log('Ссылка размера была кликнута');
                        }
                    };
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.send(JSON.stringify(data));
                    Livewire.emit('updateFilter');
                });
            });
        })
    </script>
</div>
