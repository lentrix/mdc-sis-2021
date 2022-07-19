@extends('page')

@section('content')

<a href="{{url('/venues')}}" class="btn btn-info float-right">
    <i class="fa fa-arrow-left"></i> Back to Venues
</a>

<h1>{{$venue->name}}</h1>
<hr>

<div class="row">
    <div class="col-md-3">
        <h4>Venue Details</h4>
        <table class="table table-striped">
            <tr>
                <th class="bg-secondary text-white">Name</th><td>{{$venue->name}}</td>
            </tr>
            <tr>
                <th class="bg-secondary text-white">Building</th><td>{{$venue->building}}</td>
            </tr>
            <tr>
                <th class="bg-secondary text-white">Capacity</th><td>{{$venue->capacity}}</td>
            </tr>

        </table>

        @if(auth()->user()->is('admin')) @include('venues.edit-venue-modal') @endif
    </div>
    <div class="col-md-9">
        <h4>Schedule of Classes</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="bg-info text-white">
                    <th>Code Name</th>
                    <th>Description</th>
                    <th>Schedule</th>
                    <th>Teacher</th>
                    <th class='text-center'>Learners</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scheds as $sched)
                <tr>
                    <td>{{$sched->subjectClass->course->name}}</td>
                    <td>{{$sched->subjectClass->course->description}}</td>
                    <td>{{$sched->summary}}</td>
                    <td>{{$sched->subjectClass->teacher->short_name}}</td>
                    <td class='text-center'>{{$sched->subjectClass->student_count}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
