<div class="modal fade" id="removeClassModal" tabindex="-1" aria-labelledby="removeClassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="removeClassModalLabel">Remove Class From Section</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/sections/' . $section->id . '/remove-class', 'method'=>'delete']) !!}
        <div class="modal-body">
            <div class="alert alert-danger">
                You are about to remove the following class from this section:
                <strong><span id="course-name"></span> <span id="course-description"></span></strong>
                <input type="hidden" name="class_section_id" id="class_section_id">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Remove Class</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>
