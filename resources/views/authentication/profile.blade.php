@extends('panel.layouts.panelMasterpage')
@section('pageTitle', 'Edit Your Profile')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Your Profile</h3>
            </div>
            <div class="card-body">

                {!! Form::open(['method' => 'POST', 'url' => 'auth/editProfile']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', Auth::user()->name, ['id' => 'name', 'autocomplete' => 'off', 'tabindex' => '1', 'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::text('email', Auth::user()->email, ['id' => 'email', 'autocomplete' => 'off', 'tabindex' => '2', 'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::submit('Edit Your Profile', ['class' => 'btn btn-primary btn-block']) !!}
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
