<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    @livewireStyles
    <!-- Title  -->
    <title>Karl - Fashion Ecommerce Template | Product Details</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('img/core-img/favicon.ico') }}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/core-style.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <!-- Responsive CSS -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.frontend-user-side.header')
    @yield('content')
    @include('layouts.frontend-user-side.footer')
    </div>
    <script>
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    </script>
    @livewireScripts
    <!-- /.wrapper end -->
    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('js/plugins.js') }}"></script>
    
    <!-- Active js -->
    <script src="{{ asset('js/active.js') }}"></script>
</body>
</html>
