@extends('page')

@section('content')

<a href="{{url('/programs/create')}}" class="btn btn-info float-right"><i class="fa fa-plus"></i> Create Program</a>

<h1>Search Program</h1>
<hr>
<div class="row">
    <div class="col-md-3">
        {!! Form::open(['url'=>'/programs/search','method'=>'get','id'=>'search-form']) !!}
            <input type="hidden" name="search" value="true">
        <div class="mb-2">
            {!! Form::label("full_name", "Full Name") !!}
            {!! Form::text("full_name", request()->get('full_name'), ['class'=>'form-control']) !!}
        </div>

        <div class="mb-2">
            {!! Form::label("short_name", "Short Name") !!}
            {!! Form::text("short_name", request()->get('short_name'), ['class'=>'form-control']) !!}
        </div>

        <button class="btn btn-primary btn-block">
            <i class="fa fa-search"></i> Search
        </button>

        <button class="btn btn-outline-dark btn-block clear-btn" type="button">Clear</button>

        {!! Form::close() !!}
    </div>
    <div class="col-md-9">
        <h4>Search Results</h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="bg-info text-white">
                    <th>Short Name</th>
                    <th>Full Name</th>
                    <th>Department</th>
                    <th class='text-center'><i class="fa fa-cog"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach($programs as $program)
                    <tr>
                        <td>{{$program->short_name}}</td>
                        <td>{{$program->full_name}}</td>
                        <td>{{$program->department->name}}</td>
                        <td class="text-center">
                            <a href='{{url("/programs/$program->id")}}' class="btn fa fa-folder-open text-info"></a>
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
