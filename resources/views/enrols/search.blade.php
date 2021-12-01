@extends('page')

@section('content')


<h1>Search Enrollment</h1>
<hr>

<div class="row">
    <div class="col-md-3">

        {!! Form::open(['url'=>'/enrols', 'method'=>'get']) !!}

        <div class="form-group">
            {!! Form::label("last_name", "Last Name") !!}
            {!! Form::text("last_name", $request->last_name, ["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::label("first_name", "First Name") !!}
            {!! Form::text("first_name", $request->first_name, ["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::label("program_id", "Program") !!}
            {!! Form::select("program_id", $programs, $request->program_id, ["class"=>"form-control","placeholder"=>"Filter by program"]) !!}
        </div>

        <div class="form-group">
            {!! Form::label("level", "Level") !!}
            {!! Form::select("level", $levels, $request->level, ["class"=>"form-control","placeholder"=>"Filter by level"]) !!}
        </div>

        <button class="btn btn-info" type="submit">
            <i class="fa fa-search"></i> Search
        </button>

        {!! Form::close() !!}

    </div>
    <div class="col-md-9">
        @if($request->last_name || $request->first_name || $request->program_id || $request->level) <h5>Search results...</h5>
        @else <h5>Recent Enrollment</h5> @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr class="bg-info text-white">
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Program</th>
                    <th>Level</th>
                    <th class="text-center"><i class="fa fa-cog"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach($enrols as $enrol)
                    <tr>
                        <td>{{$enrol->student->last_name}}</td>
                        <td>{{$enrol->student->first_name}}</td>
                        <td>{{$enrol->student->middle_name}}</td>
                        <td>{{$enrol->program->short_name}}</td>
                        <td>{{$enrol->level}}</td>
                        <td class="text-center">
                            <a href="{{url('/enrols/' . $enrol->id)}}" class="text-info">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
