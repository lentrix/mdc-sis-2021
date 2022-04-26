<button type="button" class="btn btn-danger btn-sm" title="Remove user as head" data-toggle="modal" data-target="#removeDepartmentHead_{{$head->id}}_Modal">
    <i class="fa fa-trash"></i>
</button>

  <!-- Modal -->
  <div class="modal fade" id="removeDepartmentHead_{{$head->id}}_Modal" tabindex="-1" aria-labelledby="removeDepartmentHead_{{$head->id}}_ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="removeDepartmentHead_{{$head->id}}_ModalLabel">Remove Department Head</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::model($department, ['url'=>'/heads/' . $head->id,'method'=>'delete']) !!}
        <div class="modal-body">

            <div class="alert alert-danger">
                Are you sure you want to remove {{$head->user->full_name}}
                as Head of {{$head->department->accronym}}?
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Yes, please!</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>
