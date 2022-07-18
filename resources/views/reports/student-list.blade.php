@extends('page')

@section('content')

<h1>Student List</h1>
<hr>
<div class="row">
    <div class="col-md-4">
        <h5>Filter</h5>
        {!! Form::open(['url'=>'/reports/student-list','method'=>'post']) !!}

        <div class="mb-3">
            {!! Form::label("section_id", "Section") !!}
            <div class="input-group">
                {!! Form::select("section_id", $sectionList, null, ['class'=>'form-control','placeholder'=>'Select section']) !!}
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit" name="submit">
                        <i class="fa fa-filter"></i>
                    </button>
                </div>
            </div>
        </div>

        {!! Form::close() !!}

        <hr>

        {!! Form::open(['url'=>'/reports/student-list','method'=>'post']) !!}

        <div class="mb-3">
            {!! Form::label("department_id", "Department") !!}
            <div class="input-group">
                {!! Form::select("department_id", $departmentList, null, ['class'=>'form-control','placeholder'=>'Select department']) !!}
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit" name="submit">
                        <i class="fa fa-filter"></i>
                    </button>
                </div>
            </div>
        </div>

        {!! Form::close() !!}

        <hr>

        {!! Form::open(['url'=>'/reports/student-list','method'=>'post']) !!}

        <div class="mb-3">
            {!! Form::label("program_id", "Program") !!}
            {!! Form::select("program_id", $programList, null, ['class'=>'form-control','placeholder'=>'Select a program']) !!}
        </div>

        <div class="mb-3">
            {!! Form::label("level", "Level") !!}
            {!! Form::select("level", $levelList, null, ['class'=>'form-control','placeholder'=>'Select a level']) !!}
        </div>

        <button class="btn btn-secondary btn-block" type="submit">
            <i class="fa fa-filter"></i> Program/Level
        </button>


        {!! Form::close() !!}


    </div>
    <div class="col-md-8">
        @if($list)
            <h5>{{$heading}}</h5>
            <ol>
            @foreach($list as $enrollee)

                <li>{{$enrollee->student->last_name}}, {{$enrollee->student->first_name}} {{$enrollee->program->short_name}}-{{$enrollee->level}}</li>

            @endforeach
            </ol>
        @endif
    </div>
</div>

@endsection
