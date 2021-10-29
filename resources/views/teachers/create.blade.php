@extends('page')

@section('content')

<h1>Create Teacher</h1>
<hr>

<div class="row">
    <div class="col-md-6">
        {!! Form::open(['url'=>'/teachers', 'method'=>'post']) !!}

        @include('teachers._teacher-form')

        <div class="form-group">
            <button class="btn btn-primary">Save Teacher</button>
        </div>

        {!! Form::close() !!}
    </div>
</div>

@endsection
