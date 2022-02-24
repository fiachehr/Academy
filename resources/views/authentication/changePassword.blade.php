@extends('panel.layouts.panelMasterpage')
@section('pageTitle', 'Change your current Password')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Change your current Password</h3>
            </div>
            <div class="card-body">

                {!! Form::open(['method' => 'POST', 'url' => 'auth/changePasswordAction']) !!}

                <div class="form-group">
                    {!! Form::label('last_password', 'Last Password') !!}
                    {!! Form::password('last_password', ['autocomplete' => 'off', 'tabindex' => '1', 'class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Password']) !!}
                    @error('last_password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['autocomplete' => 'off', 'tabindex' => '2', 'class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Password']) !!}
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Retry Password') !!}
                    {!! Form::password('password_confirmation', ['autocomplete' => 'off', 'tabindex' => '3', 'class' => $errors->has('password_confirmation') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Retry passwprd']) !!}
                    @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::submit('Change your current Password', ['class' => 'btn btn-primary btn-block']) !!}
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    @endsection
    @section('scripts')
        @if ($errors->any())
            <script>
                toastr.error('Something Wrong')
            </script>
        @endif
        @if (session()->has('wrong-password'))
            <script>
                toastr.error("<?= session()->get('wrong-password') ?>")
            </script>
        @endif
    @endsection
