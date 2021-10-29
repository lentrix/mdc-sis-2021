@extends('shell')

@section('body')



<!-- Outer Row -->
<div class="row d-flex justify-content-center align-items-center" style="height: 90vh">

    <div class="col-md-8">

        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 mdc-login-bg">
                        <img src="{{asset('img/MDC-Logo-clipped.png')}}" alt="Login Logo" id="login-logo">
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>

                                @include('flash-messages')

                            </div>
                            {!! Form::open(['url'=>'/login','method'=>'post','class'=>'user']) !!}
                                <div class="input-group mb-3">
                                    <div class="input-group-text bg-info text-white"><i class="fa fa-user"></i></div>
                                    {!! Form::text('user', null, ['class'=>'form-control','placeholder'=>'Enter your user name.']) !!}
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-text bg-danger text-white"><i class="fa fa-lock"></i></div>
                                    {!! Form::password('password', ['class'=>'form-control','placeholder'=>'Enter your password.']) !!}
                                </div>
                                {{-- <div class="form-group mb-3">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember
                                            Me</label>
                                    </div>
                                </div> --}}

                                <button class="btn btn-primary btn-block">
                                    <i class="fa fa-sign-in-alt"></i> Login
                                </button>
                                {{-- <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Login with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                </a> --}}
                            {!! Form::close() !!}
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="register.html">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection
