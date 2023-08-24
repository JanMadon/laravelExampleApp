@extends('layout.main')

@section('content')
<body>

    <div> <h1>Users list:</h1></div>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nick</th>
                <th>Opcje</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                {{-- foreach przechodzi standardowo po tablicy --}}
                <td colspan="3"> FOREACH</td>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user['id']}}</td>
                        <td>{{$user['name']}}</td>
                        <td>
                            <a href={{
                                route('get.user.show',
                                ['userId'=> $user['id']])
                                }}> Szczeguły
                            </a>
                        </td>
                    </tr>
                @endforeach

                {{-- for potrzebuje tego dodatkowego [$i]  --}}
                <td colspan="3"> FOR</td>
                @for ($i = 0; $i < count($users); $i++)

                @if ($i == 0)
                    @continue // pominie pierwsze przzejscie petli
                @endif
                @continue($i == 0) // działa tak samo jak to wyzej

                <tr>
                    <td>{{$users[$i]['id']}}</td>
                    <td>{{$users[$i]['name']}}</td>
                    <td>
                        <a href={{
                            route('get.user.show',
                            ['userId'=> $users[$i]['id']])
                            }}> Szczeguły
                        </a>
                    </td>
                </tr>



                @if ($i == 4)
                    @break // po 2 przejsciach petla for się zatrzyma
                @endif
                @break($i == 0) // działa tak samo jak to wyzej


                @endfor

                {{-- forelse odpali kod z else gdy tablica, kolekcja bedzie pusta a tak to to samo co foreach--}}
                <td colspan="3"> FORELSE</td>
                @forelse ($users as $user)
                <tr>
                    <td>{{$user['id']}}</td>
                    <td>{{$user['name']}}</td>
                    <td>
                        <a href={{
                            route('get.user.show',
                            ['userId'=> $user['id']])
                            }}> Szczeguły
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td>Lista jest pusta</td>
                </tr>
                @endforelse
                {{-- jest jeszcze while ale nic ciekawego tam nie ma  --}}

            </tr>
        </tbody>
    </table>

</body>
@endsection

