@extends('page')

@section('content')

<a href="{{url('/programs/search')}}" class="btn btn-info float-right"><i class="fa fa-arrow-left"></i> Back</a>

<h1>{{$program->full_name}}</h1>
<hr>
<div class="row">
    <div class="col-md-4">
        <div class="d-flex align-items-center">
            <h4 style="flex:1">Program Details</h4>
            @if(auth()->user()->is('registrar'))
                @include('programs.edit-program-modal')
            @endif
        </div>
        <table class="table table-bordered table-striped table-sm">
            <tr><th>Short Name</th><td>{{$program->short_name}}</td></tr>
            <tr><th>Department</th><td>{{$program->department->name}}</td></tr>
            <tr><th>Program Head</th><td>{{$program->program_head}}</td></tr>
            <tr><th>Active Students</th><td>{{rand(10,100)}}</td></tr>
            <tr><th>Active Teachers</th><td>{{rand(10,100)}}</td></tr>
            <tr><th>Active Courses</th><td>{{rand(10,100)}}</td></tr>
        </table>
    </div>
    <div class="col-md-4">
        <h4>Students</h4>
    </div>
    <div class="col-md-4">
        <h4>Teachers</h4>
    </div>

</div>

@endsection
