@extends('adminlte::page')
@section('content_header')

    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h1>Категорії товарів</h1>
            </div>
            {{-- <x-adminlte-small-box text="Loading data..." theme="info" url="#" loading/> --}}
            <div class="col-sm-4">
                <x-adminlte-input id="add-cat" name="add-cat" placeholder="Додати категорію" type="text"
                    fgroup-class="col-md-12" />
            </div>
            <div class="col-sm-2">
                <x-adminlte-button type="submit" onclick="sddCategory()" name="save_cat" label="Зберегти" theme="primary"
                    icon="fas" />
            </div>
        </div>
    </div>
    <style>
        .flex-container {
            display: flex;
        }
    </style>
@stop

@section('content')


    @php
        $heads = ['ID', 'Назва', ['label' => 'Дії', 'no-export' => true, 'width' => 5]];
        
        $btnEdit = '<button onclick="editCategory(this)" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
            <i class="fa fa-lg fa-fw fa-pen"></i>
        </button>';
        $btnDelete = '<button onclick="deleteCategory(this)" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
              <i class="fa fa-lg fa-fw fa-trash"></i>
          </button>';
        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
               <i class="fa fa-lg fa-fw fa-eye"></i>
           </button>';
        
        $config = [
            'data' => $data, /* [[22, 'name', '<nobr>' . $btnEdit . $btnDelete . '</nobr>'], [22, 'name2', '<nobr>' . $btnEdit . $btnDelete . '</nobr>']], */
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
        let globalIdCell = 0;

        function sddCategory() {
            // alert('Категорію збережено!');
            event.preventDefault();
            var addCatValue = document.getElementById('add-cat').value;
            const data = {
                name: addCatValue
            };
            document.getElementById('add-cat').value = '';
            // Создание объекта XMLHttpRequest
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/add-cat');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    xhr.responseText;
                    location.reload();
                    
                }
            };
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.send(JSON.stringify(data));
        }


        function deleteCategory(button) {
            var row = button.closest('tr');
            var catId = row.querySelector("td:nth-child(1)");
            event.preventDefault();
            const data = {
                id: catId.innerHTML
            };
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/delete-category-by-id');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    // updateTable("#table1");
                    location.reload();
                }
            };
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.send(JSON.stringify(data));
        }


        function editCategory(button) {
            const inputElements = document.querySelectorAll('input');
            // Loop through each element and replace it with its value
            inputElements.forEach((input) => {
                // Ignore input elements with id "add-cat"
                if (input.id !== "add-cat" && input.type !== "search" && input.id !== "message") {
                    // Create a new text node with the input value
                    const textNode = document.createTextNode(input.value);
                    // Replace the input element with the text node
                    input.parentNode.replaceChild(textNode, input);
                }
            });
            var row = button.closest('tr'); // get table row
            globalIdCell = row.querySelector("td:nth-child(1)"); // get the second cell in the row
            var cell1 = row.querySelector("td:nth-child(2)"); // get the second cell in the row
            var value1 = cell1.innerHTML.trim(); // get the value of the second field and remove spaces at the beginning and end

            if (cell1.querySelector("input")) {
                return;
            }
            // create a new input element
            var inputElem = document.createElement("input");
            inputElem.setAttribute("type", "text");
            inputElem.setAttribute("value", value1);

            // replace the contents of the cell with a new input element
            cell1.innerHTML = "";
            cell1.appendChild(inputElem);
        }

        document.addEventListener('click', function(event) {
            if (event.target.tagName.toLowerCase() != 'i' && event.target.tagName.toLowerCase() !=
                'input') {
                // Get all input elements on the page
                const inputElements = document.querySelectorAll('input');
                // Loop through each element and replace it with its value
                inputElements.forEach((input) => {
                    // Ignore input elements with id "add-cat"
                    if (input.id !== "add-cat" && input.type !== "search") {
                        // Create a new text node with the input value
                        const textNode = document.createTextNode(input.value);
                        // console.log(globalIdCell.innerHTML);
                        // console.log(input.value);
                        event.preventDefault();
                        const data = {
                            name: input.value,
                            id: globalIdCell.innerHTML
                        };
                        const xhr = new XMLHttpRequest();

                        xhr.open('POST', '/edit-category');
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                xhr.responseText;
                            }
                        };
                        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                        xhr.send(JSON.stringify(data));
                        // Replace the input element with the text node
                        input.parentNode.replaceChild(textNode, input);
                    }
                });
            }
        });
    </script>

@stop
