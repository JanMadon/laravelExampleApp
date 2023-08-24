@extends('layout.main')

@section('title', 'Użytkownik')

@section('content')

    <hr>
    <h3>Informacje o urzytkowniku:</h3>

    @auth
        informuje czy użytkownik jest zalogowany
        (wchodzimy wtedy w tą sekcje kodu)
    @endauth

    @guest
        przeciwieństwo do auth
    @endguest
    
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
    <hr>
    {{-- gdy tylko isnieje taka zmienna to jest true nawt gry jest pusta --}}
        @isset($nick)
            ISSET -> jest prawdą
        @else
            ISSET -> jest fałszem
        @endisset

    <hr>
    {{-- gdy coś zawiera jest fałszem --}}
        @empty($nick)
            EMPTY ->jest prawdą
        @else
            EMPTY ->jest fałszem
        @endempty




@endsection


