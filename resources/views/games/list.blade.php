@extends('layout.main')contentMain
{{-- <head><link href="/css/styles.css" rel="stylesheet" /></head> --}}
@section('contentMain')
    <h3>Lista gier:</h3>
    <div class="row mt-3">
        <div class="card">
            <div class="card-header"><i class="fas fa-table mr-1"></i></div>
            <div class="card-body">

                <form action="{{ route('games.list')}}" class="form-inline">
                <div class="form-row">
                    <label for="phrase" class="my-1 mr-2">Szukana fraza:</label>
                    <div class="col">
                        <input type="text" class="form-control" name="phrase" placeholder="" value="{{$phrase ?? ''}}">
                    </div>

                    @php
                        $type =$type ?? ''    
                    @endphp
                    <div class="col-auto">
                        <select name="type">
                            <option @if ($type == 'all') selected @endif value="all">Wszystkie rodzaje</option>
                            <option @if ($type == 'game') selected @endif value="game">Gry</option>
                            <option @if ($type == 'dlc') selected @endif value="dlc">Dlc</option>
                            <option @if ($type == 'demo') selected @endif value="demo">Demo</option>
                            <option @if ($type == 'episode') selected @endif value="episode">Epizody</option>
                            <option @if ($type == 'mod') selected @endif value="mod">Mody</option>
                            <option @if ($type == 'movie') selected @endif value="movie">Filmy</option>
                            <option @if ($type == 'music') selected @endif value="music">Muzyka</option>
                            <option @if ($type == 'series') selected @endif value="series">Seriale</option>
                            <option @if ($type == 'video') selected @endif value="video">Video</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-1">Wyszukaj</button>
                </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tytuł</th>
                                <th>Rodzaje</th>
                                <th>Ocena</th>
                                <th>Gatunek</th>
                                <th>Opcje</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Tytuł</th>
                                <th>Rodzaje</th>
                                <th>Ocena</th>
                                <th>Gatunek</th>
                                <th>Opcje</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($games ?? [] as $game)
                            <tr>
                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                <td>{{ $game->id }}</td>
                                <td>{{ $game->name }}</td>
                                <td>{{ $game->type }}</td>
                                <td>{{ $game->metacritic_score ?? 'brak' }}</td>
                                <td>{{ $game->genres->implode('name', ', ') }}</td>
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
            </div>
        </div>
    </div>


@endsection


{{--  --}}
