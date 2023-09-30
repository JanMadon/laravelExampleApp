@extends('layout.main')

@section('contentMain')
    <div class="card mt-3">
        @if (session('status'))
        {{session('status')}}    
        {{-- do wudoku został przekazanytaki return:
             return redirect() // przekierowanie na strone
            ->route('me.profile')
            ->with('status', 'Profil zaktualizowany');--}}
        @endif
        
        <h5 class="card-header">{{ $user->name }}</h5>
        <div class="card body">
            @if ($user->avatar)
                <img src="{{asset('storage/'.$user->avatar)}}" alt="" class="rounded mx-auto d-block user-avatar">
            @else
            <img src="" alt="">
                
            @endif

            <ul>
                <li>Nazwa: {{$user->name}}</li>
                <li>Email: {{$user->email}}</li>
                <li>Telefon: {{$user->phone}}</li>
            </ul>

            <div>
            <a href="{{route('me.edit')}}" class="btn btn-light">Edytuj dane</a>
            </div>
        </div>
    </div>
@endsection