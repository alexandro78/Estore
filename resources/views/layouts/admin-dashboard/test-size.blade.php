@extends('adminlte::page')

@section('content_header')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h1>Таблиця розмірів</h1>
            </div>
            {{-- <x-adminlte-small-box text="Loading data..." theme="info" url="#" loading/> --}}
            <div class="col-sm-4">
                <form action="{{ route('save.size') }}" method="POST">
                    @csrf
                    <x-adminlte-input id="add-size" name="add-size" placeholder="Додати розмір" type="text"
                        fgroup-class="col-md-12" />
            </div>
            <div class="col-sm-2">
                <x-adminlte-button type="submit" id="save-size" name="save-size" label="Зберегти" theme="primary"
                    icon="fas" />
                </form>
            </div>
        </div>
    </div>
@stop

@section('content')

    @php
        $heads = ['ID', 'Розмір', ['label' => 'Дії', 'no-export' => true, 'width' => 10]];
        
        $btnEdit = '<button onclick="editHTML(this)" id="edit-button1" class="edit-button btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>';
        $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';
        $inputName = '<input type="text" id="numeric-size" name="numeric-size">';
        $sizeColumn = '<p id="numeric-size-text">Numeric size XL</p>';
        
        $config = [
            'data' => $data /*[[1, 'Numeric size XL9999', $btnEdit . $btnDelete], [2, 'Numeric size XL', $btnEdit . $btnDelete], [3, 'Numeric size XL', $btnEdit . $btnDelete]], */,
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
        function editSize(button) {
            const inputElements = document.querySelectorAll('input');
            inputElements.forEach((input) => {
                // Ignore input elements with id "add-cat"
                if (input.id !== "add-size" && input.type !== "search" && input.name !== "_token") {
                    // Create a new text node with the input value
                    const textNode = document.createTextNode(input.value);
                    // Replace the input element with the text node
                    input.parentNode.replaceChild(textNode, input);
                }
            });

            var row = button.closest('tr'); // get table row
            var numericSize = row.querySelector("td:nth-child(2)");

            if (numericSize.querySelector("input") && letterSize.querySelector("input")) {
                return;
            }
            var numericSizeInput = document.createElement("input");
            var letterSizeInput = document.createElement("input");
            numericSizeInput.setAttribute("type", "text");
            numericSizeInput.setAttribute("value", numericSize.innerHTML.trim());

            numericSize.innerHTML = "";
            numericSize.appendChild(numericSizeInput);
        }

        document.addEventListener('click', function(event) {
            if (event.target.tagName.toLowerCase() != 'i' && event.target.tagName.toLowerCase() !=
                'input') {
                // Get all input elements on the page
                const inputElements = document.querySelectorAll('input');
                // Loop through each element and replace it with a paragraph
                inputElements.forEach((input) => {
                    if (input.id !== "add-size" && input.type !== "search" && input.name !== "_token") {
                        // Replace the input element with a paragraph
                        const textNode = document.createTextNode(input.value);
                        input.parentNode.replaceChild(textNode, input);
                    }
                });
            }
        });
    </script>
@stop
