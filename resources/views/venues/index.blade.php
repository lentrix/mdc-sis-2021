@extends('page')

@section('content')

<div class="float-right">
    @if(auth()->user()->is('admin')) @include('venues.create-venue-modal') @endif
</div>

<h1>Venues</h1>
<hr>
<div class="row">
    <div class="col-md-10">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="bg-info text-white">
                    <th>Name</th>
                    <th>Building</th>
                    <th class='text-center'>Capacity</th>
                    <th class='text-center'>
                        <i class="fa fa-cog"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($venues as $venue)
                <tr>
                    <td>{{$venue->name}}</td>
                    <td>{{$venue->building}}</td>
                    <td class='text-center'>{{$venue->capacity}}</td>
                    <td class='text-center'>
                        <a href="{{url('/venues/' . $venue->id)}}" class="fa fa-folder-open text-info"></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
