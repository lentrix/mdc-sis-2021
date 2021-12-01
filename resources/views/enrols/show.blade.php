@extends('page')

@section('content')

<div class="float-right">
    <a href="{{url('/students/' . $enrol->student_id)}}" class="btn btn-outline-info">
        <i class="fa fa-arrow-left"></i> Student Information
    </a>
</div>

<h1>View Enrollment</h1>
<hr>

<div class="row">
    <div class="col-md-3">
        <h4>Enrollment Details</h4>
        <table class="table table-bordered table-striped table-sm">
            <tr>
                <th class='bg-secondary text-white'>Student</th>
            </tr>
            <tr>
                <td>{{$enrol->student->last_name}}, {{$enrol->student->first_name}} {{$enrol->student->middle_name}}</td>
            </tr>
            <tr>
                <th class='bg-secondary text-white'>Program & Level</th>
            </tr>
            <tr>
                <td>{{$enrol->program->short_name}}-{{$enrol->level}}</td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <th class='bg-secondary text-white'>Section</th>
            </tr>
            <tr>
                <td>{{$enrol->section?->name}}</td>
            </tr>
            <tr>
                <th class='bg-secondary text-white'>Term</th>
            </tr>
            <tr>
                <td>{{$enrol->term->name}}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-9">
        <h4>Study Load</h4>
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>Couse No</th>
                    <th>Description</th>
                    <th>Schedule</th>
                    <th>Teacher</th>
                    <th class="text-center">Units</th>
                </tr>
            </thead>
            <tbody>
                <?php $totalUnits = 0; ?>
                @foreach($enrol->enrolSubjects as $subject)
                    <?php $totalUnits += $subject->subjectClass->credit_units; ?>
                <tr>
                    <td>{{$subject->subjectClass->course->name}}</td>
                    <td>{{$subject->subjectClass->course->description}}</td>
                    <td>{{$subject->subjectClass->schedule_string}}</td>
                    <td>{{$subject->subjectClass->teacher->name}}</td>
                    <td class="text-center">{{$subject->subjectClass->credit_units}}</td>
                </tr>

                @endforeach
                <tr>
                    <td colspan="4">TOTAL UNINTS</td>
                    <td class="text-center">{{$totalUnits}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
