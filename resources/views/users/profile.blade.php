@extends('page')


@section('heads')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>

    <style type="text/css">
        .preview {
          overflow: hidden;
          width: 250px;
          height: 97px;
          border: 1px solid rgb(47, 91, 133);
          margin-left: 8px;
        }

        .image {
            display: none;
        }

        #image {
            display: block;
            width: 100%;
        }
        #thumbnail {
            width: 100%;
        }
    </style>

@endsection


@section('content')

@include('users.profile-cropper')

<h1>User Profile</h1>
<hr>
<div class="row">
    <div class="col-md-3">
        <div class="position-relative" style="border-radius: 50%; overflow:hidden;">
            <div style="margin-top: 100%"></div>
            <img src="{{$user->profile_pic}}" style="width: 100%; top:0; left:0; position: absolute; cursor: pointer" alt="" id="profile-pic">
            <span class="position-absolute text-center w-100" style="opacity: 0; color: rgb(224, 224, 224); bottom: 0px; z-index: 10; background-color: rgba(50,50,50,0.5); padding: 0; pointer-events: none" id="change-label">
                <i class="fa fa-camera"></i> Change
            </span>
            <input type="file" accept="image/png, image/jpeg" style="display: none" id="image-input">
        </div>
        <div class="alert alert-warning mt-2" style="display: none" id="profile-pic-alert">
            Make sure to click on Save Changes to update your profile picture.
        </div>
    </div>

    <div class="col-md-4">
        <h5>User Details</h5>
        {!! Form::model($user, ['url'=>'/users/profile', 'method'=>'post']) !!}
            {{-- file input for submitting profile pic to controller --}}
            <input type="hidden" id="pic-field" name="pic-field" value="">
        <div class="input-group mb-3">
            {!! Form::label("user", "User Name", ['class'=>'input-group-text','style'=>'width: 120px']) !!}
            {!! Form::text("user", null, ['class'=>'form-control']) !!}
        </div>
        <div class="input-group mb-3">
            {!! Form::label("lname", "Last Name", ['class'=>'input-group-text','style'=>'width: 120px']) !!}
            {!! Form::text("lname", null, ['class'=>'form-control']) !!}
        </div>
        <div class="input-group mb-3">
            {!! Form::label("fname", "First Name", ['class'=>'input-group-text','style'=>'width: 120px']) !!}
            {!! Form::text("fname", null, ['class'=>'form-control']) !!}
        </div>
        <div class="input-group mb-3">
            {!! Form::label("email", "Email", ['class'=>'input-group-text','style'=>'width: 120px']) !!}
            {!! Form::email("email", null, ['class'=>'form-control']) !!}
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save Changes</button>
        </div>
        {!! Form::close() !!}

    </div>

</div>


@endsection


@section('scripts')

<script src="{{asset('js/crop-profile.js')}}"></script>

<script>

    $(document).ready(function(){
        $("#profile-pic").hover(function(){
            $("#change-label").animate({opacity:1.0, padding: '20px'},300,"swing")
        })
        $("#profile-pic").mouseout(function(){
            $("#change-label").animate({opacity:0, padding: '0px'},100,'swing')
        })
    })


</script>

@endsection
