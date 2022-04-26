<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" title="Assign user as head" data-toggle="modal" data-target="#assignDepartmentHeadModal">
    <i class="fa fa-plus"></i>
  </button>

  <!-- Modal -->
  <div class="modal fade" id="assignDepartmentHeadModal" tabindex="-1" aria-labelledby="assignDepartmentHeadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="assignDepartmentHeadModalLabel">Assign Department Head</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::model($department, ['url'=>'/heads/' . $department->id,'method'=>'post']) !!}
        <div class="modal-body">

            <div class="form-group">
                {!! Form::label("user_id", "User") !!}
                {!! Form::select("user_id", $users, null, ['class'=>'form-control']) !!}
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>
