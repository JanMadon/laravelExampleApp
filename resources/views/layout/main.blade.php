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


    <style>
        td {
            padding-right: 25px;
        }
    </style>
</head>

<body>
    <h1>{{$appBladeName}}</h1>
    <div class="siderbar">
        @section('siderbar')
            <li><a href="#">...</a></li>
        @show
    </div>
    <hr>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
