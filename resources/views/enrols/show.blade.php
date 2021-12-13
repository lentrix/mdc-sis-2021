@extends('page')

@section('content')

@include('enrols.remove-class-modal')

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
                <td>{{$enrol->section ? $enrol->section->name : 'No Section'}}</td>
            </tr>
            <tr>
                <th class='bg-secondary text-white'>Term</th>
            </tr>
            <tr>
                <td>{{$enrol->term->name}}</td>
            </tr>
        </table>
        <a href="{{url('/enrols/edit/' . $enrol->id)}}" class="btn btn-info mt-3 btn-block">
            <i class="fa fa-edit"></i> Edit Enrolment
        </a>
    </div>
    <div class="col-md-9">
        @if(auth()->user()->is('registrar'))
            <div class="float-right">
                @include('enrols.add-class-modal')
            </div>
        @endif
        <h4>Study Load</h4>
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>Course No</th>
                    <th>Description</th>
                    <th>Schedule</th>
                    <th>Teacher</th>
                    <th class="text-center">Units</th>
                    <th><i class="fa fa-cog"></i></th>
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
                    <td>
                        <a href="#" class="fa fa-trash text-danger remove-class"
                            title="Remove {{$subject->subjectClass->course->name}}"
                            data-id="{{$subject->id}}"
                            data-name="{{$subject->subjectClass->course->name}}"
                            data-description="{{$subject->subjectClass->course->description}}"></a>
                    </td>
                </tr>

                @endforeach
                <tr>
                    <td colspan="4">TOTAL UNITS</td>
                    <td class="text-center">{{$totalUnits}}</td>
                </tr>
            </tbody>
        </table>
    </div>
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
