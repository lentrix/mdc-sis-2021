@extends('page')

@section('content')

<div class="float-right">
    @include('users.mgt.add-user-modal')
</div>
<h1>Manage Users</h1>
<hr>
<div class="row">
    <div class="col-md-4">
        <h4>Search Users</h4>
        {!! Form::open(['url'=>'/user-mgt', 'method'=>'get']) !!}
            <div class="input-group">
                <input type="text" name="key" class="form-control small" placeholder="Search for..."
                    aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    <div class="col-md-8">
        <h4>{{$label}}</h4>
        <table class="table table-striped">
            <thead>
                <tr class="bg-primary text-white">
                    <th>User Name</th>
                    <th>Full Name</th>
                    <th class='text-right'><i class="fa fa-cog"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->user}}</td>
                    <td>{{$user->fname}} {{$user->lname}}</td>
                    <td class='text-right'>
                        <a href="{{url('/user-mgt/' . $user->id)}}" class="btn btn-sm btn-user btn-secondary btn-circle">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
