@extends('page')

@section('content')

<h1>Terms</h1>
<hr>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Accronym</th>
            <th>Type</th>
            <th>Name</th>
            <th>Enrollment Period</th>
            <th>Start</th>
            <th>End</th>
            <th>Periods</th>
        </tr>
    </thead>
    <tbody>
        @foreach($terms as $term)
        <tr>
            <td>{{$term->accronym}}</td>
            <td>{{$term->type}}</td>
            <td>{{$term->name}}</td>
            <td>{{$term->enrol_start->format('M-d-Y')}} to {{$term->enrol_end->format('M-d-Y')}}</td>
            <td>{{$term->start->format('F d, Y')}}</td>
            <td>{{$term->end->format('F d, Y')}}</td>
            <td>{{count($term->periods)}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
