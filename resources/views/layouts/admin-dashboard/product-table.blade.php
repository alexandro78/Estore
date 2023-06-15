@extends('adminlte::page')

@section('content_header')
    <h1>Всі товари</h1>
@stop

@section('content')

    @php
        $heads = [['label' => 'Дії', 'no-export' => true, 'width' => 5], 'ID', 'Назва', 'Опис', 'Ціна', 'Категорія', 'Розмір', 'Колір', 'Кількість', 'Виробник', ['label' => 'Артикул', 'width' => 25], 'Знижка', 'Наявність'];
        
        $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>';
        $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-plus"></i>
               </button>';
        $btnCategory = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';
        
        $config = [
            'data' => $data, /*[[22, 'name', $btnCategory, '<nobr>' . '243' . ' грн.' . '</nobr>', 'category', 'XL', 'color', 25, 'Китай', '123456789', '<i class="bi bi-check-lg text-success">В наявності</i>', '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'], [19, 'name2', $btnCategory, '<nobr>' . '5555' . ' грн.' . '</nobr>', 'category2', 'XX', 'color2', 15, 'Турція',  '123456789', 'Відсутній', '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'], [3, 'name3', $btnCategory, '<nobr>' . '456' . ' грн.' . '</nobr>', 'category3', 'XXXL', 'color3', 10, 'Тайвань', '123456789', 'В наявності', '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>']], */
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads" theme="light" striped hoverable>
        @foreach ($config['data'] as $row)
        <tr>
            @foreach ($row as $cell)
                <td>{!! $cell !!}</td>
            @endforeach
        </tr>
    @endforeach
    </x-adminlte-datatable>

@stop
