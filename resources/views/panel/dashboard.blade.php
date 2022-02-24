@extends('panel.layouts.panelMasterpage')
@section('pageTitle', 'Dashboard')
@section('content')
@endsection

@section('scripts')
    @if (session()->has('no-access'))
        <script>
            toastr.error("<?= session()->get('no-access') ?>")
        </script>
    @endif
@endsection
