@extends('page')

@section('content')

<h1>Change Password</h1>
<hr>
<div class="row">
    <div class="col-md-5">
        {!! Form::open(['url'=>'/users/change-password', 'method'=>'post']) !!}
            {!! Form::hidden("user_id", $user->id) !!}
        <div class="input-group mb-3">
            {!! Form::label("current_password", "Current Password", ['class'=>'input-group-text', 'style'=>'width: 150px']) !!}
            {!! Form::password("current_password", ['class' => 'form-control']) !!}
        </div>
        <hr>
        <div class="input-group mb-3">
            {!! Form::label("new_password", "New Password", ['class'=>'input-group-text', 'style'=>'width: 150px']) !!}
            {!! Form::password("new_password", ['class' => 'form-control']) !!}
        </div>
        <div class="input-group mb-3">
            {!! Form::label("new_password_confirmation", "Confirm Password", ['class'=>'input-group-text', 'style'=>'width: 150px']) !!}
            {!! Form::password("new_password_confirmation", ['class' => 'form-control']) !!}
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-success" type="submit">
                <i class="fa fa-save"></i> Change Password
            </button>
        </div>

        {!! Form::close() !!}
    </div>
</div>

@endsection
