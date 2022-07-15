@extends('page')

@section('content')

@include('enrols.remove-class-modal')
@include('enrols.restore-withdrawn-modal')

@if(auth()->user()->is('registrar'))
<div class="float-right">
    <a href="{{url('/students/' . $enrol->student_id)}}" class="btn btn-outline-info">
        <i class="fa fa-arrow-left"></i> Student Information
    </a>
</div>
@endif

<h1>View Enrollment</h1>
<hr>

<div class="row position-relative py-2">
    <div class="col-md-3">
        <h4>Enrollment Details</h4>
        <table class="table table-bordered table-sm">
            <tr><th class="bg-secondary text-white">ID Number</th></tr>
            <tr><td>{{str_pad($enrol->student->id_number, 7, "0", STR_PAD_LEFT)}}-{{$enrol->student->id_extension}}</td></tr>
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
                <td>{{$enrol->section ? $enrol->section->name : 'No Section'}}</td>
            </tr>
            <tr>
                <th class='bg-secondary text-white'>Term</th>
            </tr>
            <tr>
                <td>{{$enrol->term->name}}</td>
            </tr>
        </table>
        @if(auth()->user()->is('registrar'))
        <a href="{{url('/enrols/edit/' . $enrol->id)}}" class="btn btn-info mt-3 btn-block">
            <i class="fa fa-edit"></i> Edit Enrolment
        </a>
        @endif
    </div>
    <div class="col-md-9">
        @if((auth()->user()->is('registrar') || (auth()->user()->is('head') && auth()->user()->isHeadOf($enrol->program->department))) && !$enrol->withdrawn)
            <div class="float-right">
                @include('enrols.add-class-modal')
            </div>
        @endif
        <div class="float-right mr-2">
            <a href="{{url('/pdf/study-load/' . $enrol->id)}}" target="_blank" class="btn btn-secondary btn-sm">
                <i class="far fa-file-pdf"></i> Study Load
            </a>
        </div>
        <h4>Study Load</h4>
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>Course No</th>
                    <th>Description</th>
                    <th>Schedule</th>
                    <th>Teacher</th>
                    <th class="text-center">Units</th>
                    @if(!$enrol->withdrawn && (auth()->user()->is('registrar') || (auth()->user()->is('head') && auth()->user()->isHeadOf($enrol->program->department))))
                        <th><i class="fa fa-cog"></i></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <?php $totalUnits = 0; ?>
                <?php $subjects = $enrol->withdrawn ? $enrol->withdrawnSubjects : $enrol->enrolSubjects; ?>
                @foreach($subjects as $subject)
                    <?php $totalUnits += $subject->subjectClass->credit_units; ?>
                <tr>
                    <td>
                        <a href="{{url('/classes/' . $subject->subject_class_id)}}" class="nav-link">
                            {{$subject->subjectClass->course->name}}
                        </a>
                    </td>
                    <td>{{$subject->subjectClass->course->description}}</td>
                    <td>{{$subject->subjectClass->schedule_string}}</td>
                    <td>{{$subject->subjectClass->teacher->name}}</td>
                    <td class="text-center">{{$subject->subjectClass->credit_units}}</td>
                    @if(!$enrol->withdrawn && (auth()->user()->is('registrar') || (auth()->user()->is('head') && auth()->user()->isHeadOf($enrol->program->department))))
                    <td>
                        <a href="#" class="fa fa-trash text-danger remove-class"
                            title="Remove {{$subject->subjectClass->course->name}}"
                            data-id="{{$subject->id}}"
                            data-name="{{$subject->subjectClass->course->name}}"
                            data-description="{{$subject->subjectClass->course->description}}"></a>
                    </td>
                    @endif
                </tr>

                @endforeach
                <tr>
                    <td colspan="4">TOTAL UNITS</td>
                    <td class="text-center">{{$totalUnits}}</td>
                </tr>
            </tbody>
        </table>
        <hr>
        @if(auth()->user()->is('registrar') && !$enrol->withdrawn)

        <div class="alert alert-danger d-flex" style="margin-top: 200px">
            <div style="flex: 1">
                Withdraw this enrollment.
            </div>
            @include('enrols.withdraw-enroll-modal')
        </div>

        @endif
    </div>
    @if($enrol->withdrawn)
    <div class="overlay">
        <h1>Withdrawn</h1>
        <hr>
        by: {{$enrol->withdrawnBy->fullName}} on {{$enrol->withdrawn_at->format('F d, Y g:i A')}}
        <br>
        <br>
        <button type="button" class="btn btn-success shadow" data-toggle="modal" data-target="#restoreWithdrawnModal">
            Restore Enrollment
        </button>
    </div>
    @endif
</div>


@endsection

@section('scripts')

<script>

$(document).ready(()=>{
    $(".remove-class").click((e)=>{
        e.preventDefault()
        var el = $(e.target)
        var id = el.data('id')
        var name = el.data('name')
        var description = el.data('description')

        $("#course-name").text(name)
        $("#course-description").text(description)
        $("#enrol_subject_id").val(id)

        $("#removeClassModal").modal('show')
    })
})

</script>

@endsection
