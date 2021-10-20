
<!-- Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoleModalLabel">Add User Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url'=>'/user-mgt/roles', 'method'=>'post']) !!}
            <div class="modal-body">
                {!! Form::hidden("user_id", $user->id) !!}
                <div class="form-group">
                    {!! Form::select("role", $roles, null, ['class'=>'form-control','placeholder'=>'Select a role']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i> Close
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-check"></i> Add Role
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
