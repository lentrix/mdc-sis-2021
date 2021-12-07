@extends('page')

@section('content')

<h1>Edit Enrollment</h1>
<hr>

<div class="row">
    <div class="col-md-5">
        <table class="table table-striped table-border">
            <tr>
                <th>Student</th><td>{{$enrol->student->full_name}}</td>
            </tr>
            <tr><th>Program</th><td>{{$enrol->program->short_name}}</td></tr>
            <tr><th>Level</th><td>{{$enrol->level}}</td></tr>
            <tr><th>Term</th><td>{{$enrol->term->name}}</td></tr>
            <tr><th>Section</th><td>{{$enrol->section->name}}</td></tr>
        </table>
    </div>
    <div class="col">
        <div class="alert alert-warning">
            This enrollment cannot be updated because it is attached to a section. <br>
            <strong>Section: {{$enrol->section->name}}</strong>
        </div>

        @include('enrols.detach-section-confirm-modal', ['section'=>$enrol->section])
    </div>
</div>


@endsection
