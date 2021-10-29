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
<h4>Teaching Load</h4>
<table class="table table-bordered table-striped">
    <thead>
        <tr class="bg-info text-white">
            <th>Code Name</th>
            <th>Description</th>
            <th>Schedule</th>
            <th>Venue</th>
            <th>Learners</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>SMP 100</th>
            <td>Sample Class Description</td>
            <td>8:00-9:00 MTW</td>
            <td>Room 203</td>
            <td>37</td>
        </tr>
    </tbody>
</table>

@endsection
