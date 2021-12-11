<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm mb-2" data-toggle="modal" data-target="#addClassModal">
    <i class="fa fa-plus"></i> Add Class
  </button>

  <!-- Modal -->
  <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addClassModalLabel">Add Class</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#" class="nav-link active" data-target="add-by-serial">Add by Serial</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-target="search-class">Search Class</a>
                </li>
          </ul>
          <div class="tab-content" id="search-class" style="display:none; border-width: 0 1px 1px 1px; border-style: solid; border-color: #">
            <h3 class="mt-2">Search and Add Class</h3>
            <hr>
          </div>
          <div class="tab-content" id="add-by-serial">
            <h3 class="mt-2">Add Class by Serial Number</h3>
            <hr>
            {!! Form::open(['url'=>'/enrols/add-class-by-serial/' . $enrol->id,'method'=>'patch']) !!}

            {!! Form::label("serials", 'Enter Serial Numbers (separated by comma ",")') !!}
            {!! Form::textarea("serials", null, ['class'=>'form-control','rows'=>'3']) !!}

            <button class="btn btn-primary mt-3">Add Classes</button>

            {!! Form::close() !!}
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@section('scripts')

<script>

$(document).ready(()=>{
    $('.nav-link').click((e)=>{
        $('.nav-link').removeClass('active')
        $('.tab-content').css('display','none')
        var target = $(e.target).data('target')
        $(e.target).addClass('active')
        $("#" + target).css('display','block')
    })
})

</script>

@endsection
