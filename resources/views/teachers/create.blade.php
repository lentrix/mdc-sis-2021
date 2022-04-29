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

@section('scripts')

<script>

$(document).ready(()=>{
    $("#user_id").change((e)=>{
        const userId = $(e.target).val()
        fetch('{{url("/api/users/")}}/' + userId)
        .then((res)=>res.json())
        .then((data)=>{
            $("#name").val(data.fname + " " + data.lname)
            $("#short_name").val(data.fname.substring(0,1) + ". " + data.lname)
        })
    })
})

</script>

@endsection
