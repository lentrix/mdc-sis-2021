@extends('page')

@section('content')

@if(auth()->user()->is('head'))

    <div class="float-right">
        @include('sections.create-section-modal')
    </div>

@endif

<h1>Sections</h1>
<hr>

<table class="table table-bordered table-striped">
    <thead>
        <tr class="bg-info text-white">
            <th>Section Name</th>
            <th>Program</th>
            <th>Level</th>
            <th>Term</th>
            <th>Population</th>
            <th><i class="fa fa-cog"></i></th>
        </tr>
    </thead>
    <tbody>
        @foreach($sections as $section)

        <tr>
            <td>{{$section->name}}</td>
            <td>{{$section->program->full_name}}</td>
            <td>{{$section->level}}</td>
            <td>{{$section->term->name}}</td>
            <td>...</td>
            <td>
                <a href="{{url('/sections/' . $section->id)}}" class="btn btn-sm fa fa-eye text-info"></a>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>


@endsection
