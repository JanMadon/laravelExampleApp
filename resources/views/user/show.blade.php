@extends('layout.main')

@section('title', 'Użytkownik')

@section('content')

    <hr>
    <h3>Informacje o urzytkowniku:</h3>
    <ul>
        <li>Id: {{$user['id']}}</li>
        <li>Imię: {{$user['firstName']}}</li>
        <li>Nazwisko: {{$user['lastName']}}</li>
        <li>Miasto: {{$user['city']}}</li>
    </ul>
{{-- DOMYŚLNIE UZYWAJ TEJ KONSTRUKCJI
    ten html się nie wyręderuje: dak jest ustawione deufoltowo (to jest zapiezpiecznie takie)
    wszystkie tagi escepuje również kod JS
    <b>Bold HTML</b> --}}
    <div>{{$user['html']}}</div>

    {{-- tak się wyświetla bez escepowania:
        Bold HTML --}}
    {!! $user['html'] !!}
    <hr>

@endsection


