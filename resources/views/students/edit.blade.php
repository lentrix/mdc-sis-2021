@extends('page')

@section('content')

<button class="btn btn-primary float-right" type="button" id="submit">
    <i class="fa fa-save"></i> Save Student Information
</button>

<h1>Create New Student</h1>
<hr>

{!! Form::model($student,['url'=>'/students/' . $student->id, 'method'=>'put','id'=>'form']) !!}
@include('students._form')
{!! Form::close() !!}

@endsection


@section('scripts')

<script>
    $(document).ready(()=>{
        $("#submit").click(()=>{
            $("#form").trigger('submit')
        })
    })
</script>

@endsection
