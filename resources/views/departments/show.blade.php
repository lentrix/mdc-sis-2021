@extends('page')

@section('content')

<div class="float-right">
    <a href="{{url('/departments')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back</a>
    @if(auth()->user()->is('admin'))
        @include('departments.edit-department-modal')
    @endif
</div>
<h1>{{$department->name}}</h1>
<hr>

<div>
    <h4><strong>Department Head:</strong> {{$department->departmentHeadName}}</h4>
</div>

<div class="d-flex flex-wrap">

    <div class="card text-center" style="width: 200px; margin: 16px">
        <div class="card-body">
            <h1>{{count($department->subDepartments)}}</h1>
        </div>
        <div class="card-footer">
            Sub Departments
        </div>
    </div>

    <div class="card text-center" style="width: 200px; margin: 16px">
        <div class="card-body">
            <h1>10</h1>
        </div>
        <div class="card-footer">
            Teachers
        </div>
    </div>

    <div class="card text-center" style="width: 200px; margin: 16px">
        <div class="card-body">
            <h1>344</h1>
        </div>
        <div class="card-footer">
            Students
        </div>
    </div>

</div>

@endsection
