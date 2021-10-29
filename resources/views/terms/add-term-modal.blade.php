<!-- Button trigger modal -->
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#createTermModal">
    <i class="fa fa-plus"></i> Create Term
</button>

  <!-- Modal -->
<div class="modal fade" id="createTermModal" tabindex="-1" aria-labelledby="createTermModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createTermModalLabel">Create Term</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/terms', 'method'=>'post']) !!}
        <div class="modal-body">

            @include('terms._term-form')

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Create Term</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>
