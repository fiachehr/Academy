@php
$tax = $data['course']->prise * 0.093;
@endphp
@extends('panel.layouts.panelMasterpage')
@section('pageTitle', 'Invoice')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Note:</h5>
                    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                </div>

                <div class="invoice p-3 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> Academy Fia.
                                <small class="float-right">{{ date('Y-m-d') }}</small>
                            </h4>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>EAFia, Inc.</strong><br>
                                795 Folsom Ave, Suite 600<br>
                                San Francisco, CA 94107<br>
                                Phone: (804) 123-5432<br>
                                Email: mailbox@fiachehr.ir
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>{{ Auth::user()->name }}</strong><br>
                                Email: {{ Auth::user()->email }}
                            </address>
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #{{ $data['invoiceNumber'] }}</b><br>
                            <b>Payment Due:</b> {{ date('Y-m-d') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $data['course']->title }}</td>
                                        <td>{{ number_format($data['course']->prise) }} ₺</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="lead">Payment Methods:</p>
                            <img src="{{ asset('assets/img/visa.png') }}" alt="Visa">
                            <img src="{{ asset('assets/img/mastercard.png') }}" alt="Mastercard">
                            <img src="{{ asset('assets/img/american-express.png') }}" alt="American-express.png">
                            <img src="{{ asset('assets/img/paypal2.png') }}" alt="Paypal">
                        </div>
                        <div class="col-6">
                            <p class="lead">Amount Due {{ date('Y-m-d') }}</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>{{ number_format($data['course']->prise) }} ₺</td>
                                    </tr>
                                    <tr>
                                        <th>Tax (9.3%)</th>
                                        <td>{{ number_format($tax) }} ₺</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>{{ number_format($tax + $data['course']->prise) }} ₺</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row no-print">
                        <div class="col-12">
                            {!! Form::open(['method' => 'POST', 'url' => 'shop/payment']) !!}
                            {{ Form::button('<i class="far fa-credit-card"></i> Submit Payment', ['type' => 'submit','class' => 'btn btn-success float-right']) }}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
