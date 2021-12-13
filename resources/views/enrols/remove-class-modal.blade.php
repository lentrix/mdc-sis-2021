<div class="modal fade" id="removeClassModal" tabindex="-1" aria-labelledby="removeClassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="removeClassModalLabel">Remove Class</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/enrols/remove-class/' . $enrol->id, 'method'=>'patch']) !!}
        <div class="modal-body">
            <div class="alert alert-danger">
                You are about to remove <br>
                Course: <span id="course-name"></span><br>
                Description: <span id="course-description"></span>. <br>
                Please confirm you want to perform this action.
            </div>
            <input type="hidden" name="enrol_subject_id" id="enrol_subject_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger text-white"><i class="fa fa-trash"></i> Remove Class</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
