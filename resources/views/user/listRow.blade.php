<tr>
    <td>{{$userData['id']}}</td>
    <td>{{$userData['name']}}</td>
    <td>
        <a href={{
            route('get.user.show',
            ['userId'=> $userData['id']])
            }}> Szczeguły
        </a>
    </td>
</tr>
{{-- szablon inkludowany ma dostęp do wszystkich zmiennych ze swojego rodzica,
    w sumie działa to tak jakby w miejscu @include('user.listRow') wkleić powyzszy kod),
    JEDNAK powino się przekazywać te zmienne w tablicy @include('user.listRow', ['userData'=> $user]) --}}
