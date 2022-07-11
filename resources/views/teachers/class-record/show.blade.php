@extends('page')

@section('content')

<div class="float-right">
    @include('teachers.class-record._add-column')
</div>
<h1>Class Record</h1>
<div>{{$subjectClass->course->name}} - {{$subjectClass->schedule_string}}</div>
<hr>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" href="#">Active</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
    </li>
</ul>

@endsection
