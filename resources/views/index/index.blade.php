<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/font/bootstrap-icons.min.css') }}">
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <title>@yield('app-title', 'Point Of Sale App')</title>
    </head>
    <body class="bg-body-secondary py-3">
        <div class="container-fluid ">
            @yield('app-content')
        </div>
    </body>
</html>
