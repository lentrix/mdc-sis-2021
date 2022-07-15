@extends('page')

@section('content')

<div class="float-right">
    <a href="{{url('/pdf/teaching-load/' . $teacher->id)}}" target="_blank" class="btn btn-secondary btn-sm">
        <i class="far fa-file-pdf"></i> Teaching Load
    </a>
</div>

<h1>My Classes</h1>
<hr>

<table class="table table-bordered table-striped">
    <thead class="bg-primary">
        <tr class="text-light">
            <th>Course No</th>
            <th>Description</th>
            <th>Schedule</th>
            <th># of Students</th>
            <th class="text-center">
                <i class="fa fa-cog"></i>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($subjectClasses as $class)

            <tr>
                <td>{{$class->course->name}}</td>
                <td>{{$class->course->description}}</td>
                <td>{{$class->scheduleString}}</td>
                <td class="text-center">{{$class->studentCount}}</td>
                <td class="text-center">
                    <a href="{{url('/teacher-classes/' . $class->id)}}" class="btn btn-sm btn-success" title="Open subject class">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>

        @endforeach
    </tbody>
</table>

@endsection
