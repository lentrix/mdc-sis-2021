<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editDepartmentModal">
    <i class="fa fa-edit"></i> Edit Department
  </button>

  <!-- Modal -->
  <div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::model($department, ['url'=>'/departments/' . $department->id,'method'=>'put']) !!}
        <div class="modal-body">

            @include('departments._form',['department'=>$department])

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>
