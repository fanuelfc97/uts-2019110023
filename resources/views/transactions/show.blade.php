@extends('layouts.template')

@section('title', 'Transaction Detail')

@section('content')
    <section class="content-header">
        <h1>
            Transaction Detail
            <small>View Transaction Details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('transactions.index') }}">Transactions</a></li>
            <li class="active">Transaction Detail</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Transaction Details</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th style="width: 200px">ID</th>
                                    <td>{{ $transaction->id }}</td>
                                </tr>
                                <tr>
                                    <th>Amount (Rupiah)</th>
                                    <td>{{ number_format($transaction->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Type</th>
                                    <td>{{ $transaction->type }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ $transaction->category }}</td>
                                </tr>
                                <tr>
                                    <th>Notes</th>
                                    <td>{{ $transaction->notes ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $transaction->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ $transaction->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
