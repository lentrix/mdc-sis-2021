<!-- Modal -->
<div class="modal fade" id="deletePermissionModal" tabindex="-1" aria-labelledby="deletePermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deletePermissionModalLabel">Delete Permission</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/permissions', 'method'=>'delete']) !!}
        <div class="modal-body">
            <input type="hidden" name="permission_id" class="permission_id">
            <div class="alert alert-danger">
                Are you sure you want to delete '<span id="permission-name"></span>' permission?
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fa fa-times"></i> Close
          </button>
          <button type="submit" class="btn btn-danger">
              <i class="fa fa-trash"></i> Delete Permission
          </button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
