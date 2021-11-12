@extends('page')

@section('content')

@if(auth()->user()->is('head'))

    <div class="float-right">
        @include('sections.create-section-modal')
    </div>

@endif

<h1>Sections</h1>
<hr>


@endsection
