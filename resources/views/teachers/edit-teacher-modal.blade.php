<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary btn-sm float-right" data-toggle="modal" data-target="#editTeacherModal">
    <i class="fa fa-edit"></i> Edit Teacher
</button>

  <!-- Modal -->
  <div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="editTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editTeacherModalLabel">Edit Teacher</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::model($teacher, ['url'=>'/teachers/' . $teacher->id,'method'=>'put']) !!}
        <div class="modal-body">
            @include('teachers._teacher-form')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
