@extends('layout.main')contentMain
{{-- <head><link href="/css/styles.css" rel="stylesheet" /></head> --}}
@section('contentMain')

    <div>
        <p>liczba gier: </p> <p style="color: blue">{{$stats['count']}} </p>
        <p>liczba gier: 5+:</p> <p style="color: blue">{{$stats['countScoreGTFive']}} </p>
        <p>Srednia ocena: </p> <p style="color: blue">{{$stats['avg']}} </p>
        <p>max ocena:</p> <p style="color: blue">{{$stats['max']}} </p>
        <p>min ocena:</p> <p style="color: blue">{{$stats['min']}} </p>
    </div>
    <hr>
    <div class="card">
        <div class="card-header"><i class="fas fa-table mr-1"></i>Statystkyki gier</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Ocena</th>
                            <th>Liczba gier z daną oceną</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scoreStats as $scoreStat)
                        <tr>
                            <td>{{$scoreStat->score}}</td>
                            <td>{{$scoreStat->count}}</td>
                        </tr>

                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <hr>
    <h3>BestGames:</h3>
    <div class="row mt-3">
        <div class="card">
            <div class="card-header"><i class="fas fa-table mr-1"></i></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Tytuł</th>
                                <th>Ocena</th>
                                <th>Gatunek</th>
                                <th>Opcje</th>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Lp</th>
                            <th>Tytuł</th>
                            <th>Ocena</th>
                            <th>Gatunek</th>
                            <th>Opcje</th>
                        </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($bestGames as $bestgame)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$bestgame->title}}</td>
                                <td>{{$bestgame->score}}</td>
                                <td>{{$bestgame->genre->name}}</td>
                                <td>
                                    <a href="{{ route('games.show', ['gameId' => $bestgame->id])}}">Szczeguły</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <h3>Lista gier:</h3>
    <div class="row mt-3">
        <div class="card">
            <div class="card-header"><i class="fas fa-table mr-1"></i></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Lp</th>
                                <th>Tytuł</th>
                                <th>Ocena</th>
                                <th>Gatunek</th>
                                <th>Opcje</th>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Lp</th>
                            <th>Tytuł</th>
                            <th>Ocena</th>
                            <th>Gatunek</th>
                            <th>Opcje</th>
                        </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($games as $game)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$game->title}}</td>
                                <td>{{$game->score}}</td>
                                <td>{{$game->genre->name}}</td>
                                <td>
                                    <a href="{{ route('games.show', ['gameId' => $game->id])}}">Szczeguły</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection


{{--  --}}
