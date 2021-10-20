<div class="modal fade" id="editPermissionModal" tabindex="-1" aria-labelledby="editPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editPermissionModalLabel">Edit Permission</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/permissions', 'method'=>'put']) !!}
        <input type="hidden" name="permission_id" class="permission_id">
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label("permission", "Permission") !!}
                {!! Form::text("permission", null, ['class'=>'form-control','id'=>'edit-permission-field']) !!}
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
