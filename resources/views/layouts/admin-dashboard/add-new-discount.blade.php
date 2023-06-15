@extends('adminlte::page')
@section('css')

@stop
@section('content_header')
    <h1>Додати знижку</h1>
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
    <form method="POST" action="{{ route('add.discount') }}">
        {{ csrf_field() }}
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <x-adminlte-input name="disc-name" type="text" label="Назва" fgroup-class="col-md-12"
                        disable-feedback />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <x-adminlte-input name="disc-sum" type="text" label="Сума" fgroup-class="col-md-12"
                        disable-feedback />
                </div>
                <div class="col-sm-3">
                    <x-adminlte-input name="min-sum" title="Мін сума для активації знижки" type="text" label="Мін сума"
                        fgroup-class="col-md-12" disable-feedback />
                </div>
                <div class="col-sm-3">
                    <x-adminlte-input name="start-discount" title="Дата початку знижки" type="date" label="Початок"
                        fgroup-class="col-md-12" disable-feedback />
                </div>
                <div class="col-sm-3">
                    <x-adminlte-input name="stop-discount" title="Дата закінчення знижки" type="date" label="Кінець"
                        fgroup-class="col-md-12" disable-feedback />
                </div>
            </div>
            <div id="description_field" class="row">
                <div class="col-sm-12">
                    <x-adminlte-text-editor name="description" label="Опис" igroup-size="sm"
                        placeholder="Інформація про товар..." :config="$config" />
                    <x-adminlte-button type="submit" name="save_item" label="Зберегти" theme="primary" icon="fas" />
                </div>
            </div>
            <br><br>
        </div>
    </form>
    <script>
        const labels = document.querySelectorAll('label');
        labels.forEach(label => {
            const labelText = label.innerText.trim();
            if (labelText !== 'Опис') {
                label.innerHTML += '<span style="color: red;">*</span>';
            }
        });
    </script>

@section('plugins.Summernote', true)

@stop
