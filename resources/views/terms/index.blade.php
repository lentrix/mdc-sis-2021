@extends('page')

@section('content')

<div class="float-right">
    @if(auth()->user()->is('admin')) @include('terms.add-term-modal') @endif
</div>

<h1>Terms</h1>
<hr>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Accronym</th>
            <th>Name</th>
            <th>Enrollment Period</th>
            <th>Start</th>
            <th>End</th>
            <th>Periods</th>
            <th><i class="fa fa-cog"></i></th>
        </tr>
    </thead>
    <tbody>
        @foreach($terms as $term)
        <tr>
            <td class="font-weight-bold">
                {{$term->accronym}}
            </td>
            <td>{{$term->name}}</td>
            <td>{{$term->enrol_start->format('M-d-Y')}} to {{$term->enrol_end->format('M-d-Y')}}</td>
            <td>{{$term->start->format('M-d-Y')}}</td>
            <td>{{$term->end->format('M-d-Y')}}</td>
            <td>{{count($term->periods)}}</td>
            <td>
                <a href="{{url('/terms/' . $term->id)}}" class="btn btn-sm fa fa-eye text-info"></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
