@extends('page')

@section('content')

{{$courseList}}

<h1>Edit: {{$class->course->name}}</h1>
<hr>

<div class="row">
    <div class="col-md-5">
        <h5>Class Details</h5>
        {!! Form::model($class, ['url'=>'/classes/' . $class->id, 'method'=>'put']) !!}

        <div class="form-group">
            {!! Form::label("course_id", "Course") !!}
            {!! Form::select("course_id", $courseList, null, ['class'=>'form-control','placeholder'=>'Select course']) !!}
        </div>

        {!! Form::close() !!}
    </div>
    <div class="col-md-7">
        <h5>Time Schedule</h5>
    </div>
</div>

@endsection
