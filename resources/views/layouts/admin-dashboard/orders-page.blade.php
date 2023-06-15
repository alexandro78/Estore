@extends('adminlte::page')
@section('content_header')
    <h1>Замовлення</h1>
@stop
@section('content')

    @php
        $heads = ['ID', 'Клієнт', 'Кошик', '№ замовлення', 'Дата', 'Сума', 'Метод доставки', 'Адреса', 'Статус доставки', ['label' => 'Дії', 'no-export' => true, 'width' => 5]];
        
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
            'data' => [[22, 'user id1', $btnDetails, 'order number1', 'order data1', 'Sum 1', 'Метод доставки 1', 'Адреса 1', 'Статус доставки 1', '<nobr>' . $btnEdit . $btnDelete . '</nobr>'], [19, 'user_id2', $btnDetails, 'order number2', 'order data1', 'Sum 2', 'Метод доставки 2', 'Адреса 2', 'Статус доставки 2', '<nobr>' . $btnEdit . $btnDelete . '</nobr>'], [3, 'user_id3', $btnDetails, 'order number3', 'order data1', 'Sum 3', 'Метод доставки 3', 'Адреса 3', 'Статус доставки 3', '<nobr>' . $btnEdit . $btnDelete . '</nobr>']],
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

    <script>
        // Find the menu item
        let menuItem = document.querySelector('i.fa-bell');
        // Add a title attribute to the menu item
        menuItem.setAttribute('title', 'Нові замовлення');
    </script>


@stop
