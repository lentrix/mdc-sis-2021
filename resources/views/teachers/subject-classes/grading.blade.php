@extends('page')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{url('/teacher-classes')}}">My Classes</a></li>
      <li class="breadcrumb-item"><a href="{{url('/teacher-classes/' . $subjectClass->id)}}">{{$subjectClass->course_no}}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Grading</li>
    </ol>
</nav>


<h1>Grading: {{$subjectClass->course_no}}</h1>
<hr>

{{-- {!! Form::open(['url'=>'/teacher-classes/' . $subjectClass->id . '/grading-config', 'method'=>'patch']) !!}
<div class="d-flex align-items-center">
    <div class="pr-3">{!! Form::label("grading_names", "Grade Configuration") !!}</div>
    <div class="pr-3 w-25">
        {!! Form::select("grading_names", [
                "Midterm, Final" => "Midterm & Final",
                '1st Quarter, 2nd Quarter' => '1st Quarter & 2nd Quarter',
                '3rd Quarter, 4th Quarter' => '3rd Quarter & 4th Quarter',
                '1st Quarter, 2nd Quarter, 3rd Quarter, 4th Quarter' => 'All four quarters'
            ], $subjectClass->grading_names, ['class'=>'form-control', 'placeholder'=>'Select configuration']) !!}
    </div>
    <div>
        <button class="btn btn-primary" type="submit">
            Set
        </button>
    </div>
</div>
{!! Form::close() !!}

<hr> --}}

<ul class="nav nav-tabs" title="grade-tabs">
    @foreach($subjectClass->gradingPeriods as $index=>$gp)
    <li class="nav-item">
        <a href="#grade-tabs" class="nav-link grade-tab" data-col="{{$index+1}}">
            {{trim($gp)}}
        </a>
    </li>
    @endforeach
    <li>
        <a href="#grade-tabs" class="nav-link active grade-tab" data-col="{{count($subjectClass->gradingPeriods) + 1}}">
            Summary
        </a>
    </li>
</ul>

@foreach($subjectClass->gradingPeriods as $index=>$gp)

    <?php $period = $subjectClass->term->getPeriod($gp) ?>

<div id="content-{{$index+1}}" class="grade-content mt-3" style="display:none">
    <h4>{{$gp}} Grade</h4>
    <div>{{$period->start->format('F d, Y')}} - {{$period->end->format('F d, Y')}}</div>
    @if($period->start->isBefore($now) && $period->end->isAfter($now))
        @include('teachers.subject-classes._grade-form', ['col'=>$index+1, 'subjectClass'=>$subjectClass])
    @else
        @include('teachers.subject-classes._grade-sheet',['col'=>$index+1, 'subjectClass'=>$subjectClass])
    @endif
</div>

@endforeach

<div id="content-{{count($subjectClass->gradingPeriods) + 1}}" class="mt-3 grade-content">
    <h4>Summary</h4>
</div>

@endsection


@section('scripts')

<script>

$(document).ready(()=>{
    $(".grade-tab").click((e)=>{
        $('.grade-tab').removeClass('active')
        var el = $(e.target)
        el.addClass('active')

        var colNum = el.data("col")

        $(".grade-content").css("display","none")
        $("#content-" + colNum).css("display","block")
    })
})

</script>

@endsection
