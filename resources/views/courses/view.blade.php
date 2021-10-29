@extends('page')

@section('content')

<a href="{{url('/courses/search')}}" class="btn btn-info float-right"><i class="fa fa-arrow-left"></i> Back</a>

<h1>{{$course->description}}</h1>
<hr>
<div class="row">
    <div class="col-md-6">
        @include('courses.edit-course-modal')
        <h4>Course Details</h4>
        <table class="table table-bordered table-striped">
            <tr><th class="bg-secondary text-white">Code Name</th><td>{{$course->name}}</td></tr>
            <tr><th class="bg-secondary text-white">Description</th><td>{{$course->description}}</td></tr>
            <tr><th class="bg-secondary text-white">Credit Units</th><td>{{$course->credit}}</td></tr>
            <tr><th class="bg-secondary text-white">Requisite Course</th><td>{{$course->requisite ? $course->requisite->description:"none"}}</td></tr>
            <tr><th class="bg-secondary text-white">Department</th><td>{{$course->department?$course->department->name:"none"}}</td></tr>
            <tr><th class="bg-secondary text-white">Program</th><td>{{$course->program ? $course->program->full_name : "none"}}</td></tr>
        </table>
    </div>
    <div class="col-md-6">
        <h4>Course Offerings</h4>
        <table class="table table-bordered-table-striped">
            <thead>
                <tr class="bg-info">
                    <th>Schedule</th>
                    <th>Room</th>
                    <th>Teacher</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
