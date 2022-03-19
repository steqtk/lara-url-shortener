<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<div class="container mt-5">
    <h3 class="text-center alert-link">url shortener</h3>
    <div class="row justify-content-center">
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach

            <p class="container text-center text-danger errors"></p>

        <form class="form-inline" action="/shorten">
            @method('post')
            @csrf
            <div class="form-group">
                <input id="url" type="url" name="url" class="form-control rounded-0"
                       placeholder="Скопируйте URL в это поле"
                       value="{{ old('url') }}" required> <br>
                <button id="submit" type="submit" class="btn btn-outline rounded-0">Сократить</button>
            </div>
        </form>
        <p class="container mt-5 text-center message">
        </p>
    </div>
</div>
</body>
</html>
