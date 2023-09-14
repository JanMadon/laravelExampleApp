@extends('layout.main')contentMain

@section('contentMain')

    <div>
        <p>liczba gier: </p> <p style="color: blue">{{$stats['count']}} </p>
        <p>liczba gier: 5+:</p> <p style="color: blue">{{$stats['countScoreGTFive']}} </p>
        <p>Srednia ocena: </p> <p style="color: blue">{{$stats['avg']}} </p>
        <p>max ocena:</p> <p style="color: blue">{{$stats['max']}} </p>
        <p>min ocena:</p> <p style="color: blue">{{$stats['min']}} </p>
    </div>

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
                                <th>Kategoria</th>
                                <th>Opcje</th>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Lp</th>
                            <th>Tytuł</th>
                            <th>Ocena</th>
                            <th>Kategoria</th>
                            <th>Opcje</th>
                        </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($games as $game)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$game->title}}</td>
                                <td>{{$game->score}}</td>
                                <td>{{$game->genre_id}}</td>
                                <td>
                                    <a href="{{ route('get.game', ['gameId' => $game->id])}}">Szczeguły</a>
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
