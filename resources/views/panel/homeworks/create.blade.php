@extends('panel.layouts.panelMasterpage')
@section('pageTitle', 'Create new homework')
@section('style')
    <link href="{{ asset('assets/css/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create new homework</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['method' => 'POST', 'url' => 'homework/store/']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', '', ['id' => 'title', 'autocomplete' => 'off', 'tabindex' => '1', 'class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('body', 'Homework Body') !!}
                    {!! Form::textarea('body', '', ['id' => 'body', 'autocomplete' => 'off', 'tabindex' => '2', 'class' => $errors->has('body') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('body')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">
                    {!! Form::label('is_active', 'Status') !!}
                    {!! Form::select('is_active', [1 => 'Activated', 0 => 'Deactivated'], 1, ['class' => 'select2 form-control', 'tabindex' => '3']) !!}
                    @error('role_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::submit('Create New Homework', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
                {!! Form::close() !!}

            </div>

        </div>
    @endsection
    @section('scripts')

        <script src="{{ asset('assets/js/summernote-bs4.min.js') }}"></script>
        <script>
            $('#body').summernote();
        </script>
        @if ($errors->any())
            <script>
                toastr.error('Something Wrong')
            </script>
        @endif
    @endsection
