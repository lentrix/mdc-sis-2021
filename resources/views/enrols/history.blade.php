@extends('page')

@section('content')

<div class="float-right">
    <a href="{{url('/students/' . $student->id)}}" class="btn btn-outline-info">
        <i class="fa fa-arrow-left"></i> Back
    </a>
</div>

<h1>Enrollment History</h1>
<hr>


@endsection
