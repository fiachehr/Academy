@extends('panel.layouts.panelMasterpage')
@section('pageTitle', 'Create new role')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create new role</h3>
            </div>
            <div class="card-body">

                {!! Form::open(['method' => 'POST', 'url' => 'role']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', '', ['id' => 'title', 'autocomplete' => 'off', 'tabindex' => '1', 'class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control']) !!}
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                @foreach ($data['modules'] as $item)
                    <div class="form-group">
                        {!! Form::label('permissions', $item) !!}
                        {!! Form::select('permissions[]', [strtolower($item[0]) . '-f' => 'Full Access', strtolower($item[0]) . '-e' => 'Editor', strtolower($item[0]) . '-g' => 'Geust', strtolower($item[0]) . '-n' => 'No Access'], $item[0] . '-n', ['class' => 'select2 form-control', 'tabindex' => '2']) !!}
                    </div>
                @endforeach
                <div class="form-group">
                    {!! Form::submit('Create New Role', ['class' => 'btn btn-primary btn-block']) !!}
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
