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
          <div class="tab-content" id="search-class" style="display:none;">
            <h3 class="mt-2">Search and Add Class</h3>
            <hr>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="search-key" placeholder="Search class" aria-label="Recipient's username" aria-describedby="search-button">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" id="search-button">
                      <i class="fa fa-search"></i>
                  </button>
                </div>
            </div>
            <ul id="search-result" class="list-group">
            </ul>
          </div>
          <div class="tab-content" id="add-by-serial">
            <h3 class="mt-2">Add Class by Serial Number</h3>
            <hr>
            {!! Form::open(['url'=>'/enrols/add-class-by-serial/' . $enrol->id,'method'=>'patch','id'=>'add-class-form']) !!}

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

@section('scripts2')

<script>

$(document).ready(()=>{
    $('.nav-link').click((e)=>{
        $('.nav-link').removeClass('active')
        $('.tab-content').css('display','none')
        var target = $(e.target).data('target')
        $(e.target).addClass('active')
        $("#" + target).css('display','block')
    })

    $('#search-button').click((e)=>{
        var key = $("#search-key").val()
        $.get("{{url('/api/subject-classes/search')}}/" + key, function(data, status) {
            if(status=="success") {
                var el = $("#search-result")
                data.forEach(function(currentValue, index) {
                    var row = document.createElement("li")
                    $(row).attr('href','#')
                    $(row).addClass('list-group-item')
                        .addClass('search-item')

                    var name = document.createElement('div')
                    $(name).addClass('font-weight-bold')
                    name.append(currentValue.course_no)

                    var des = document.createElement('div')
                    des.append(currentValue.description)

                    var sched = document.createElement('div')
                    sched.append(currentValue.scheduleString)

                    var btn = document.createElement('button')
                    $(btn).addClass('btn btn-secondary btn-sm float-right select-class')
                    $(btn).attr('type','button')
                    $(btn).attr('data-id', currentValue.id)
                    btn.append('Select')

                    row.append(btn)
                    row.append(name)
                    row.append(des)
                    row.append(sched)

                    el.append(row)
                })
            }
        })
    })

    $(document).on('click',".select-class", (e)=>{
        var id = $(e.target).data('id')
        $("#serials").text(id)
        $("#add-class-form").trigger('submit')
    })
})

</script>

@endsection
