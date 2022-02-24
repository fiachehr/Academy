@extends('panel.layouts.panelMasterpage')
@section('pageTitle', 'Financial Report')
@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Financial Report</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Total Sales</th>
                            <th class="text-center">Best Course</th>
                            <th class="text-center">Best Seller</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{ number_format($data['totalSales']) }} ₺</td>
                            <td class="text-center">{{ $data['bestCourse'][0]->course->title }}</td>
                            <td class="text-center">{{ $data['bestSeller'][0]->user->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Best Courses</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:50%">Course Title</th>
                            <th style="width:50%">Sales Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['bestCourse'] as $item)
                            <tr>
                                <td>{{ $item->course->title }}</td>
                                <td>{{ $item->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Best Seller</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:50%">User Fullname</th>
                            <th style="width:50%">Sales Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['bestSeller'] as $item)
                            <tr>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
