@extends('layout.main')

@section('content')
<body>

    <div> <h1>Users list:</h1></div>


    <table>
        <thead>
            <tr>
                <th>Index</th>
                <th>Iteration</th>
                <th>Id</th>
                <th>Name</th>
                <th>Opcion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    {{-- loop->index liczy od zera , a iteraition od 1
                        są to dość urzyteczne własciwosci zmienej loop doczytaj w dkokumetacji
                        : https://laravel.com/docs/10.x/blade#the-loop-variable --}}
                    <td>{{$loop->index}}</td>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user['id']}}</td>
                    <td>{{$user['name']}}</td>
                    <td>Link</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr/>
    <hr>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nick</th>
                <th>Opcje</th>
            </tr>
        </thead>
        <tbody>
            {{-- @each('view.name', $collection, 'variable', 'view.empty')
                 przechodzi po wszystkich ememętach danej kolekcji
                1 - nazwa szblonu, który bedzie renderowany dla kazdego elemetu, 2- dana kolekcja z ktorej biezemy element,
                3- variable- dla kazdej iteracji taka bedzie nazwa tego elemetu, 4- co wyswietlic gdy jest pusty
                czyli w sumie to samo co w  w FORELSE--}}
<hr>
                @each('user.listRow', $users, 'userData', 'welcome')
<hr>
            <tr>
                {{-- foreach przechodzi standardowo po tablicy --}}
                <td colspan="3"> FOREACH</td>
                @foreach ($users as $user)
                @include('user.listRow', ['userData'=>$user])
                @endforeach

                {{-- for potrzebuje tego dodatkowego [$i]  --}}
                <td colspan="3"> FOR</td>
                @for ($i = 0; $i < count($users); $i++)

                @if ($i == 0)
                    @continue // pominie pierwsze przzejscie petli
                @endif
                @continue($i == 0) // działa tak samo jak to wyzej

                <tr>
                    @include('user.listRow', ['userData'=>$users[$i]])
                </tr>



                @if ($i == 4)
                    @break // po 2 przejsciach petla for się zatrzyma
                @endif
                @break($i == 0) // działa tak samo jak to wyzej


                @endfor

                {{-- forelse odpali kod z else gdy tablica, kolekcja bedzie pusta a tak to to samo co foreach--}}
                <td colspan="3"> FORELSE</td>
                @forelse ($users as $user)
                    @include('user.listRow', ['userData'=>$user]) // tutaj wszadzi szablon z user.listRow
                @empty
                <tr>
                    <td>Lista jest pusta</td>
                </tr>
                @endforelse
                {{-- jest jeszcze while ale nic ciekawego tam nie ma  --}}

            </tr>
        </tbody>
    </table>

    @switch($users)
        @case(1)
            dziala tak samo jak wszedzie
            @break
        @case(2)

            @break
        @default

    @endswitch

</body>
@endsection

