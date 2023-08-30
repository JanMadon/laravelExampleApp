@extends('layout.main')


@section('contentMain')


    <ul>
        <li>Id: {{$user['id']}}</li>
        <li>Imię: {{$user['firstName']}}</li>
        <li>Nazwisko: {{$user['lastName']}}</li>
        <li>Miasto: {{$user['city']}}</li>
        <li>Wiek: {{$user['age']}}
            @if ($user['age'] >=18)
                <div>Osoba dorosła</div>
            @elseif ($user['age'] >=16)
                <div>Osoba Prawie dorosła</div>
            @else
                <div>Nastolatek</div>
            @endif
        </li>
    </ul>


@endsection


