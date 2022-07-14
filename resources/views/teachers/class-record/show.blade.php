@extends('page')

@section('content')

<div class="float-right">
    @include('teachers.class-record._add-column')
</div>
<h1>Class Record</h1>
<div>{{$subjectClass->course->name}} - {{$subjectClass->schedule_string}}</div>
<hr>

<ul class="nav nav-tabs">
    @foreach($subjectClass->term->periods as $period)
    <li class="nav-item">
        <a class="nav-link {{$period->isActive?'active':''}} period-tab" data-id="{{$period->id}}" href="#">{{$period->name}}</a>
    </li>
    @endforeach
    <li class="nav-item">
        <a href="#" class="nav-link period-tab" data-id="summary">
            Summary
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link period-tab" data-id="settings">
            Settings
        </a>
    </li>
</ul>

<div class="grading-periods">
    @foreach($subjectClass->term->periods as $period)
        <div class="period" style="display:{{$period->isActive?'block':'none'}}" id="period-{{$period->id}}">
            @include('teachers.class-record._period',['period'=>$period])
        </div>
    @endforeach
    <div class="period" id="period-summary" style="display:none">
        Summary
    </div>
    <div class="period" id="period-settings" style="display:none">
        Settings
    </div>
</div>

@endsection

@section('scripts')

<script>

$(document).ready(()=>{

    $(".period-tab").click((evt)=>{

        $('.period-tab').removeClass('active')

        var tab = $(evt.target).addClass('active')

        $('.period').css("display","none")
        $("#period-" + tab.data('id')).css('display','block')
    })

})

</script>

@endsection
