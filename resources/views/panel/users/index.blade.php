@php
$counter = 1;
if (isset($_GET['page']) && $_GET['page'] > 1) {
    $counter = ($_GET['page'] - 1) * 15;
}
@endphp
@extends('panel.layouts.panelMasterpage')
@section('pageTitle', 'Users List')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th style="width: 20px">Edit</th>
                            <th style="width: 30px">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                            <tr>
                                <td>{{ $counter }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if ($item->role_id == null)
                                        No any role
                                    @else
                                        {{ $item->role->title }}
                                    @endif
                                </td>
                                <td>
                                    @if ($item->is_active)
                                        <span class="text-success">Activated</span>
                                    @else
                                        <span class="text-warning">Deactivated</span>
                                    @endif
                                </td>
                                <td>{{ date('Y-m-d | H:i:s', $item->ts_register) }}</td>
                                <td class="text-center"><a href="{{ url('user/' . $item->id . '/edit') }}"><i
                                            class="fas fa-edit text-warning "></i></a></td>
                                <td class="text-center">
                                    {!! Form::open(['method' => 'DELETE', 'url' => 'user/' . $item->id]) !!}
                                    {{ Form::button('<i class="fa fa-trash text-danger"></i>', ['type' => 'submit', 'class' => 'btn btn-sm']) }}
                                    {!! Form::close() !!}</td>
                            </tr>
                            @php
                                $counter++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $list->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @if (session()->has('store'))
        <script>
            toastr.success("<?= session()->get('store') ?>")
        </script>
    @endif
    @if (session()->has('edit'))
        <script>
            toastr.success("<?= session()->get('edit') ?>")
        </script>
    @endif
    @if (session()->has('delete'))
        <script>
            toastr.success("<?= session()->get('delete') ?>")
        </script>
    @endif
    @if (session()->has('delete-error'))
        <script>
            toastr.error("<?= session()->get('delete-error') ?>")
        </script>
    @endif
@endsection
