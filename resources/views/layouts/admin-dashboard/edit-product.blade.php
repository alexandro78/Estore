@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/backend-style.css') }}">
@stop
@section('content_header')
    <h1>Редагувати товар</h1>
@stop

@section('content')

    @php
        $config = [
            'height' => '170',
            'toolbar' => [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
        ];
    @endphp
    <form method="POST" action="{{ route('send.edit.product', ['id' => $id]) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <x-adminlte-input name="item_name" type="text" value="{{ $productFields->name }}" label="Назва"
                        fgroup-class="col-md-12" />
                </div>
                <div class="col-sm-2">
                    <x-adminlte-select name="item_size" label="Розмір">
                        <option
                            value="{{ $sizeValueName = $productFields->size == null ? 'Не вказано' : $productFields->size->size }}">
                            {{ $sizeName = $productFields->size == null ? 'Не вказано' : $productFields->size->size }}
                        </option>

                        @foreach ($sizes as $size_item)
                            @if ($size_item->size != $sizeValueName)
                                <option value="{{ $size_item->size }}">{{ $size_item->size }}</option>
                            @endif
                        @endforeach
                        @if ($sizeValueName != 'Не вказано')
                            <option value="Не вказано">Не вказано</option>
                        @endif
                    </x-adminlte-select>
                </div>

                <div class="col-sm-3">
                    <x-adminlte-select fgroup-class="col-md-12" name="item_status" label="Статус" title="Наявність товару">
                        <option value="{{ $value1 = $productFields->in_stock == 1 ? 1 : 0 }}" selected>
                            {{ $baseStatus = $productFields->in_stock == 1 ? 'В наявності' : 'Відсутній' }}</option>
                        <option value="{{ $value2 = $value1 == 1 ? 0 : 1 }}">
                            {{ $altStatus = $baseStatus == 'В наявності' ? 'Відсутній' : 'В наявності' }}</option>
                    </x-adminlte-select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <x-adminlte-input name="quantity" type="number" value="{{ $productFields->quantity }}" min="0"
                        max="100" label="Кількість" fgroup-class="col-md-12" />
                </div>
                <div class="col-sm-2">
                    <x-adminlte-input name="price" type="text" label="Ціна" value="{{ $productFields->price }}"
                        fgroup-class="col-md-12" />
                </div>
                <div class="col-sm-2">
                    <x-adminlte-select fgroup-class="col-md-12" type="text" name="category" label="Категорія">
                        <option
                            value="{{ $categoryValueName = $productFields->category == null ? 'Без категорії' : $productFields->category->name }}"
                            selected>
                            {{ $categoryName = $productFields->category == null ? 'Без категорії' : $productFields->category->name }}
                        </option>
                        @foreach ($categories as $category)
                            @if ($category->name != $categoryName)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                        @if ($categoryValueName != 'Без категорії')
                            <option value="Без категорії">Без категорії</option>
                        @endif
                    </x-adminlte-select>
                </div>
                <div class="col-sm-2">
                    <x-adminlte-input name="color" type="text" label="Колір" fgroup-class="col-md-12"
                        value="{{ $productFields->color }}" />
                </div>
                <div class="col-sm-2">
                    <x-adminlte-input name="article" type="text" label="Артикул" fgroup-class="col-md-12"
                        value="{{ $productFields->article }}" disabled />
                </div>
                <div class="col-sm-2">
                    <x-adminlte-input name="country" type="text" label="Країна" fgroup-class="col-md-12"
                        value="{{ $productFields->country }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <x-adminlte-input name="brand" type="text" label="Виробник" fgroup-class="col-md-12"
                        value="{{ $productFields->brand }}" />
                </div>
                <div class="col-sm-3">
                    <x-adminlte-input name="date_add" type="date" label="Дата надходження" fgroup-class="col-md-12"
                        value="{{ $productFields->date_add }}" />
                </div>
                <div class="col-sm-3">
                    <x-adminlte-input name="date_update" type="date" label="Дата оновлення" fgroup-class="col-md-12"
                        value="{{ $productFields->date_update }}" />
                </div>
                <div class="col-sm-2">
                    <x-adminlte-select fgroup-class="col-md-12" type="text" name="sale_discount" label="Знижка">
                        <option selected>
                            {{ $discountName = !is_null($productFields->discount) ? $productFields->discount->name : 'Товар без знижки' }}
                        </option>
                        @foreach ($discounts as $discount)
                            @if ($discount->name != $discountName)
                                <option>{{ $discount->name }}</option>
                            @endif
                        @endforeach
                        @if ($discountName != 'Товар без знижки')
                            <option value="Товар без знижки">Товар без знижки</option>
                        @endif
                    </x-adminlte-select>
                </div>
                <div class="col-sm-4">
                    <br>
                    <x-adminlte-input-file name="images[]" igroup-size="sm" placeholder="Завантажити зображення"
                        label="Завантажити декілька зображень" multiple>
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>
                <div class="col-sm-8 modal-container" id="modal-image-container" data-product-id="{{ $id }}">
                    @foreach ($thumbnails as $imageId => $thumbnailPath)
                        @php
                            // Extract the file name from the thumbnail path
                            $thumbnailFilename = pathinfo($thumbnailPath, PATHINFO_FILENAME);
                            // Form the full path to the original image
                            $originalImagePath = $originalImageDirectory . $thumbnailFilename . '.' . pathinfo($thumbnailPath, PATHINFO_EXTENSION);
                        @endphp

                        <div id="main-img-container" class="image-container">
                            <img class="thumbnail-img" src="{{ asset($thumbnailPath) }}" alt="Изображение"
                                data-original-src="{{ asset($originalImagePath) }}"
                                data-is-main="{{ $mainImg[$imageId] }}" data-imageId="{{ $imageId }}">
                            <a class="close-link"
                                href="{{ route('image.delete.by.id', ['id' => $imageId, 'productId' => $id]) }}">
                                <span class="close-icon">&times;</span>
                            </a>
                        </div>

                        <div class="modal">
                            <span class="close-modal">&times;</span>
                            <img class="modal-content">
                            <span class="arrow left-arrow">&#9664;</span>
                            <span class="arrow right-arrow">&#9654;</span>

                            <a href="#" class="set-main-image-link">
                                <span class="set-main-image-button">Головне фото</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="description_field" class="row">
                <div class="col-sm-12">
                    <x-adminlte-text-editor name="description" label="Опис" igroup-size="sm"
                        placeholder="Інформація про товар..." :config="$config">
                        {{ $productFields->description }}
                    </x-adminlte-text-editor>
                    <x-adminlte-button type="submit" name="save_item" label="Зберегти" theme="primary"
                        icon="fas" />
                </div>
            </div>
            <br><br>
        </div>
    </form>

    <script>
        const labels = document.querySelectorAll('label');
        labels.forEach(label => {
            const labelText = label.innerText.trim();
            if (labelText !== 'Країна' && labelText !== 'Виробник' && labelText !== 'Дата оновлення' &&
                labelText !== 'Знижка' && labelText !== 'Опис' && labelText !== 'Артикул' && labelText !==
                'Завантажити зображення' && labelText !== 'Завантажити декілька зображень') {
                label.innerHTML += '<span style="color: red;">*</span>';
            }
        });

        /////////////////////***** modal image popup *****/////////////////
        // Get all elements with class 'thumbnail-img'
        var thumbnailImages = document.querySelectorAll('.thumbnail-img');
        // Getting a modal window
        var modal = document.querySelector('.modal');
        var modalImage = document.querySelector('.modal-content');
        var leftArrow = document.querySelector('.left-arrow');
        var rightArrow = document.querySelector('.right-arrow');
        var currentImageIndex = 0;
        var imagesCount = thumbnailImages.length;
        var imageId;

        // Function for switching images left and right
        function changeImage(direction) {
            var newIndex = currentImageIndex + direction;

            if (newIndex < 0) {
                newIndex = imagesCount - 1;
            } else if (newIndex >= imagesCount) {
                newIndex = 0;
            }

            if (newIndex !== currentImageIndex) {
                currentImageIndex = newIndex;
                var newImage = thumbnailImages[currentImageIndex].getAttribute('data-original-src');
                modalImage.src = newImage;

                //Get the imageId from the current thumbnail/////////////////////
                imageId = thumbnailImages[currentImageIndex].getAttribute('data-imageId');
                // console.log(imageId);

                // Call the method to check the "Head Photo" button
                checkLinkOnMain(thumbnailImages[currentImageIndex].getAttribute('data-is-main'));
            }
        }

        // Left arrow click handler
        leftArrow.addEventListener('click', function() {
            if (currentImageIndex > 0) {
                changeImage(-1);
            }
        });

        // Right arrow click handler
        rightArrow.addEventListener('click', function() {
            if (currentImageIndex < imagesCount - 1) {
                changeImage(1);
            }
        });

        ///////////////////////////////////////////////////////////////////////////
        // Click event handler for thumbnails
        thumbnailImages.forEach(function(thumbnailImage) {
            thumbnailImage.addEventListener('click', function() {
                // Get the 'data-original-src' attribute from the thumbnail
                var originalSrc = this.getAttribute('data-original-src');
                //Getting the value of the 'data-is-main' attribute
                var isMain = this.getAttribute('data-is-main');

                // Get the 'data-imageId' attribute from the thumbnail
                imageId = this.getAttribute('data-imageId');

                // Set the src of the image in the modal window
                modalImage.src = originalSrc;

                // Displaying a modal window
                modal.style.display = 'block';

                checkLinkOnMain(isMain);

            });
        });

        function checkLinkOnMain(isMain) {
            var setMainImageButton = document.querySelector('.set-main-image-button');
            console.log('555555 ', isMain);
            if (isMain === "1") {
                // We get the <a> element
                setMainImageButton.textContent = 'Головне фото';

                // disable clicking on the link
                var setMainImageLink = document.querySelector('.set-main-image-link');
                setMainImageLink.addEventListener('click', preventDefaultClick);

            } else {
                setMainImageButton.textContent = 'Обрати головним';

                //enable click action 
                var setMainImageLink = document.querySelector('.set-main-image-link');
                setMainImageLink.removeEventListener('click', preventDefaultClick);
            }
        }

        // Function to prevent clicking
        function preventDefaultClick(event) {
            event.preventDefault();
        }

        ////////////////////////////////////////////////////////////////////////
        // Click event handler for closing a modal window
        var closeModal = document.querySelector('.close-modal');
        closeModal.addEventListener('click', function() {
            // Hiding a modal window
            modal.style.display = 'none';
        });

        // Close the modal window if the user clicks outside the image
        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        });


        document.querySelectorAll('.set-main-image-link').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                // Get the text (textContent) of the current link and assign it to "Golovne Photo"
                const linkText = this.querySelector('.set-main-image-button').textContent;
                this.querySelector('.set-main-image-button').textContent = "Головне фото";

                // Getting element with id "modal-image-container"
                var modalContainer = document.getElementById('modal-image-container');

                // Getting "data-product-id" attribute value
                var productId = modalContainer.getAttribute('data-product-id');

                // code to send data to the server
                const data = {
                    imageId: imageId,
                    productId: productId
                };
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '/choose-main-img');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        xhr.responseText;
                        const response = JSON.parse(xhr.responseText);
                        const data = response.data;

                        // Extract data from JSON response
                        const mainImg = data.mainImg;

                        //Go through each element and update the attributes
                        thumbnailImages.forEach((thumbnailImage, index) => {
                            const imageId = thumbnailImage.getAttribute('data-imageId');
                            thumbnailImage.setAttribute('data-is-main', mainImg[imageId]);
                        });
                    }
                };
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                xhr.send(JSON.stringify(data));
            });
        });
    </script>

@section('plugins.Summernote', true)
@section('plugins.BsCustomFileInput', true)

@stop
