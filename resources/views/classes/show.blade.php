@extends('page')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{url('/classes')}}">Class Offerings</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$class->course_no}}</li>
    </ol>
</nav>

@if($class->department->isHeadedBy(auth()->user()))
<div class="float-right">
    <a href="{{url('/classes/' . $class->id . "/edit")}}" class="btn btn-info">
        <i class="fa fa-edit"></i> Edit Class Offering
    </a>
</div>
@endif

<div class="d-flex align-items-center">
    <h1>{{$class->course->name}} |</h1>
    <h4 class="ml-2">{{$class->course->description}}</h4>
</div>
<hr>

<div class="row">
    <div class="col-md-7">
        <h5>Class Details</h5>
        <table class="table table-bordered table-striped">
            <tr><th>Name</th><td>{{$class->course_no}}</td></tr>
            <tr><th>Description</th><td>{{$class->description}}</td></tr>
            <tr><th>Teacher</th><td>{{$class->teacher->name}}</td></tr>
            <tr><th>Pay Units</th><td>{{$class->pay_units}}</td></tr>
            <tr><th>Credit Units</th><td>{{$class->credit_units}}</td></tr>
            <tr><th>Limit</th><td>{{$class->limit}}</td></tr>
            <tr><th>Department</th><td>{{$class->department->name}}</td></tr>
            <tr><th>Term</th><td>{{$class->term->name}}</td></tr>
        </table>
        <h5>Time Schedule</h5>
        <table class="table table-striped">
            <tr class="bg-dark text-white">
                <th>Start</th>
                <th>End</th>
                <th>Day</th>
                <th>Venue</th>
            </tr>
            @foreach($class->schedules as $sched)

            <tr>
                <td>{{$sched->start->format('g:i A')}}</td>
                <td>{{$sched->end->format('g:i A')}}</td>
                <td>{{$sched->day}}</td>
                <td>{{$sched->venue->name}}</td>
            </tr>

            @endforeach
        </table>
    </div>
    <div class="col-md-5">
        <h5>List of Students</h5>
        <hr>
        @if(count($class->classList)>0)
            <div class="list-group">
            @foreach($class->classList as $index=>$enrol)

                <a href="{{url('/enrols/current/' . $enrol->id)}}" class="list-group-item list-group-item-action">
                    {{$index+1}}. {{$enrol->student->full_name}} {{$enrol->program->short_name}}-{{$enrol->level}}
                </a>

            @endforeach
            </div>
        @else
            <span clas="text-black-50">No enrolees yet.</span>
        @endif

    </div>
</div>
@endsection
