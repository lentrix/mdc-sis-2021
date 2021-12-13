
  <!-- Modal -->
  <div class="modal fade" id="restoreWithdrawnModal" tabindex="-1" aria-labelledby="restoreWithdrawnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="restoreWithdrawnModalLabel">Restore Enrollment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/enrols/restore/' . $enrol->id, 'method'=>'patch']) !!}
        <div class="modal-body">
            <div class="alert alert-success">
                You are about to restore this withdrawn enrollment. <br>
                Student: {{$enrol->student->fullName}} <br>
                Program & Year: {{$enrol->program->short_name}} - {{$enrol->level}} <br>
                Please confirm your action.
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Restore Enrollment</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
