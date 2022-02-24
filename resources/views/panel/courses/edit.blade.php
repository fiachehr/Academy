@extends('panel.layouts.panelMasterpage')
@section('pageTitle', 'Edit course | ' . $data['course']->title)
@section('style')
    <link href="{{ asset('assets/css/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/daterangepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit course | {{ $data['course']->title }}</h3>
            </div>
            <div class="card-body">

                {!! Form::model($data['course'], ['method' => 'PATCH', 'url' => ['course', $data['course']->id]]) !!}

                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', null, ['id' => 'title', 'autocomplete' => 'off', 'tabindex' => '1', 'class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('prise', 'Prise') !!}
                    {!! Form::text('prise', null, ['id' => 'prise', 'autocomplete' => 'off', 'tabindex' => '1', 'class' => $errors->has('prise') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('prise')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description', null, ['id' => 'description', 'autocomplete' => 'off', 'tabindex' => '2', 'class' => $errors->has('description') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group date">
                    {!! Form::label('reservationdatetime', 'Expire Time') !!}
                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                        {!! Form::text('ts_expire', date('Y-m-d H:i:s', $data['course']->ts_expire), ['id' => 'reservationdatetime', 'autocomplete' => 'off', 'tabindex' => '3', 'class' => $errors->has('ts_expire') ? 'form-control datetimepicker-input is-invalid' : 'form-control datetimepicker-input', 'data-target' => '#reservationdate']) !!}
                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        @error('ts_expire')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('is_finished', 'Course Status') !!}
                    {!! Form::select('is_finished', [1 => 'In Progress', 0 => 'Finished'], 1, ['class' => 'select2 form-control', 'tabindex' => '3']) !!}
                    @error('role_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('is_active', 'Status') !!}
                    {!! Form::select('is_active', [1 => 'Activated', 0 => 'Deactivated'], 1, ['class' => 'select2 form-control', 'tabindex' => '4']) !!}
                    @error('role_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">
                    {!! Form::submit('Edit Currnet Cource', ['class' => 'btn btn-primary btn-block']) !!}
                </div>

                {!! Form::close() !!}

            </div>

        </div>
    @endsection

    @section('scripts')
        <script src="{{ asset('assets/js/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('assets/js/moment.min.js') }}"></script>
        <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
        <script src="{{ asset('assets/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <script>
            $('#description').summernote();
            $('#reservationdatetime').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                },
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        </script>
        @if ($errors->any())
            <script>
                toastr.error('Something Wrong')
            </script>
        @endif
    @endsection
