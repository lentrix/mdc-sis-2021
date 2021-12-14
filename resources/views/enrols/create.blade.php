@extends('page')

@section('content')

<div class="float-right">
    <a href="{{url('/students/' . $student->id)}}" class="btn btn-outline-info">
        <i class="fa fa-arrow-left"></i> Back
    </a>
</div>

@if(auth()->user()->is('registrar'))

    <h1>Create Enrollment</h1>
    <h5>
        <strong>[{{$student->id_number}}-{{$student->id_extension}}]</strong>
        <u>{{$student->last_name}}, {{$student->first_name}} {{$student->middle_name}}</u>
    </h5>
    <hr>

    <div class="row">

        <div class="col-md-4">
            <h4>Basic Enroll</h4>
            <hr>
            {!! Form::open(['url'=>'/enrols/' . $student->id, 'method'=>'post']) !!}

                {!! Form::hidden("student_id", $student->id) !!}

                @include('enrols._form')

                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fa fa-check"></i> Enroll
                    </button>
                </div>

            {!! Form::close() !!}
        </div>

        <div class="col-md-8">
            <h4>Blocked Section</h4>
            <hr>
            {!! Form::open(['url'=>'/enrols/sectioned/' . $student->id, 'method'=>'post', 'id'=>'section_form']) !!}
                {!! Form::hidden("section_id", null,['id'=>'section_id']) !!}
            {!! Form::close() !!}

            <div class="form-group">
                {!! Form::label("department_id", "Department") !!}
                {!! Form::select("department_id", $departments, null, ['class'=>'form-control','placeholder'=>'Filter by department']) !!}
            </div>

            <table class="table table-bordered table-striped">
                <tr class="bg-info text-white">
                    <th>Section Name</th>
                    <th>Program</th>
                    <th>Level</th>
                    <th>Adviser</th>
                    <th class='text-center'><i class="fa fa-cog"></i></th>
                </tr>
                <tbody id="section-rows">
                </tbody>
            </table>

        </div>


    </div>
@else

    <div class="mt-5 alert alert-warning">This student is not yet enrolled for this term.</div>

@endif

@endsection


@section('scripts')

<script>

$(document).ready(function(){

    $("#department_id").change((ev)=>{
        var el = $(ev.target)

        $.get('{{url("/api/sections/")}}/' + el.val(), function(response) {
            var tbody = $("#section-rows")
            tbody.empty()
            response.forEach(function(section) {
                tbody.append("<td>" + section.name + "</td>")
                tbody.append("<td>" + section.program.short_name + "</td>")
                tbody.append("<td>" + section.level + "</td>")
                tbody.append("<td>" + section.adviser.name + "</td>")
                tbody.append("<td class='text-center'><button class='btn btn-primary section-enrol-btn' data-id='" + section.id + "'><i class='fa fa-arrow-right' data-id='" + section.id + "'></i></button></td>")
            })
        })
    })

    $(document).on('click','.section-enrol-btn', function(ev){
        var el = $(ev.target)
        var sectionId = el.data('id')

        $("#section_id").val(sectionId)

        $("#section_form").trigger('submit')
    })

})

</script>

@endsection
