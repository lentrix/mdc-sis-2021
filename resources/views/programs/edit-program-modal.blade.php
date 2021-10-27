<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editProgramModal">
    <i class="fa fa-edit"></i> Edit Program
  </button>

  <!-- Modal -->
  <div class="modal fade" id="editProgramModal" tabindex="-1" aria-labelledby="editProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProgramModalLabel">Program Program</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::model($program, ['url'=>'/programs/' . $program->id, 'method'=>'put']) !!}
        <div class="modal-body">
            @include('programs._program-form',['deptList'=>$deptList])
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
