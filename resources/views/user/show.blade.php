@extends('layout.main')

@section('title', 'Użytkownik')

@section('content')
    <h1>
        users list
    </h1>

    <div>
        wspołdzielenie zmiennych: {{$appName}}
    </div>
    <hr>
    <div>
        user id: {{$id}}
    </div>
    <hr>
    <div>
        example: <?php echo $example?> to samo co wyzej
    </div>
@endsection

@section('siderbar')
   Rodzic @parent


   Dziecko<li>siderbar z dziecka</li>
@endsection

@show


