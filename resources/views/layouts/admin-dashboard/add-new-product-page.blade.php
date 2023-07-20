@extends('adminlte::page')
@section('css')

@stop
@section('content_header')
    <h1>Додати товар</h1>
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
    <form method="POST" action="{{ route('add.product') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="container">

            <div class="row">
                <div class="col-sm-7">
                    <x-adminlte-input name="item_name" type="text" label="Назва" fgroup-class="col-md-12" />
                </div>
                <div class="col-sm-2">
                    <x-adminlte-select name="item_size" label="Розмір">
                        @foreach ($sizes as $itemSize)
                            <option>{{ $itemSize->size }}</option>
                            {{-- <option disabled>Option 2</option> --}}
                        @endforeach
                    </x-adminlte-select>
                </div>

                <div class="col-sm-3">
                    <x-adminlte-select fgroup-class="col-md-12" name="item_status" label="Статус" title="Наявність товару">
                        <option value="1" selected>В наявності</option>
                        <option value="0">Товар відсутній</option>
                    </x-adminlte-select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <x-adminlte-input name="quantity" type="number" value="0" min="0" max="100"
                        label="Кількість" fgroup-class="col-md-12" />
                </div>
                <div class="col-sm-2">
                    <x-adminlte-input name="price" type="text" label="Ціна" fgroup-class="col-md-12" />
                </div>
                <div class="col-sm-2">
                    <x-adminlte-select fgroup-class="col-md-12" type="text" name="category" label="Категорія"
                        title="Наявність товару">
                        @foreach ($categories as $category)
                            <option>{{ $category->name }}</option>
                        @endforeach
                    </x-adminlte-select>
                </div>
                <div class="col-sm-2">
                    <x-adminlte-select fgroup-class="col-md-12" type="text" name="color_code" label="Колір фільтрації"
                        title="Базовий колір фільтрації">
                        <option value="default" selected>-----</option>
                        <option value="#d7d7d7">Сірий</option>
                        <option value="red">Червоний</option>
                        <option value="#fcf29c">Жовтий</option>
                        <option value="#8fc99c">Зелений</option>
                        <option value="white">Білий</option>
                        <option value="#bc83b1">Бірюзовий</option>
                        <option value="#9ee7f4">Світло блакитний</option>
                        <option value="blue">Синій</option>
                        <option value="purple">Фіолетовий</option>
                        <option value="pink">Розовий</option>
                        <option value="#914900">Коричневий</option>
                        <option value="black">Чорний</option>
                        <option value="beige">Бежевий</option>
                        <option value="orange">Помаранчовий</option>
                    </x-adminlte-select>
                </div>

                <div class="col-sm-2">
                    <x-adminlte-input name="color" type="text" label="Колір" fgroup-class="col-md-12" />
                </div>

                <div class="col-sm-2">
                    <x-adminlte-input name="country" type="text" label="Країна" fgroup-class="col-md-12" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <x-adminlte-input name="brand" type="text" label="Виробник" fgroup-class="col-md-12" />
                </div>
                <div class="col-sm-2">
                    <x-adminlte-input name="date_add" type="date" title="Дата надходження" label="Надходження"
                        fgroup-class="col-md-12" />
                </div>
                <div class="col-sm-2">
                    <x-adminlte-input name="date_update" type="date" label="Дата оновлення" fgroup-class="col-md-12" />
                </div>
                <div class="col-sm-4">
                    <x-adminlte-select fgroup-class="col-md-12" type="text" name="sale_discount" label="Знижка">
                        <option value="default" selected>Наявних знижок немає</option>
                        @foreach ($discounts as $discount)
                            @if ($discount)
                                <option>{{ $discount->name }}</option>
                            @endif
                        @endforeach
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
            </div>
            <div id="description_field" class="row">
                <div class="col-sm-12">
                    <x-adminlte-text-editor name="description" label="Опис" igroup-size="sm"
                        placeholder="Інформація про товар..." :config="$config" />
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
                labelText !== 'Знижка' && labelText !== 'Опис' && labelText !== 'Завантажити зображення' &&
                labelText !== 'Завантажити декілька зображень') {
                label.innerHTML += '<span style="color: red;">*</span>';
            }
        });
    </script>

@section('plugins.Summernote', true)
@section('plugins.BsCustomFileInput', true)

@stop
