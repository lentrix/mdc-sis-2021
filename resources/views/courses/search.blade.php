@extends('page')

@section('content')

<h1>Search Courses</h1>
<hr>
<div class="row">
    <div class="col-md-3">
        {!! Form::open(['url'=>'/courses/search', 'method'=>'get']) !!}

        <div class="mb-2">
            {!! Form::label("name", "Course Name") !!}
            {!! Form::text("name", request()->name, ['class'=>'form-control']) !!}
        </div>

        <div class="mb-2">
            {!! Form::label("description", "Description") !!}
            {!! Form::text("description", request()->description, ['class'=>'form-control']) !!}
        </div>

        <button class="btn btn-info mt-3 w-100"><i class="fa fa-search"></i> Search</button>

        {!! Form::close() !!}
    </div>
    <div class="col-md-9">
        @if($hasSearch) <h4>Search Results</h4>
        @else <h4>Recent Courses</h4> @endif
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="bg-info text-white">
                    <th>Course Name</th>
                    <th>Course Description</th>
                    <th>Credits</th>
                    <th>Department</th>
                    <th><i class="fa fa-cog"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>{{$course->name}}</td>
                    <td>{{$course->description}}</td>
                    <td>{{$course->credit}}</td>
                    <td>{{$course->department?$course->department->accronym:"..."}}</td>
                    <td>
                        <a href="{{url('/courses/' . $course->id)}}" class="fa fa-folder-open text-info" style="cursor:pointer; text-decoration: none"></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
