@extends('page')

@section('content')

<h1>Promotional Report</h1>
<hr>

<div class="alert alert-success">
    The Promotional Report has been generated. Please click on the button below to download the file.
</div>

<a href="{{asset('reports/promotional_report.csv')}}" class="btn btn-success">
    Download Promotional Report File
</a>

@endsection
