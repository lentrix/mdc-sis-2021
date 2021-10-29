@extends('page')

@section('content')

<h1>Search Teachers</h1>
<hr>

<div class="row">
    <div class="col-md-3">
        {!! Form::open(['url'=>'/teachers/search','method'=>'get']) !!}

        <div class="form-group">
            {!! Form::label("name", "Name") !!}
            {!! Form::text("name", request()->name, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label("specialization", "Specialization") !!}
            {!! Form::text("specialization", request()->specialization, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <button class="btn btn-info btn-block">
                <i class="fa fa-search"></i> Search
            </button>
        </div>

        {!! Form::close() !!}
    </div>
    <div class="col-md-9">
        <h4>{{$hasSearch?"Search Results":"Recent Teachers"}}</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="bg-info text-white">
                    <th>Name</th>
                    <th>Specialization</th>
                    <th>Department</th>
                    <th class="text-center">
                        <i class="fa fa-cog"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($teachers as $teacher)
                <tr>
                    <td>{{$teacher->name}}</td>
                    <td>{{$teacher->specialization}}</td>
                    <td>{{$teacher->department->accronym}}</td>
                    <td>
                        <a href="{{url('/teachers/' . $teacher->id)}}" class="fa fa-folder-open text-info" style="cursor: pointer; text-decoration:none"></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
