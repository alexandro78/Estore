@extends('adminlte::page')

@section('content_header')
    <h1>Додати/редагувати замовлення</h1>
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

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <x-adminlte-input name="cart-number" title="Перелік замовлених товарів" type="text" label="Кошик" fgroup-class="col-md-12" disable-feedback />
            </div>
            <div class="col-sm-4">
                <x-adminlte-input name="shipping-status" title="Статус доставки" type="text" label="Статус" fgroup-class="col-md-12" disable-feedback />
            </div>
            <div class="col-sm-4">
                <x-adminlte-input name="order-number" type="text" label="№ Замовлення" fgroup-class="col-md-12"
                    disable-feedback />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <x-adminlte-input name="order-data" title="Дата змовлення" type="text" label="Дата" fgroup-class="col-md-12"
                    disable-feedback />
            </div>
            <div class="col-sm-2">
                <x-adminlte-input name="order-sum" title="Сума замовлення" type="text" label="Сума" fgroup-class="col-md-12" disable-feedback />
            </div>
            <div class="col-sm-4">
                <x-adminlte-input name="shipping-method" title="Поштовий сервіс" type="text" label="Пошта" fgroup-class="col-md-12"
                    disable-feedback />
            </div>
            <div class="col-sm-4">
                <x-adminlte-input name="shipping-adress" type="text" label="Адреса" fgroup-class="col-md-12" disable-feedback />
            </div> 
        </div>
        <x-adminlte-button name="save_item" label="Зберегти" theme="primary" icon="fas" />
    </div>

    <script>
        const labels = document.querySelectorAll('label');
        labels.forEach(label => {
            label.innerHTML += '<span style="color: red;">*</span>';
        });
    </script>

@section('plugins.Summernote', true)

@stop
