<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createVenueModal">
    <i class="fa fa-plus"></i> Create Venue
</button>

  <!-- Modal -->
  <div class="modal fade" id="createVenueModal" tabindex="-1" aria-labelledby="createVenueModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createVenueModalLabel">Create Venue</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['url'=>'/venues', 'method'=>'post']) !!}
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
