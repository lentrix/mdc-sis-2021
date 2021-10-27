@extends('page')

@section('content')

<h1>Create Program</h1>
<hr>

<div class="row">
    <div class="col-md-6">
        {!! Form::open(['url'=>'/programs', 'method'=>'post']) !!}
            @include('programs._program-form',['deptList'=>$deptList])

            <button class="btn btn-primary"><i class="fa fa-save"></i> Save Program</button>
        {!! Form::close() !!}
    </div>
</div>

@endsection
