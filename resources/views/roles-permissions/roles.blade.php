@extends('page')

@section('content')

@include('roles-permissions.delete-role-modal')
@include('roles-permissions.edit-role-modal')

<div class="float-right">
    @include('roles-permissions.add-role-modal')
</div>

<h1>Roles</h1>
<hr>
<div class="row">
    <div class="col-md-8">
        <table class="table table-bordered table-sm">
            <thead>
                <tr class="bg-primary text-white">
                    <th>Role</th>
                    <th>Description</th>
                    <th class="text-center"><i class="fa fa-cog"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->role}}</td>
                        <td>{{$role->description}}</td>
                        <td class='text-center'>

                            <i class="fa fa-trash text-danger delete-role" style="cursor: pointer"
                                    title="Delete role"
                                    data-role-id="{{$role->id}}"
                                    data-role="{{$role->role}}"></i>

                            <i class="fa fa-edit text-info edit-role" style="cursor: pointer"
                                    title="Edit role"
                                    data-role-id="{{$role->id}}"
                                    data-role="{{$role->role}}"
                                    data-description="{{$role->description}}"></i>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection


@section('scripts')
<script>
$(document).ready(function() {
    $(".delete-role").click(function(e){
        $("#deleteRoleModal").modal('show')
        var el = $(e.target)
        $("#role-name").text(el.data('role'))
        $(".role_id").val(el.data('role-id'))
    })

    $(".edit-role").click(function(e){
        $("#editRoleModal").modal('show')
        var el = $(e.target)
        $("#edit-role-field").val(el.data('role'))
        $("#edit-description-field").text(el.data('description'))
        $(".role_id").val(el.data('role-id'))
    })
})
</script>
@endsection
