<!-- Modal -->
<div class="modal fade" id="deletePeriodModal" tabindex="-1" aria-labelledby="deletePeriodModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deletePeriodModalLabel">Delete Period</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/periods', 'method'=>'delete']) !!}
        <div class="modal-body">
            <input type="hidden" id="delete_period_id" name="period_id">
            <div class="alert alert-danger">
                You are about to delete the period "<span id="periodName"></span>". Are you certain about this?
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete Period</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>
