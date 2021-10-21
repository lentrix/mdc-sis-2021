@extends('page')

@section('content')

<h1>Search Students</h1>
<hr>
<div class="row">
    <div class="col-md-3">
        {!! Form::open(['url'=>'/students/search','method'=>'get','id'=>'search-form']) !!}
            <input type="hidden" name="search" value="true">
        <div class="mb-2">
            {!! Form::label("last_name", "Last Name") !!}
            {!! Form::text("last_name", request()->get('last_name'), ['class'=>'form-control']) !!}
        </div>

        <div class="mb-2">
            {!! Form::label("first_name", "First Name") !!}
            {!! Form::text("first_name", request()->get('first_name'), ['class'=>'form-control']) !!}
        </div>

        <div class="mb-2">
            {!! Form::label("middle_name", "Middle Name") !!}
            {!! Form::text("middle_name", request()->get('middle_name'), ['class'=>'form-control']) !!}
        </div>

        <button class="btn btn-primary btn-block">
            <i class="fa fa-search"></i> Search
        </button>

        <button class="btn btn-outline-dark btn-block clear-btn" type="button">Clear</button>

        {!! Form::close() !!}
    </div>
    <div class="col-md-9">
        @if(request()->get('search'))
        <h4>Search Results</h4>
        @else
        <h4>Recent Students</h4>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr class="bg-info text-white">
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th class="text-center"><i class="fa fa-cog"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{$student->last_name}}</td>
                    <td>{{$student->first_name}}</td>
                    <td>{{$student->middle_name}}</td>
                    <td class="text-center">
                        <a href="{{url('/students/' . $student->id)}}" class="btn btn-sm text-info">
                            <i class="fas fa-folder-open"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')

<script>

$(document).ready(()=>{
    $(".clear-btn").click(()=>{
        $("#search-form input[type=text]").val('')
    })
})

</script>

@endsection
