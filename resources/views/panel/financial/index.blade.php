@php
$counter = 1;
if (isset($_GET['page']) && $_GET['page'] > 1) {
    $counter = ($_GET['page'] - 1) * 15;
}
@endphp

@extends('panel.layouts.panelMasterpage')
@section('pageTitle', 'Cources List')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cources List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Invoice No</th>
                            <th>Buyer</th>
                            <th>Course</th>
                            <th>Course Prıse</th>
                            <th>Payment Prıse</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userCourses as $item)
                            <tr>
                                <td>{{ $counter }}</td>
                                <td>#{{ $item->number }}</td>
                                <td>{{ $item->course->user->name }}</td>
                                <td>{{ $item->course->title }}</td>
                                <td>{{ number_format($item->course->prise) }} ₺</td>
                                <td>{{ number_format($item->prise) }} ₺</td>
                                <td>
                                    @if ($item->is_paid)
                                        <span class="text-success">Paid</span>
                                    @else
                                        <span class="text-warning">Suspend</span>
                                    @endif
                                </td>
                                <td>{{ date('Y-m-d | H:i:s', $item->course->ts_register) }}</td>
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
