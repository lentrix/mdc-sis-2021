@extends('page')

@section('content')

@include('users.mgt.add-role-modal',['roles'=>$roles])
@include('users.mgt.add-permission-modal',['roles'=>$permissions])

<h1>View User</h1>
<hr>
<div class="row">
    <div class="col-md-4">
        <h4>User Details</h4>
        @if(!$user->active)
        <div class="alert alert-warning">
            This user account is INACTIVE.
        </div>
        @endif
        <table class="table table-striped">
            <tr><th>User Name</th><td>{{$user->user}}</td></tr>
            <tr><th>Last Name</th><td>{{$user->lname}}</td></tr>
            <tr><th>First Name</th><td>{{$user->fname}}</td></tr>
            <tr><th>Email</th><td>{{$user->email}}</td></tr>
        </table>
        @include('users.mgt.edit-user-modal',['user'=>$user])
        @include('users.mgt.change-password-modal',['user'=>$user])
        @include('users.mgt.toggle-user-activation-modal',['user'=>$user])

    </div>
    <div class="col-md-4">
        <button class="btn btn-secondary btn-sm float-left btn-circle mr-2" title="Add Role" data-toggle="modal" data-target="#addRoleModal">
            <i class="fa fa-plus"></i>
        </button>
        <h4>User Roles</h4>
        @if(count($user->userRoles)>0)
        <ul class="list-group">
            @foreach($user->userRoles as $userRole)
                <li class="list-group-item d-flex">
                    <div style="text-transform: uppercase; flex:1">{{$userRole->role->role}}</div>
                    <div>
                        <button class="btn text-danger btn-sm" title="Remove this role">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
        @else
            <p>This user has no role</p>
        @endif
    </div>
    <div class="col-md-4">
        <button class="btn btn-secondary btn-sm float-left btn-circle mr-2" title="Add Permission" data-toggle="modal" data-target="#addPermissionModal">
            <i class="fa fa-plus"></i>
        </button>
        <h4>Additional Permissions</h4>
        @if(count($user->userPermissions)>0)
            <ul class="list-group">
                @foreach($user->userPermissions as $userPermission)
                    <li class="list-group-item d-flex">
                        <div style="flex: 1; text-transform:uppercase">{{$userPermission->permission->permission}}</div>
                        <div>
                            <button class="btn text-danger btn-sm" title="Delete this permission">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>This user has no additional permission</p>
        @endif
    </div>
</div>

@endsection
