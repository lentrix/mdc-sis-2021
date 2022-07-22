@extends('page')

@section('content')

<h1>Enrollment List</h1>
<hr>
<div class="alert alert-success">
    The Enrollment List report has been generated. Please click the button below to download the report file.
</div>
<a href="{{asset('reports/enrolment_list.csv')}}" class="btn btn-success">
    Download Enrollment List
</a>


@endsection
