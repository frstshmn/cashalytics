<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="{{ URL::asset('css/bootstrap/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('fontawesome/css/all.min.css') }}" rel="stylesheet">

        <title>@yield('title') | Cashalytics</title>
    </head>
    <body>

        @yield('content')

        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
        <script src="{{ URL::asset('js/jquery/jquery-3.6.1.min.js') }}"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
            integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
            crossorigin="anonymous">
        </script>
        <script src="{{ URL::asset('js/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('js/app.js') }}"></script>
        @yield('additional_scripts')

    </body>
</html>
