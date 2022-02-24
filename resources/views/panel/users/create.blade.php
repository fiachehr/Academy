@extends('panel.layouts.panelMasterpage')
@section('pageTitle', 'Create new role')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create new role</h3>
            </div>
            <div class="card-body">

                {!! Form::open(['method' => 'POST', 'url' => 'user']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', '', ['id' => 'name', 'autocomplete' => 'off', 'tabindex' => '1', 'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::text('email', '', ['id' => 'email', 'autocomplete' => 'off', 'tabindex' => '2', 'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('role_id', 'Roles') !!}
                    {!! Form::select('role_id', $roles, null, ['class' => 'select2 form-control', 'tabindex' => '3']) !!}
                    @error('role_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('is_active', 'Status') !!}
                    {!! Form::select('is_active', [1 => 'Activated', 0 => 'Deactivated'], 0, ['class' => 'select2 form-control', 'tabindex' => '4']) !!}
                    @error('is_active')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['autocomplete' => 'off', 'tabindex' => '5', 'class' => $errors->has('password') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Password']) !!}
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Retry Password') !!}
                    {!! Form::password('password_confirmation', ['autocomplete' => 'off', 'tabindex' => '6', 'class' => $errors->has('password_confirmation') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Retry passwprd']) !!}
                    @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::submit('Create New User', ['class' => 'btn btn-primary btn-block']) !!}
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
    @endsection
