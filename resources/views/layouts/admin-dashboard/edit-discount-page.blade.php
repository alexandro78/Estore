@extends('adminlte::page')
@section('css')

@stop
@section('content_header')
    <h1>Редагувати знижку</h1>
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
    <form onsubmit="return checkInput()" method="POST" action="{{ route('update.discount', ['id' => $id]) }}">
        {{ csrf_field() }}
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <x-adminlte-input id="disc-name" name="disc-name" type="text" label="Назва" value="{{ $name }}"
                        fgroup-class="col-md-12" disable-feedback />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <x-adminlte-input id="disc-sum" name="disc-sum" type="text" label="Сума"
                        value="{{ $price_off }}" fgroup-class="col-md-12" disable-feedback />
                </div>
                <div class="col-sm-3">
                    <x-adminlte-input name="min-sum" id="min-sum" title="Мін сума для активації знижки" type="text"
                        value="{{ $min_amount }}" label="Мін сума" fgroup-class="col-md-12" disable-feedback />
                </div>
                <div class="col-sm-3">
                    <x-adminlte-input name="start-discount" id="start-discount" title="Дата початку знижки" type="date"
                        value="{{ $start_date }}" label="Початок" fgroup-class="col-md-12" disable-feedback />
                </div>
                <div class="col-sm-3">
                    <x-adminlte-input name="stop-discount" id="stop-discount" title="Дата закінчення знижки" type="date"
                        label="Кінець" fgroup-class="col-md-12" value="{{ $end_date }}" />
                </div>
            </div>
            <div id="description_field" class="row">
                <div class="col-sm-12">
                    <x-adminlte-text-editor id="description" name="description" label="Опис" igroup-size="sm"
                        placeholder="Інформація про товар..." :config="$config">
                        {{ $description }}
                    </x-adminlte-text-editor>
                    <x-adminlte-button type="submit" name="save_item" label="Зберегти" theme="primary" icon="fas" />
                </div>
            </div>
            <br><br>
        </div>
    </form>

    <script src="{{ mix('resources/js/formValidatorEditDiscount.js') }}"></script>

@section('plugins.Summernote', true)

@stop
