@extends('authentication.layouts.authMasterpage')
@section('pageTitle', 'Register')
@section('content')
<body class="hold-transition register-page">
    <div class="register-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{route('authentication.index')}}" class="h1"><b>Academy</b>FIA</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Register a new membership</p>

          {!! Form::open(['method'=>'POST','url'=>'auth/register']) !!}

            <div class="input-group mb-3">
                {!! Form::text("name", "",['autocomplete'=>'off','tabindex'=>'1','class'=> $errors->has('name') ? 'form-control is-invalid' : 'form-control','placeholder'=>'Full name']) !!}
                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group mb-3">
                {!! Form::text("email", "",['autocomplete'=>'off','tabindex'=>'2','class'=> $errors->has('email') ? 'form-control is-invalid' : 'form-control','placeholder'=>'Email Address']) !!}
                @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group mb-3">
                {!! Form::password("password",['autocomplete'=>'off','tabindex'=>'3','class'=> $errors->has('password') ? 'form-control is-invalid' : 'form-control' ,'placeholder'=>'Password']) !!}
                @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group mb-3">
                {!! Form::password("password_confirmation", ['autocomplete'=>'off','tabindex'=>'4','class'=> $errors->has('password_confirmation') ? 'form-control is-invalid' : 'form-control', 'placeholder'=>'Retry passwprd']) !!}
                @error('password_confirmation')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <span class="description-box">Password must have at least 1 capital character and number, and more than 8 characters</span>
            </div>

            <div class="col-4">
                {!! Form::submit("Register", ['tabindex'=>'5',"class"=>"btn btn-primary btn-block"]) !!}
            </div>

          {!! Form::close() !!}

          <div class="social-auth-links text-center">
            <a href="{{route('authentication.loginByGoogle')}}" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i>
              Sign up using Google
            </a>
          </div>
          <a href="{{route('authentication.index')}}" class="text-center">I already have a membership</a>
        </div>
      </div>
    </div>
</body>
@endsection

@section('scripts')
    @if($errors->any())
        <script>
            toastr.error('Something Wrong')
        </script>
    @endif
@endsection
