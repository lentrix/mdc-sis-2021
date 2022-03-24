@extends("page")

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{url('/teacher-classes')}}">My Classes</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$subjectClass->course_no}}</li>
    </ol>
</nav>

<div class="float-right">
    <a href="{{url('/teacher-classes/' . $subjectClass->id . "/grading")}}" class="btn btn-info">
        <i class="fas fa-chart-bar"></i> Grading
    </a>
</div>

<div class="d-flex align-items-center">
    <h1>{{$subjectClass->course->name}} |</h1>
    <h4 class="ml-2">{{$subjectClass->course->description}}</h4>
</div>
<hr>

<div class="row">
    <div class="col-md-7">
        <h5>Class Details</h5>
        <table class="table table-bordered table-striped">
            <tr><th>Name</th><td>{{$subjectClass->course_no}}</td></tr>
            <tr><th>Description</th><td>{{$subjectClass->description}}</td></tr>
            <tr><th>Teacher</th><td>{{$subjectClass->teacher->name}}</td></tr>
            <tr><th>Pay Units</th><td>{{$subjectClass->pay_units}}</td></tr>
            <tr><th>Credit Units</th><td>{{$subjectClass->credit_units}}</td></tr>
            <tr><th>Limit</th><td>{{$subjectClass->limit}}</td></tr>
            <tr><th>Department</th><td>{{$subjectClass->department->name}}</td></tr>
            <tr><th>Term</th><td>{{$subjectClass->term->name}}</td></tr>
        </table>
        <h5>Time Schedule</h5>
        <table class="table table-striped">
            <tr class="bg-dark text-white">
                <th>Start</th>
                <th>End</th>
                <th>Day</th>
                <th>Venue</th>
            </tr>
            @foreach($subjectClass->schedules as $sched)

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
        @if(count($subjectClass->classList)>0)
            <div class="list-group">
            @foreach($subjectClass->classList as $index=>$enrol)

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
