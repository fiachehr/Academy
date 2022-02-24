@php
$modules = ['r' => 'Role', 'u' => 'User', 'c' => 'Course', 'l' => 'Lesson', 'h' => 'HomeWork', 'f' => 'Financial', 's' => 'Shop'];
@endphp
@extends('panel.layouts.panelMasterpage')
@section('pageTitle', 'Edit Role | ' . $role->title)
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Role | {{ $role->title }}</h3>
            </div>
            <div class="card-body">

                {!! Form::model($role, ['method' => 'PATCH', 'url' => ['role', $role->id]]) !!}

                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', null, ['id' => 'title', 'autocomplete' => 'off', 'tabindex' => '1', 'class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                @foreach ($role->permissions as $item)
                    <div class="form-group">
                        {!! Form::label('permissions', $modules[$item->module]) !!}
                        {!! Form::select('permissions[]', [$item->module . '-f' => 'Full Access', $item->module . '-e' => 'Editor', $item->module . '-g' => 'Geust', $item->module . '-n' => 'No Access'], $item->module . '-' . $item->type, ['class' => 'select2 form-control', 'tabindex' => '2']) !!}
                    </div>
                @endforeach
                <div class="form-group">
                    {!! Form::submit('Edit Current Role', ['class' => 'btn btn-primary btn-block']) !!}
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
