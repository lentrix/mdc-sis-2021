<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPermissionModal">
    <i class="fa fa-plus"></i> Add Permission
</button>

  <!-- Modal -->
<div class="modal fade" id="addPermissionModal" tabindex="-1" aria-labelledby="addPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPermissionModalLabel">Add Permission</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/permissions', 'method'=>'post']) !!}
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label("permission", "Permission") !!}
                {!! Form::text("permission", null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label("description", "Description") !!}
                {!! Form::textarea("description", null, ['class'=>'form-control','rows'=>3]) !!}
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fa fa-times"></i> Close
          </button>
          <button type="submit" class="btn btn-primary">
              <i class="fa fa-plus"></i> Add Permission
          </button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
