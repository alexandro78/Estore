@extends('adminlte::page')

@section('content_header')
    <h1>Налаштування профіля</h1>
@stop

@section('content')
    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">

        <div class="card-header" style="color: #babfc8;">Адмін</div>
        <div class="card-body">
            <h5 class="card-title">Олександр Дяченко</h5>
            <p style="font-size:11px; color: #babfc8;" class="card-text"></p>
            <label for="inputs" style="font-size: 11px; margin-bottom: 0; font-weight:400; ">Оновити дані</label>
            <input type="text" placeholder="новий пароль"
                style="background-color: #6c757d; border: none; outline: none; color: white;">
            <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>
            <input type="text" placeholder="призвище/ім'я"
                style="background-color: #6c757d; border: none; outline: none; color: white;">
            <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>
            <input type="text" placeholder="дата народження"
                style="background-color: #6c757d; border: none; outline: none; color: white;">
            <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>
        </div>
    </div>
    </div>

    <style>
        ::placeholder {
            color: rgb(255, 255, 255);
        }
    </style>


@stop
