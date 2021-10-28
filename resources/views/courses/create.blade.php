@extends('page')

@section('content')

<h1>Create Course</h1>
<hr>
<div class="row">
    <div class="col-md-5">
        {!! Form::open(['url'=>'/courses', 'method'=>'post']) !!}

        @include('courses._course-form')

        <div class="mb-3 mt-3">
            <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Create Course</button>
        </div>

        {!! Form::close() !!}
    </div>
</div>

@endsection
