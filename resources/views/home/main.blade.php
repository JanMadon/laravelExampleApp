@extends('layout.main')

@section('contentMain')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
    <div>
        <p>witaj: {{$user->name}}</p>
        <p> {{$user->email}}</p>
        <p> {{$user->password}}</p>
    </div>


    @if (session('message') === 1)
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">Success Card</div>

        </div>
    </div>
    @elseif (session('message') === 0)
    <div class="px-4 col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">Danger Card</div>

        </div>
    </div>
    @endif





@endsection

