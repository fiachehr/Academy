@extends('panel.layouts.panelMasterpage')
@section('pageTitle', 'Edit User | ' . $data['user']->name)
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Role | {{ $data['user']->name }}</h3>
            </div>
            <div class="card-body">

                {!! Form::model($data['user'], ['method' => 'PATCH', 'url' => ['user', $data['user']->id]]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['id' => 'name', 'autocomplete' => 'off', 'tabindex' => '1', 'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::text('email', null, ['id' => 'email', 'autocomplete' => 'off', 'tabindex' => '2', 'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">
                    {!! Form::label('role_id', 'Roles') !!}
                    {!! Form::select('role_id', $data['roles'], null, ['class' => 'select2 form-control', 'tabindex' => '3']) !!}
                    @error('role_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('is_active', 'Status') !!}
                    {!! Form::select('is_active', [1 => 'Activated', 0 => 'Deactivated'], null, ['class' => 'select2 form-control', 'tabindex' => '4']) !!}
                    @error('role_id')
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
                    {!! Form::submit('Edit Currnet User', ['class' => 'btn btn-primary btn-block']) !!}
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
