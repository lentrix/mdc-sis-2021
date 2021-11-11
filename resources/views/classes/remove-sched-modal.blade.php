<div class="modal fade" id="removeSchedModal" tabindex="-1" aria-labelledby="removeSchedModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="removeSchedModalLabel">Remove Schedule?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/classes/' . $class->id . '/remove-sched', 'method'=>'delete']) !!}
        <div class="modal-body">
            <div class="alert alert-danger">
                Are you sure you want to remove this schedule? <br>
                <span id="sched-summary"></span>
                <input type="hidden" name="schedule_id" id="schedule_id">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger"><i class="fa fa-trash-alt"></i> Remove Schedule</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>
