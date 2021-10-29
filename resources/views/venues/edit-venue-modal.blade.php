<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editVenueModal">
    <i class="fa fa-edit"></i> Edit Venue
</button>

  <!-- Modal -->
  <div class="modal fade" id="editVenueModal" tabindex="-1" aria-labelledby="editVenueModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editVenueModalLabel">Edit Venue</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::model($venue,['url'=>'/venues/' . $venue->id, 'method'=>'put']) !!}
        <div class="modal-body">
            @include('venues._venue-form')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
