<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRoleModal">
    <i class="fa fa-plus"></i> Add Role
</button>

  <!-- Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addRoleModalLabel">Add Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/roles', 'method'=>'post']) !!}
        <div class="modal-body">
            <div class="form-group">
                {!! Form::label("role", "Role") !!}
                {!! Form::text("role", null, ['class'=>'form-control']) !!}
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
              <i class="fa fa-plus"></i> Add Role
          </button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
