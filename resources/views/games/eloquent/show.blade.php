@extends('layout.main')
<link href="css/styles.css" rel="stylesheet" />
@section('contentMain')
cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc

<div class="card">
    @php
        // dd($game)

    @endphp

    @if (!empty($game))
        <h5 class="card-header">{{ $game['title']}}</h5>
        <div class="card-body">
            <ul>
                <li>Id: {{ $game['id'] }}</li>
                <li>Nazwa: {{ $game['title'] }}</li>
                <li>Wydawca: {{ $game['publisher'] }}</li>
                <li>Ocena: {{ $game['score'] }}</li>
                <li>Gatunek:
                    <div>
                        <span>Id: {{$game->genre->id}} </span>
                        <span>name: {{ $game->genre->name }} </span>
                    </div> </li>
                <li>Opis: {{$game->dexcription}}</li>
            </ul>

            <a href="{{ route('games.e.list')}}"> Lista gier </a>
        </div>


    @else

    <h5 class="card-header">Brak danych do wyswietlenia</h5>



    @endif
</div>

@endsection


{{--  --}}
