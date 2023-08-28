<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>
        {{-- Application: {{$appBladeName}} --}}
        @yield('title', $appBladeName)
    </title>

    {{-- <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="http://localhost:5173/@laravel-vite-bootstrap" rel="stylesheet">
    <script src="{{mix('js/app.js')}}"></script> --}}

    {{-- tak wyczytalem w dokumetacji --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- @vite(['resources/css/app.css']) --}}

    <style>
        td {
            padding-right: 25px;
        }
    </style>
</head>

<body>
    <h1>{{$appBladeName}}</h1>
    <div class="container">
        <button class="btn btn-primary">Przykładowy przycisk husj</button>
    </div>
    <div class="siderbar">
       @include('user.sideBar')
    </div>
    <hr>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
