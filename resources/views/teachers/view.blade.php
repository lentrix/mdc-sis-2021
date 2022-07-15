@extends('page')

@section('content')

<h1>{{$teacher->name}}</h1>
<hr>

<div class="row">
    <div class="col-md-4 d-flex justify-content-center align-items-center">
        <img src="{{$teacher->user->profile_pic}}" alt="Profile Pic" style="width: 250px; border-radius:50%; box-shadow: 0 2px 10px #888">
    </div>
    <div class="col-md-8">

        @if(auth()->user()->is('admin')) @include('teachers.edit-teacher-modal') @endif
        <h4>Teacher Details</h4>
        <table class="table table-bordered table-striped">
            <tr><th class="bg-secondary text-white">User Name</th><td>{{$teacher->user->user}}</td></tr>
            <tr><th class="bg-secondary text-white">Email</th><td>{{$teacher->user->email}}</td></tr>
            <tr><th class="bg-secondary text-white">Phone</th><td>{{$teacher->phone}}</td></tr>
            <tr><th class="bg-secondary text-white">Specialization</th><td>{{$teacher->specialization}}</td></tr>
            <tr><th class="bg-secondary text-white">Department</th><td>{{$teacher->department->name}}</td></tr>

        </table>
    </div>
</div>
<hr>
<div class="float-right">
    <a href="{{url('/pdf/teaching-load/' . $teacher->id)}}" target="_blank" class="btn btn-secondary btn-sm">
        <i class="far fa-file-pdf"></i> Teaching Load
    </a>
</div>
<h4>Teaching Load</h4>
<table class="table table-bordered table-striped">
    <thead>
        <tr class="bg-info text-white">
            <th>Course No</th>
            <th>Description</th>
            <th>Schedule</th>
            <th class="text-center">Learners</th>
            <th class="text-center">
                <i class="fa fa-cog"></i>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($subjectClasses as $class)
        <tr>
            <th>{{$class->course->name}}</th>
            <td>{{$class->course->description}}</td>
            <td>{{$class->scheduleString}}</td>
            <td class="text-center">{{$class->studentCount}}</td>
            <td class="text-center">
                <a href="{{url('/classes/' . $class->id)}}" class="btn btn-sm btn-success">
                    <i class="fa fa-eye"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
