<div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/roles', 'method'=>'put']) !!}
        <input type="hidden" name="role_id" class="role_id">
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label("role", "Role") !!}
                {!! Form::text("role", null, ['class'=>'form-control','id'=>'edit-role-field']) !!}
            </div>
            <div class="form-group">
                {!! Form::label("description", "Description") !!}
                {!! Form::textarea("description", null, ['class'=>'form-control','id'=>'edit-description-field','rows'=>3]) !!}
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fa fa-times"></i> Close
          </button>
          <button type="submit" class="btn btn-primary">
              <i class="fa fa-save"></i> Save Changes
          </button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
