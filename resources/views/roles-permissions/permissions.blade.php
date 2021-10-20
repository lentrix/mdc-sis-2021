@extends('page')

@section('content')

@include('roles-permissions.edit-permission-modal')
@include('roles-permissions.delete-permission-modal')

<div class="float-right">
    @include('roles-permissions.add-permission-modal')
</div>

<h1>Permissions</h1>
<hr>
<div class="row">
    <div class="col-md-8">
        <table class="table table-bordered table-sm">
            <thead>
                <tr class="bg-primary text-white">
                    <th>Permission</th>
                    <th>Description</th>
                    <th class="text-center"><i class="fa fa-cog"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{$permission->permission}}</td>
                        <td>{{$permission->description}}</td>
                        <td class='text-center'>
                            <i class="fa fa-trash text-danger delete-permission"
                                    title="Delete this permission" style="cursor:pointer"
                                    data-id="{{$permission->id}}"
                                    data-permission="{{$permission->permission}}"></i>

                            <i class="fa fa-edit text-info edit-permission"
                                    title="Edit this permission" style="cursor:pointer"
                                    data-id="{{$permission->id}}"
                                    data-permission="{{$permission->permission}}"
                                    data-description="{{$permission->description}}"></i>
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

$(document).ready(function(){
    $(".edit-permission").click(function(e){
        var el = $(e.target)
        $("#editPermissionModal").modal('show')
        $("#edit-permission-field").val(el.data('permission'))
        $("#edit-description-field").val(el.data('description'))
        $(".permission_id").val(el.data('id'))
    })

    $(".delete-permission").click(function(e){
        var el = $(e.target)
        $("#deletePermissionModal").modal('show')
        $("#permission-name").text(el.data('permission'))
        $(".permission_id").val(el.data('id'))
    })
})

</script>

@endsection
