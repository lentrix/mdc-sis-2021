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

<div class='row'>
    <div class="col-md-5">
        <div class="float-right">
            @include('departments.set-head-modal',['users'=>$users])
        </div>
        <h3>Department Controllers</h3>
        <hr>
        @if(count($department->heads) > 0):
        <ul class="list-group">
            @foreach($department->heads as $head)
                <li class="list-group-item">
                    {{$head->user->full_name}}
                    <div class="float-right">
                        @include('departments.remove-head-modal',['head'=>$head])
                    </div>
                </li>
            @endforeach
        </ul>
        @else:
            <p>No head has been assigned.</p>
        @endif
    </div>
</div>

@endsection
