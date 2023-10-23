@extends('layout.main')

@section('contentMain')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        DataTable Example
    </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nick</th>
                        <th>Opcje</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                    <tr>


                                <td>{{$user['id']}}</td>
                                <td>{{$user['name']}}</td>
                                <td>
                                    @can('view', $user)
                                    <a href={{
                                        route('get.user.show',
                                        ['userId'=> $user['id']])
                                        }}> Szczeguły
                                    </a>    
                                    @endcan
                                    
                                </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
</div>



@endsection

