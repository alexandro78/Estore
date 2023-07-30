<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index document main page</title>
</head>

<body>
    {{-- <livewire:test-live-wire-com1 /> --}}
    {{-- <div>
        <h1>Lorem ipsum dolor sit amet consectetur adipisicingnecessitatibus ipsa</h1>
    </div> --}}
    {{-- <livewire:test-live-wire-com2 /> --}}

    <form class="cart" data-product-id="12">2222200000777</form>
    {{-- @livewireScripts --}}
    
    <script>
        const formElement = document.querySelector('.cart');

        // Получаем значение атрибута data-product-id
        const productId = formElement.dataset.productId;

        console.log(productId); // Выведет "12"
    </script>
</body>

</html>
