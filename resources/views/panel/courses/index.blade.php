@php
$counter = 1;
if (isset($_GET['page']) && $_GET['page'] > 1) {
    $counter = ($_GET['page'] - 1) * 15;
}
@endphp

@extends('panel.layouts.panelMasterpage')
@section('pageTitle', 'Cources list')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cources list</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Title</th>
                            <th>Created By</th>
                            <th>Prise</th>
                            <th>Is Finished</th>
                            <th>Status</th>
                            <th>Expire at</th>
                            <th>Created at</th>
                            <th>Add Lessons</th>
                            <th>Lessons List</th>
                            <th style="width: 20px">Buy</th>
                            <th style="width: 20px">Edit</th>
                            <th style="width: 30px">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                            <tr>
                                <td>{{ $counter }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ number_format($item->prise) }} ₺</td>
                                <td>
                                    @if ($item->is_finished)
                                        <span class="text-success">Finished</span>
                                    @else
                                        <span class="text-warning">In Progress</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->is_active)
                                        <span class="text-success">Activated</span>
                                    @else
                                        <span class="text-warning">Deactivated</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->ts_expire < strtotime('today'))
                                        <span class="text-danger">Expired</span>
                                    @else
                                        {{ date('Y-m-d | H:i:s', $item->ts_expire) }}
                                    @endif
                                </td>
                                <td>{{ date('Y-m-d | H:i:s', $item->ts_register) }}</td>
                                <td class="text-center">
                                    <a href="{{ url('lesson/create/' . $item->id) }}">
                                        <i class="fas fa-plus text-success "></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('lesson/index/' . $item->id) }}">
                                        <i class="fas fa-list text-success "></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('shop/' . $item->id) }}">
                                        <i class="fas fa-cart-plus text-info "></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('course/' . $item->id . '/edit') }}">
                                        <i class="fas fa-edit text-warning "></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    {!! Form::open(['method' => 'DELETE', 'url' => 'course/' . $item->id]) !!}
                                    {{ Form::button('<i class="fa fa-trash text-danger"></i>', ['type' => 'submit', 'class' => 'btn btn-sm']) }}
                                    {!! Form::close() !!}
                                </td>
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
    @if (session()->has('invalid-resource'))
        <script>
            toastr.error("<?= session()->get('invalid-resource') ?>")
        </script>
    @endif
@endsection
