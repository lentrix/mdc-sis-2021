@extends('page')

@section('content')

<h1>Change Password</h1>
<hr>
<div class="row">
    <div class="col-md-5">
        {!! Form::open(['url'=>'/users/change-password', 'method'=>'post']) !!}
            {!! Form::hidden("user_id", $user->id) !!}
        <div class="input-group mb-3">
            <span class="input-group-text bg-info text-white" style="width: 45px"><i class="fas fa-lock"></i></span>
            {!! Form::password("current_password", ['class' => 'form-control','placeholder'=>'Current Password']) !!}
        </div>
        <hr>
        <div class="input-group mb-3">
            <span class="input-group-text bg-success text-white" style="width: 45px"><i class="fas fa-key"></i></span>
            {!! Form::password("new_password", ['class' => 'form-control','placeholder'=>'New Password']) !!}
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text bg-success text-white" style="width: 45px"><i class="fas fa-key"></i></span>
            {!! Form::password("new_password_confirmation", ['class' => 'form-control','placeholder'=>'Confirm New Password']) !!}
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
