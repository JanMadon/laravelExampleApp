@extends('layout.main')contentMain
{{-- <head><link href="/css/styles.css" rel="stylesheet" /></head> --}}
@section('contentMain')
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
                                <th>Id</th>
                                <th>Tytuł</th>
                                <th>Ocena</th>
                                <th>Kategoria</th>
                                <th>Opcje</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
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
                                <td>{{$game->id}}</td>
                                <td>{{$game->title}}</td>
                                <td>{{$game->score}}</td>
                                <td>{{$game->genres_name}}</td>
                                <td>
                                    <a href="{{ route('games.e.show', ['gameId' => $game->id])}}">Szczeguły</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    {{$games->links('vendor.myPaginator.myPaginator')}}
                    {{-- z wymuszeniem odpowiedniego szbllonu --}}
            </div>
        </div>
    </div>


@endsection


{{--  --}}
