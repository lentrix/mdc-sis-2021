@extends('page')

@section('content')

<div class="float-right">
    <form action="" method="get"
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" name="key" class="form-control bg-white small" placeholder="Search class offering"
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <a href="{{url('/classes/create')}}" class="btn btn-primary">
        <i class="fa fa-plus"></i> Create Class
    </a>
</div>

<h1>Class Offerings</h1>
<hr>
@if($key)
<div class="alert alert-info">
    Search result for "{{$key}}"
</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr class="bg-info text-white">
            <th>Course Name</th>
            <th>Description</th>
            <th>Teacher</th>
            <th>Credit Units</th>
            <th>Schedule</th>
            <th><i class="fa fa-cog"></i></th>
        </tr>
    </thead>
    <tbody>
        @foreach($classes as $class)
            <tr>
                <td>{{$class->course->name}}</td>
                <td>{{$class->course->description}}</td>
                <td>{{$class->teacher->short_name}}</td>
                <td>{{$class->credit_units}}</td>
                <td>
                    @foreach($class->schedules as $sched)
                       <div>{{$sched->summary}}</div>
                    @endforeach
                </td>
                <td>
                    <a href="{{url('/classes/' . $class->id)}}" class="btn fa fa-eye text-info"></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
