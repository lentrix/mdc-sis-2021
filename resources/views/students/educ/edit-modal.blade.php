<!-- Modal -->
<div class="modal fade" id="editEducBackgroundModal" tabindex="-1" aria-labelledby="editEducBackgroundModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editEducBackgroundModalLabel">Edit Educational Background</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/students/educational-backgrounds/' . $student->id, 'method'=>'put']) !!}
            {!! Form::hidden("id", null, ['id'=>'educ_id']) !!}
        <div class="modal-body">
            @include('students.educ._form')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fa fa-times"></i> Close
          </button>
          <button type="submit" class="btn btn-info">
              <i class="fa fa-save"></i> Save Changes
          </button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
