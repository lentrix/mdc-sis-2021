<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary btn-sm mt-3 mr-3" data-toggle="modal" data-target="#addEducBackgroundModal">
    <i class="fas fa-plus"></i> Add
</button>

  <!-- Modal -->
<div class="modal fade" id="addEducBackgroundModal" tabindex="-1" aria-labelledby="addEducBackgroundModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addEducBackgroundModalLabel">Add Educational Background</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/students/educational-backgrounds/' . $student->id, 'method'=>'post']) !!}

        <div class="modal-body">
            @include('students.educ._form')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fa fa-times"></i> Close
          </button>
          <button type="submit" class="btn btn-info">
              <i class="fa fa-plus"></i> Add
          </button>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>
