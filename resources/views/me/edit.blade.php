@extends('layout.main')

@section('contentMain')
<div class="card mt-3">
    <h5 class="card-header">{{ $user->name }}</h5>
    <div class="card-body">

        {{-- wyswietlanie bledow --}}
        @if ($errors->any()) 
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{--
             laravel podczas gdy wprowadzone dane nie spałnią validacji w dostępnę so komunikaty błeów
            
        --}}

        <form action="{{ route('me.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- X-XSRF-TOKEN -->
            @if( $user-> avatar )
                <div>Jest avatar</div>
            @else
                <img src="/images/avatar.png" class="rounded mx-auto d-block">
            @endif

            <div class="form-group">
                <label for="name">Nazwa</label>
                <input
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    id="name"
                    name="name"
                    {{-- pobieranie starej wartości pola name // do jest aby tracić wisanych danych --}}
                    value="{{ old('name', $user->name) }}" 
                />
                @error('name')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Adres email</label>
                <input
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                >
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Telefon</label>
                <input
                    type="text"
                    class="form-control @error('phone') is-invalid @enderror"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $user->phone) }}"
                >
                {{-- taki error dizłą jak if (tzn jeśli istnieje error o takiej nazwie wyswietli diva) --}}
                @error('phone') 
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Zapisz dane</button>
            <a href="{{ route('me.profile') }}" class="btn btn-secondary">Anuluj</a>
        </form>
    </div>
</div>
@endsection
