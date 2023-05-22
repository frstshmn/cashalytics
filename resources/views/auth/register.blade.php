<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ URL::asset('css/bootstrap/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('fontawesome/css/all.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>

    <title>Реєстрація | Cashalytics</title>
</head>

<body>

<div class="container-fluid">
    <div class="row vh-100 login">
        <div class="col-12 m-auto p-2">
            <h6 class="fw-black display-6 text-white m-0 d-flex justify-content-center mb-5">
                <i class="fa-solid fa-fish-fins me-2"></i>
                <span>Cashalytics</span>
            </h6>
            <form class="d-flex flex-column" action="{{ route("register") }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Логін" required>
                <input type="text" name="email" placeholder="Логін" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <input type="password" name="password_confirmation" placeholder="Пароль" required>
                <input type="submit" value="Увійти">
            </form>
        </div>
    </div>
</div>

<script src="{{ URL::asset('js/jquery/jquery-3.6.1.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="{{ URL::asset('js/bootstrap/bootstrap.min.js') }}"></script>

</body>
</html>
