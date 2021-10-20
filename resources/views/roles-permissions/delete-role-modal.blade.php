<!-- Modal -->
<div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteRoleModalLabel">Delete Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/roles', 'method'=>'delete']) !!}
        <div class="modal-body">
            <input type="hidden" name="role_id" class="role_id">
            <div class="alert alert-danger">
                Are you sure you want to delete <span id="role-name"></span> role?
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fa fa-times"></i> Close
          </button>
          <button type="submit" class="btn btn-danger">
              <i class="fa fa-trash"></i> Delete Role
          </button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
