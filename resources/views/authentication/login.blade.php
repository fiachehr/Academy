@extends('authentication.layouts.authMasterpage')
@section('pageTitle', 'Login')
@section('content')

    <body class="hold-transition register-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="{{ route('authentication.index') }}" class="h1"><b>Academy</b>FIA</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Login in to start your session</p>

                    {!! Form::open(['method' => 'POST', 'url' => 'auth/login']) !!}

                    <div class="input-group mb-3">
                        {!! Form::text('email', '', ['autocomplete' => 'off', 'tabindex' => '2', 'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Email Address']) !!}
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        {!! Form::password('password', ['autocomplete' => 'off', 'tabindex' => '3', 'class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Password']) !!}
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                            </div>
                        </div>
                        <div class="col-4">
                            {!! Form::submit('Login', ['tabindex' => '3', 'class' => 'btn btn-primary btn-block']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                    <div class="social-auth-links text-center mt-2 mb-3">
                        <a href="{{ route('authentication.loginByGoogle') }}" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i> Login in using Google
                        </a>
                    </div>
                    <p class="mb-0">
                        <a href="{{ route('authentication.signup') }}" class="text-center">Register a new
                            membership</a>
                    </p>
                </div>
            </div>
        </div>
    </body>
@endsection
@section('scripts')
    @if (session()->has('signup'))
        <script>
            toastr.success("<?= session()->get('signup') ?>")
        </script>
    @endif
    @if ($errors->any())
        <script>
            toastr.error('Something Wrong')
        </script>
    @endif
    @if (session()->has('invalid'))
        <script>
            toastr.error("<?= session()->get('invalid') ?>")
        </script>
    @endif
    @if (session()->has('deactivated'))
        <script>
            toastr.error("<?= session()->get('deactivated') ?>")
        </script>
    @endif
@endsection
