<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#detachSectionModal">
    <i class="fas fa-unlink"></i>
    Detach from Section {{$section->name}}
  </button>

  <!-- Modal -->
  <div class="modal fade" id="detachSectionModal" tabindex="-1" aria-labelledby="detachSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detachSectionModalLabel">Detach from Section</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/enrols/detach-section/' . $enrol->id, 'method'=>'patch']) !!}
        <div class="modal-body">
            <div class="alert alert-danger">
                <strong>Warning!!!</strong> <br>
                This action will remove all the enrolled classes from this enrollment.
                Please proceed with caution
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submits" class="btn btn-danger">
              <i class="fas fa-unlink"></i>
              Detach Section
          </button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>
