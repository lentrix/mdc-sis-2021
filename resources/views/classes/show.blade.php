@extends('page')

@section('content')

@if(auth()->user()->is('registrar'))
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
            <tr><th>Name</th><td>{{$class->course->name}}</td></tr>
            <tr><th>Description</th><td>{{$class->course->description}}</td></tr>
            <tr><th>Teacher</th><td>{{$class->teacher->name}}</td></tr>
            <tr><th>Pay Units</th><td>{{$class->pay_units}}</td></tr>
            <tr><th>Credit Units</th><td>{{$class->credit_units}}</td></tr>
            <tr><th>Limit</th><td>{{$class->limit}}</td></tr>
            <tr><th>Term</th><td>{{$class->term->name}}</td></tr>
        </table>
        <h5>Time Schedule</h5>
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
                <td>...</td>
            </tr>

            @endforeach
        </table>
    </div>
    <div class="col-md-5">
        <h5>List of Students</h5>
        <hr>
    </div>
</div>
@endsection
