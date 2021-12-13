<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#withdrawEnrollModal">
    <i class="fa fa-ban"></i> Withdraw Enrollment
</button>

<!-- Modal -->
<div class="modal fade" id="withdrawEnrollModal" tabindex="-1" aria-labelledby="withdrawEnrollModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="withdrawEnrollModalLabel">Withdraw Enrollment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/enrols/withdraw/' . $enrol->id,'method'=>'patch']) !!}
        <div class="modal-body">
          <div class="alert alert-danger">
              You are about to withdraw this enrollment. Please confirm your action.
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger"><i class="fa fa-ban"></i> Withdraw Enrollment</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>
