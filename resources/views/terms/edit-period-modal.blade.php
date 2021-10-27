<!-- Modal -->
<div class="modal fade" id="editPeriodModal" tabindex="-1" aria-labelledby="editPeriodModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editPeriodModalLabel">Edit Period</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/periods', 'method'=>'put']) !!}
        {!! Form::hidden("period_id", null, ['id'=>'period_id']) !!}
        <div class="modal-body">
            @include('terms._period-form', ['term'=>$term])
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>
