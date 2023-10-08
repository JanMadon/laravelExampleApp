@extends('layout.main')
<link href="css/styles.css" rel="stylesheet" />
@section('contentMain')
<div class="card">
    @if (session('status'))
    {{session('status')}}    
    @endif

    @if (!empty($game))
    <h5 class="card-header">
        {{ $game->name }}
        @if (!$userHasGame)
        <form class="float-right m-0" method="POST" action="{{route('me.games.add')}}">
            @csrf
             <div class="from-row">
                 <input type="hidden" name="gameId" value="{{$game->id}}">
                 <button type="submit" class="btn btn-primary mb-2">Dodaj do mojej listy</button>
             </div>
         </form>
         @else
         {{-- niby wyęle postem ale dzieki @method sprawdzi czy w route'ch nia znajduje się jakaś metoda delete --}}
         <form class="float-right m-0" method="POST" action="{{route('me.games.remove')}}">
            @method('delete') 
            @csrf
             <div class="from-row">
                 <input type="hidden" name="gameId" value="{{$game->id}}">
                 <button type="submit" class="btn btn-danger mb-2">Usuń z listy</button>
             </div>
         </form>
        @endif
    </h5>
   
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            
        @endif

        <ul>
            <li>Id: {{ $game->id }}</li>
            <li>Nazwa: {{ $game->name }}</li>
            <li>Wydawca: {{ $game->publishers->implode('name', ', ') }}</li>
            <li>Gatunek:{{ $game->genres->implode('name', ', ') }}</li>
        </ul>
        <div class="my-4">
            <h4>Krótki opis</h3>
            <div class="mx-2">{!! $game->short_description !!}</div>
        </div>

        <div class="my-4">
            <h4>Opis</h3>
            <div class="mx-2">{!! $game->description !!}</div>
        </div>

        <div class="my-4">
            <h4>About</h3>
            <div class="mx-2">{!! $game->about !!}</div>
        </div>

         <a href="{{ route('games.list') }}" class="btn btn-light">Lista gier</a>
        {{-- <a href="{{ url()->previous() }}" class="btn btn-light">Powrót</a> --}}
    </div>
    @else

    <h5 class="card-header">Brak danych do wyswietlenia</h5>



    @endif
</div>

@endsection


{{--  --}}
