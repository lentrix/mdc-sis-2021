@extends('page')

@section('content')

@include('terms.edit-period-modal')
@include('terms.delete-period-modal')

<a href="{{url('/terms')}}" class="btn btn-info float-right"><i class="fa fa-arrow-left"></i> Back</a>
<h1>{{$term->name}}</h1>
<hr>
<div class="row">
    <div class="col-md-4">
        <div class="d-flex justify-content-center align-items-center">
            <h4 style="flex:1">Term Details</h4>

            @if(auth()->user()->is('admin')) @include('terms.edit-term-modal',['term'=>$term]) @endif
        </div>
        <table class="table table-sm table-bordered table-striped">
            <tr><th>Short Name</th><td>{{$term->accronym}}</td></tr>
            <tr><th>Full Name</th><td>{{$term->name}}</td></tr>
            <tr><th>Start</th><td>{{$term->start->format('F d, Y')}}</td></tr>
            <tr><th>End</th><td>{{$term->end->format('F d, Y')}}</td></tr>
            <tr><th colspan="2" class="text-center">Enrolment Period</th></tr>
            <tr><td colspan="2" class="text-center">
                {{$term->enrol_start->format('F d, Y')}} - {{$term->enrol_end->format('F d, Y')}}
            </td></tr>
        </table>
    </div>
    <div class="col-md-8">
        <div class="d-flex justify-content-center align-items-center">
            <h4 style="flex:1">Grading Periods</h4>
            @if(auth()->user()->is('admin'))
                @include('terms.add-period-modal', ['term'=>$term])
            @endif
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Period</th>
                    <th>Start</th>
                    <th>End</th>
                    @if(auth()->user()->is('admin'))
                    <th class="text-center"><i class="fa fa-cog"></i></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($term->periods as $period)
                <tr>
                    <td>{{$period->name}}</td>
                    <td>{{$period->start->format('F d, Y')}}</td>
                    <td>{{$period->end->format('F d, Y')}}</td>
                    @if(auth()->user()->is('admin'))
                    <td class="text-center">
                        <i class="fa fa-edit text-info edit-period"
                                style="cursor:pointer"
                                title="Edit this period"
                                data-id="{{$period->id}}"
                                data-name="{{$period->name}}"
                                data-start="{{$period->start->format('Y-m-d')}}"
                                data-end="{{$period->end->format('Y-m-d')}}"></i>

                        <i class="fa fa-trash text-danger delete-period"
                                style="cursor:pointer"
                                title="Delete this period"
                                data-name="{{$period->name}}"
                                data-id="{{$period->id}}"></i>
                    </td>
                    @endif
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
    $(".edit-period").click((ev)=>{
        var el = $(ev.target)
        $("input#period_id").val(el.data('id'))
        $("input#name").val(el.data('name'))
        $("input#start").val(el.data('start'))
        $("input#end").val(el.data('end'))
        $("#editPeriodModal").modal('show')
    })

    $(".delete-period").click((ev)=>{
        var el = $(ev.target)
        $("input#delete_period_id").val(el.data('id'))
        $("#periodName").text(el.data('name'))
        $("#deletePeriodModal").modal('show')
    })
})

</script>

@endsection
