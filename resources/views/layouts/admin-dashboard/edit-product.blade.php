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
                    {{-- <input fgroup-class="col-md-12" type="file" name="images[]" multiple> --}}
                </div>
                <div class="col-sm-8">
                    @foreach ($thumbnails as $imageId => $thumbnailPath)
                        <div class="image-container">
                            <img class="thumbnail-img" src="{{ asset($thumbnailPath) }}" alt="Изображение">
                            <a class="close-link"
                                href="{{ route('image.delete.by.id', ['id' => $imageId, 'productId' => $id]) }}">
                                <span class="close-icon">&times;</span>
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
    </script>

@section('plugins.Summernote', true)
@section('plugins.BsCustomFileInput', true)

@stop
