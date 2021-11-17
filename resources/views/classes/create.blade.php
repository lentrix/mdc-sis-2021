@extends('page')

@section('content')

<h1>Create Subject Class</h1>
<hr>

{!! Form::open(['url'=>'/classes', 'method'=>'post']) !!}
<div class="row">
    <div class="col-md-5">
        <h4>Class Details</h4>

        <div class="form-group" style="position:relative">
            {!! Form::label("course_name", "Course") !!}
            {!! Form::text("course_name", null, ['class'=>'form-control','autocomplete'=>'off']) !!}
            <div id="course-search-result">
                <i class="fa fa-times float-right" id="close-course-search-result"></i>
                <div></div>
            </div>
            {!! Form::hidden("course_id", null) !!}
        </div>

        <div class="form-group">
            {!! Form::label("teacher_id", "Teacher") !!}
            {!! Form::select("teacher_id", $teachers, null, ["class"=>'form-control','placeholder'=>'Select a teacher']) !!}
        </div>

        <div class="d-flex">
            <div class="form-group mr-1">
                {!! Form::label("pay_units", "Pay Units") !!}
                {!! Form::text("pay_units", null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group ml-1">
                {!! Form::label("credit_units", "Credit Units") !!}
                {!! Form::text("credit_units", null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group ml-2">
                {!! Form::label("limit", "Limit") !!}
                {!! Form::text("limit", null, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label("term_id", "Term") !!}
            {!! Form::select("term_id", $terms, null, ['class'=>'form-control','placeholder'=>'Select a term']) !!}
        </div>
        <div class="form-group">
            {!! Form::label("department_id", "Department") !!}
            {!! Form::select("department_id", $departments, null, ['class'=>'form-control','placeholder'=>'Select a department']) !!}
        </div>

    </div>
    <div class="col-md-7">
        <h4>Class Schedule</h4>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    {!! Form::label("start", "Time Start") !!}
                    {!! Form::time("start", null, ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {!! Form::label("end", "Time End") !!}
                    {!! Form::time("end", null, ['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {!! Form::label("venue_id", "Venue") !!}
                    {!! Form::select("venue_id", $venues,null, ['class'=>'form-control','placeholder'=>'Select a venue']) !!}
                </div>
            </div>
        </div>
        <label for="">Select Days</label>
        <div class='day-picker'>
            @foreach(config('custom.days') as $dayIndex=>$day)
                <label for="{{$dayIndex}}">
                    <input type="checkbox"
                            id="{{$dayIndex}}"
                            value="{{$dayIndex}}"
                            name="days[]">
                    {{$day}}
                </label>
            @endforeach
        </div>

        <hr>

        <div class="alert alert-info">
            Make sure that you have set the details correctly and click Save...
        </div>

        <button class="btn btn-primary float-right" type="submit">
            <i class="fa fa-save"></i> Save Subject Class
        </button>

    </div>
</div>
{!! Form::close() !!}

@endsection


@section('scripts')

<script>
function fetchCourse(text) {
    $.get('{{url("api/course-search")}}/' + text, function(response) {
        $("#course-search-result").css('display','block')
        var el = $("#course-search-result div")
        el.empty()
        response.forEach(function(course) {
            a = $(document.createElement("a"))
            a.addClass('search-item')
            a.html(course.description + "<span class='float-right'>" + course.name +"</span>")
            a.data('id', course.id)
            a.data('name', course.name)
            a.data('description', course.description)
            el.append(a)
        })
    })
}

$(document).ready(()=>{
    $("#course_name").keyup((ev)=>{
        var text = $(ev.target).val()
        if(text.length>=3) {
            fetchCourse(text)
        }else {
            $("#course-search-result").css('display','none')
        }
    })

    $("#course_name").focusin(()=>{
        $("#course_name").select()
    })

    $("#close-course-search-result").click(()=>{
        $("#course_name").val('')
        $("#course-search-result ul").empty()
        $("#course-search-result").css('display','none')
    })

    $(document).on('click', 'a.search-item', function(ev){
        var el = $(ev.target)
        $("input[name=course_id]").val(el.data('id'))
        $("#course_name").val("[" + el.data('name') + "] " + el.data('description'))
        $("#course-search-result").css('display','none')
    })
})

</script>

@endsection
