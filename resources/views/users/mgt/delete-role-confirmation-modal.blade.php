
<!-- Modal -->
<div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRoleModalLabel">Delete User Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url'=>"/user-mgt/$user->id/roles", 'method'=>'delete']) !!}
            <div class="modal-body">
                {!! Form::hidden('role-id', null,['id'=>'role-id']) !!}
                You are about to remove this role <span id="role-name"></span>. <br>
                Please confirm your action.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i> Close
                </button>
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-check"></i> Delete Role
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
