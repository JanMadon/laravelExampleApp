@extends('layout.main')

@section('contentMain')
<div class="card">
    <div class="card-header"><i class="fas fa-table mr-1"></i></div>
    <div class="table-responsive">
    @if (session('status'))
        {{session('status')}}    
    @endif
    @if ($errors->any()) 
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Lp</th>
                <th>Tytuł</th>
                <th>Kategiria</th>
                <th>Ocena</th>
                <th>Twoja ocena</th>
                <th>Opcje</th>
            </tr>
            </thead>
        <tbody>
            @foreach($games ?? [] as $game)
            <tr>
                {{-- <td>{{ $loop->iteration }}</td> --}}
                <td>{{ $loop->iteration }}</td>
                <td>{{ $game->name }}</td>
                <td>{{ $game->genres->implode('name', ', ') }}</td>
                <td>{{ $game->score ?? 'brak' }}</td>

                <td>
                    <form class="m-0" method="POST" action="{{ route('me.games.rate')}}">
                        @csrf
                        <div class="from-row">
                            <input type="hidden" name="gameId" value="{{$game->id}}">
                            <div class="col-auto">
                                <input class="form-control mb-2" placeholder="ocena" 
                                    {{-- type="number" -- to jest umilacz dla uzytkownika po stronie backendu musi być validovane, postmanem można wysłać pomijająć html
                                    max="100" 
                                    min="1"  --}}
                                    name="rate" 
                                    value="{{$game->pivot->rate}}"/>  
                                                          {{-- w relacji Model/User należy dociągnoć pivota  --}}
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2">Oceń</button>    
                            </div>    
                        </div>
                    </form>
                </td>
                <td>
                    <a href="{{ route('games.show', ['gameId' => $game->id]) }}">Szczegóły</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
    {{$games->links('vendor.pagination.bootstrap-5')}}
    {{-- z wymuszeniem odpowiedniego szbllonu --}}

    <div></div>


@endsection