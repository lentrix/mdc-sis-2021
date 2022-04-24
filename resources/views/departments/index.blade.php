@extends('page')

@section('content')

@if(auth()->user()->is('admin'))
<div class="float-right">
    @include('departments.create-department-modal')
</div>
@endif


<h1>Departments</h1>
<hr>

<ul class="list-group">
    @foreach($departments as $dept)
        <li class="list-group-item">
            <div class="d-flex">
                <div style="font-weight: 700; flex: 2">{{$dept->accronym}}</div>
                <div style="flex: 10">{{$dept->name}}</div>
                <div style="flex:4">
                    @foreach($dept->heads as $head) [{{$head->user->full_name}}] &nbsp; @endforeach
                </div>
                <div style="flex-1">
                    <a href="{{url('/departments/' . $dept->id)}}" class="btn fas fa-folder-open text-dark"></a>
                </div>
            </div>
            @if(count($dept->subDepartments) > 0)
                <div>
                    <ul class="list-group">
                    @foreach($dept->subDepartments as $sub)
                        <li class="list-group-item">
                            <div class="d-flex">
                                <div style="font-weight: 700; flex: 2">{{$sub->accronym}}</div>
                                <div style="flex: 10">{{$sub->name}}</div>
                                <div style="flex:4">
                                    @foreach($sub->heads as $head) [{{$head->user->full_name}}] &nbsp; @endforeach
                                </div>
                                <div style="flex-1">
                                    <a href="{{url('/departments/' . $sub->id)}}" class="btn fas fa-folder-open text-dark"></a>
                                </div>
                            </div>
                            @if(count($sub->subDepartments) > 0)
                                <div>
                                    <ul class="list-group">
                                    @foreach($sub->subDepartments as $sub2)
                                        <li class="list-group-item">
                                            <div class="d-flex">
                                                <div style="font-weight: 700; flex: 2">{{$sub2->accronym}}</div>
                                                <div style="flex: 10">{{$sub2->name}}</div>
                                                <div style="flex:4">
                                                    @foreach($sub2->heads as $head) [{{$head->user->full_name}}] &nbsp; @endforeach
                                                </div>
                                                <div style="flex-1">
                                                    <a href="{{url('/departments/' . $sub2->id)}}" class="btn fas fa-folder-open text-dark"></a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif
                        </li>
                    @endforeach
                    </ul>
                </div>

            @endif
        </li>
    @endforeach
</ul>

@endsection
