<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addClassModal">
    <i class="fa fa-plus"></i> Add Class
  </button>

  <!-- Modal -->
  <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addClassModalLabel">Add Class to Section</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="mb-3">
                <select name="course" id="course-selector" class="form-control">
                    <option value="">Select a course</option>
                    @foreach($courses as $course)
                        <option value="{{$course->id}}">
                            {{$course->description}} &nbsp;&nbsp; [{{$course->name}}]
                        </option>
                    @endforeach
                </select>
            </div>

            <table class="table table-striped table-bordered table-sm">
                <thead>
                    <tr class="bg-info text-white">
                        <th>Course No.</th>
                        <th>Description</th>
                        <th>Schedule</th>
                        <th>Teacher</th>
                        <th><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody id="course-rows">

                </tbody>
            </table>

            {!! Form::open(['url'=>'/sections/' . $section->id . "/add-class", 'method'=>'post','id'=>'add-class-form']) !!}
                <input type="hidden" name="subject_class_id" id="subject_class_id">
            {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
