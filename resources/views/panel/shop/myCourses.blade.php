@php
$counter = 1;
if (isset($_GET['page']) && $_GET['page'] > 1) {
    $counter = ($_GET['page'] - 1) * 15;
}

@endphp
@extends('panel.layouts.panelMasterpage')
@section('pageTitle', 'My courses list')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">My courses list</h3>
            </div>
            <!-- /.card-header -->
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
                            <th>Lessons List</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userCourses as $item)
                            <tr>
                                <td>{{ $counter }}</td>
                                <td>{{ $item->course->title }}</td>
                                <td>{{ $item->course->user->name }}</td>
                                <td>{{ number_format($item->course->prise) }} ₺</td>
                                <td>
                                    @if ($item->course->is_finished)
                                        <span class="text-success">Finished</span>
                                    @else
                                        <span class="text-warning">In Progress</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->course->is_active)
                                        <span class="text-success">Activated</span>
                                    @else
                                        <span class="text-warning">Deactivated</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->course->ts_expire < strtotime('today'))
                                        <span class="text-danger">Expired</span>
                                    @else
                                        {{ date('Y-m-d | H:i:s', $item->course->ts_expire) }}
                                    @endif
                                </td>
                                <td>{{ date('Y-m-d | H:i:s', $item->course->ts_register) }}</td>
                                <td class="text-center">
                                    <a href="{{ url('shop/courseView/' . $item->course->id) }}">
                                        <i class="fas fa-eye text-success "></i>
                                    </a>
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
                {{ $userCourses->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
@endsection
