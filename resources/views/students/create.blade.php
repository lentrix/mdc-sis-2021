@extends('page')

@section('content')

<h1>Create New Student</h1>
<hr>
<div class="row">
    {!! Form::open(['url'=>'/students', 'method'=>'post']) !!}
    <div class="col-md-6">

    </div>
    <div class="col-md-6">

    </div>

    {!! Form::close() !!}
</div>

@endsection
