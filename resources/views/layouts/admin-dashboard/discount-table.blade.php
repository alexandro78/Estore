@extends('adminlte::page')
@section('content_header')
    <h1>Знижки та акції</h1>
@stop
@section('content')

    @php
        $heads = [['label' => 'Дії', 'no-export' => true, 'width' => 5], 'ID', 'Назва', 'Опис', 'Сума знижки', 'Мін. сума', 'Початок', 'Кінець'];
        
        $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>';
        $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';
        
        $config = [
            'data' => $data, /* [[22, 'Labour day', 'start date', 'stop date', $btnDetails, 250, 2,'<nobr>' . $btnEdit . $btnDelete .'</nobr>']], */
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