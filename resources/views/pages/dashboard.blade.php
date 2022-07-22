@extends('page')

@section('content')

<h1>Dashboard</h1>
<hr>

<div class="row">
    <div class="col-md-2 col-sm-4">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">{{$studCount}}</h1>
            </div>
            <div class="card-footer">
                <h5 class="text-center">Total</h5>
            </div>
        </div>
    </div>

    <div class="col-md-2 col-sm-4">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">{{$collegeCount}}</h1>
            </div>
            <div class="card-footer">
                <h5 class="text-center">College</h5>
            </div>
        </div>
    </div>

    <div class="col-md-2 col-sm-4">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">{{$shsCount}}</h1>
            </div>
            <div class="card-footer">
                <h5 class="text-center">SHS</h5>
            </div>
        </div>
    </div>

    <div class="col-md-2 col-sm-4">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">{{$jhsCount}}</h1>
            </div>
            <div class="card-footer">
                <h5 class="text-center">JHS</h5>
            </div>
        </div>
    </div>

    <div class="col-md-2 col-sm-4">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">{{$elemCount}}</h1>
            </div>
            <div class="card-footer">
                <h5 class="text-center">Elem</h5>
            </div>
        </div>
    </div>
</div>

@endsection
