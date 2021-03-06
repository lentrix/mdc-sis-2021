
<?php

function hasDay($days, $day) {
    $arr = explode(",", $days);
    return in_array($day, $arr);
}

?>

@extends('page')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{url('/classes')}}">Class Offerings</a></li>
      <li class="breadcrumb-item"><a href="{{url('/classes/' . $class->id)}}">{{$class->course_no}}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Class</li>
    </ol>
</nav>

@include('classes.remove-sched-modal')

<h1>Edit: {{$class->course->name}}</h1>
<hr>

<div class="row">
    <div class="col-md-5">
        <h5>Class Details</h5>
        {!! Form::model($class, ['url'=>'/classes/' . $class->id, 'method'=>'put']) !!}

        <div class="form-group" style="position:relative">
            {!! Form::label("course_name", "Course") !!}
            {!! Form::text("course_name", "[" . $class->course->name . "] " .$class->course->description, ['class'=>'form-control','autocomplete'=>'off']) !!}
            <div id="course-search-result">
                <i class="fa fa-times float-right" id="close-course-search-result"></i>
                <div></div>
            </div>
            {!! Form::hidden("course_id", null) !!}
        </div>

        <div class="form-group">
            {!! Form::label("teacher_id", "Teacher") !!}
            {!! Form::select("teacher_id", $teachers, null, ['class'=>'form-control','placeholder'=>'Select a teacher']) !!}
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
            {!! Form::select("department_id", $departments, $class->department_id, ['class'=>'form-control','placeholder'=>'Select a department']) !!}
        </div>
        <button class="btn btn-primary" type="submit">
            <i class="fa fa-save"></i> Save Changes
        </button>

        {!! Form::close() !!}
    </div>
    <div class="col-md-7">
        <h5>Time Schedule</h5>
        {!! Form::open(['url'=>'/classes/' . $class->id . "/add-sched", 'method'=>'post','class'=>'card']) !!}
        <div class="card-body">
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
        </div>
        <div class="card-footer">
            <button class="btn btn-info btn-sm float-right" type="submit">
                <i class="fa fa-plus"></i> Add Schedule
            </button>
        </div>

        {!! Form::close() !!}

        <table class="table table-striped">
            <tr class="bg-dark text-white">
                <th>Start</th>
                <th>End</th>
                <th>Day</th>
                <th>Venue</th>
                <th style="max-width: 30px;"><i class="fa fa-cog"></i></th>
            </tr>
            @foreach($class->schedules as $sched)

            <tr>
                <td>{{$sched->start->format('g:i A')}}</td>
                <td>{{$sched->end->format('g:i A')}}</td>
                <td>{{$sched->day}}</td>
                <td>{{$sched->venue->name}}</td>
                <td>
                    @include('classes._update-sched',['sched'=>$sched])
                    <i class="fa fa-trash-alt btn text-danger remove-sched"
                        title="Remove Schedule"
                        data-id="{{$sched->id}}"
                        data-start="{{$sched->start->format('g:i A')}}"
                        data-end="{{$sched->end->format('g:i A')}}"
                        data-day="{{$sched->day}}"
                        data-venue="{{$sched->venue->name}}"></i>
                </td>
            </tr>

            @endforeach
        </table>
    </div>
</div>

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

    $(".remove-sched").click((ev)=>{
        var el = $(ev.target)
        var schedText = el.data('start') + "-" + el.data('end') + " " + el.data('day') + " " + el.data('venue')
        $("#schedule_id").val(el.data('id'))
        $("#sched-summary").text(schedText)
        $("#removeSchedModal").modal('show')
        console.log(schedText)
    })
})

</script>

@endsection
