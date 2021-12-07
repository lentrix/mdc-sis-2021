@extends('page')

@section('content')

<h1>Edit Enrollment</h1>
<hr>
<h4>{{$enrol->student->full_name}}</h4>
<hr>

<div class="row">
    <div class="col-md-6">
        {!! Form::model($enrol, ['url'=>'/enrols/edit/' . $enrol->id, 'method'=>'put']) !!}

        <div class="form-group">
            {!! Form::label("program_id", "Program") !!}
            {!! Form::select("program_id", $programs, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('level', "Level") !!}
            {!! Form::select("level", $levels, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('term_id', "Term") !!}
            {!! Form::select("term_id", $terms, null, ['class'=>'form-control']) !!}
        </div>

        <button class="btn btn-info">
            <i class="fa fa-save"></i>
            Save Changes
        </button>

        {!! Form::close() !!}
    </div>
    <div class="col-md-6">
        {!! Form::open(['url'=>'/enrols/attach-section/' . $enrol->id, 'method'=>'patch']) !!}

        <div class="form-group">
            {!! Form::label("section_id", 'Section') !!}
            {!! Form::select('section_id', $sections, null, ['class'=>'form-control','placeholder'=>'Select a section']) !!}
        </div>

        <div class="alert alert-warning">
            Warning!!! <br>
            This action will remove all currently enrolled classes and will be replaced by
            the classes under the selected section. Consequently the program, level, and term
            of this enrollment will also be aligned with the selected section.
        </div>

        <button class="btn btn-info" type="submit">
            <i class="fas fa-link"></i>
            Attach to Section
        </button>

        {!! Form::close() !!}
    </div>
</div>
@endsection
