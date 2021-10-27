<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editTermModal">
    <i class="fa fa-edit"></i> Edit Term
</button>

  <!-- Modal -->
<div class="modal fade" id="editTermModal" tabindex="-1" aria-labelledby="editTermModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editTermModalLabel">Edit Term</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::model($term, ['url'=>'/terms/' . $term->id, 'method'=>'put']) !!}
        <div class="modal-body">

            @include('terms._term-form')

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div>
