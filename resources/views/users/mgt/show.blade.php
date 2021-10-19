@extends('page')

@section('content')

<h1>View User</h1>
<hr>
<div class="row">
    <div class="col-md-4">
        <h4>User Details</h4>
        <table class="table table-striped">
            <tr><th>User Name</th><td>{{$user->user}}</td></tr>
            <tr><th>Last Name</th><td>{{$user->lname}}</td></tr>
            <tr><th>First Name</th><td>{{$user->fname}}</td></tr>
            <tr><th>Email</th><td>{{$user->email}}</td></tr>
        </table>
    </div>
    <div class="col-md-4">
        <button class="btn btn-secondary btn-sm float-left btn-circle mr-2" title="Add Role">
            <i class="fa fa-plus"></i>
        </button>
        <h4>User Roles</h4>
    </div>
    <div class="col-md-4">
        <button class="btn btn-secondary btn-sm float-left btn-circle mr-2" title="Add Permission">
            <i class="fa fa-plus"></i>
        </button>
        <h4>Additional Permissions</h4>
    </div>
</div>

@endsection
