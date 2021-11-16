
@extends('page')

@section('content')

@include("sections.remove-class-modal")

<div class="float-right">
    <a href="{{url('/sections')}}" class="btn btn-info">
        <i class="fa fa-arrow-left"></i> Back to Sections
    </a>
    @if(auth()->user()->is('head') && auth()->user()->id===$section->department->head_id)
        @include('sections.update-section-modal',['section'=>$section])
    @endif
</div>

<h1>Section: {{$section->name}}</h1>
<hr>

<div class="row">
    <div class="col-md-7">
        <h4>Section Details</h4>
        <table class="table table-sm table-striped table-bordered">
            <tr><th>Section Name</th><td>{{$section->name}}</td></tr>
            <tr><th>Department</th><td>{{$section->department->name}}</td></tr>
            <tr><th>Program</th><td>{{$section->program->full_name}}</td></tr>
            <tr><th>Level</th><td>{{$section->level}}</td></tr>
            <tr><th>Teacher</th><td>{{$section->adviser->name}}</td></tr>
            <tr><th>Term</th><td>{{$section->term->name}}</td></tr>
        </table>

        @if(auth()->user()->is('head') && auth()->user()->id===$section->department->head_id)
            <div class="float-right">
                @include('sections.add-class-modal',['section'=>$section])
            </div>
        @endif
        <h4>Class Schedule</h4>
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr class="bg-info text-white">
                    <th>Course No</th>
                    <th>Description</th>
                    <th>Schedule</th>
                    <th class="text-center"><i class="fa fa-cog"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach($section->classSections as $class)
                <tr>
                    <td>{{$class->subjectClass->course->name}}</td>
                    <td>{{$class->subjectClass->course->description}}</td>
                    <td>{{$class->subjectClass->scheduleString}}</td>
                    <td>
                        <i class="fa fa-trash btn-sm text-danger remove-class"
                                data-id="{{$class->id}}"
                                data-name="{{$class->subjectClass->course->name}}"
                                data-description="{{$class->subjectClass->course->description}}"
                                style="cursor:pointer"
                                title="Remove this class"></i>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-5">
        <h4>List of Students</h4>
        <hr>
        <p>No implementation yet...</p>
    </div>
</div>
@endsection


@section('scripts')

<script>

$(document).ready(()=>{
    $("#course-selector").change((ev)=>{
        var id = $(ev.target).val()

        var el = $("#course-rows");
        el.empty()

        $.get('{{url("/api/offerings/")}}/' + id, function(response) {
            response.forEach(function(offering) {
                var tr = $(document.createElement("tr"))
                tr.append("<td>" + offering.name + "</td>")
                tr.append("<td>" + offering.description + "</td>")
                tr.append("<td>" + offering.schedule + "</td>")
                tr.append("<td>" + offering.teacher + "</td>")
                tr.append("<td><i class='fa fa-plus text-info add-course' style='cursor:pointer' data-id='" + offering.id + "'></i></td>")
                el.append(tr)
            })
        })
    })

    $(document).on("click", ".add-course", function(ev) {
        var el = $(ev.target)
        $("#subject_class_id").val(el.data('id'))
        $("#add-class-form").trigger('submit')
    })

    $(".remove-class").click(function(ev){
        var el = $(ev.target)

        $("#course-name").text(el.data('name'))
        $("#course-description").text(el.data('description'))
        $("#class_section_id").val(el.data('id'))
        $("#removeClassModal").modal('show')
    })
})

</script>

@endsection
