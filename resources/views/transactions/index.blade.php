@extends('layouts.template')

@section('title', 'Transactions List')

@section('content')
<style>
    .custom-table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }

    .custom-table td {
        border: 2px solid rgb(59, 125, 168);
        padding: 8px;
        text-align: center;
    }

    .custom-table th {
        border: 2px solid rgb(59, 125, 168);
        padding: 8px;
        text-align: center;
    }

    .table thead {
        background-color: #3c8dbc;
        color: white;
        text-align: center;
    }

    .table tbody {
        border: 1px solid rgb(59, 125, 168);
    }

    .table tbody tr:hover {
        background-color: #f5f5f5;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
    }

    .edit-button {
        background-color: #00a65a;
        color: white;
        padding: 5px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .delete-button {
        background-color: #dd4b39;
        color: white;
        padding: 5px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
<section class="content-header">
    <h1>
        All Transaction
        <small>Seluruh Transaksi</small>
    </h1>
    <div class="text-top mt-3">
        <a href="{{ route('transactions.create') }}" class="btn btn-primary">Add New Transaction</a>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Transaction List</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Balance</span>
                                    <span class="info-box-number">{{ number_format($totalIncome-$totalExpense, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-green"><i class="fa fa-arrow-up"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Income</span>
                                    <span class="info-box-number">{{ number_format($totalIncome, 2) }}</span>
                                    <small>Transaction Income: {{ number_format($totalIncomeTransactions, 0) }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-red"><i class="fa fa-arrow-down"></i></span>
                                <div class = "info-box-content">
                                    <span class="info-box-text">Total Expense</span>
                                    <span class="info-box-number">{{ number_format($totalExpense, 2) }}</span>
                                    <small>Transaction Expense: {{ number_format($totalExpenseTransactions, 0) }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-blue"><i class="fa fa-list"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Transactions</span>
                                    <span class="info-box-number">{{ $totalIncomeTransactions + $totalExpenseTransactions }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel transaksi -->
                    <table class="table table-bordered table-striped dataTable custom-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Amount (Rupiah)</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Notes</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                            <tr>
                                <td>
                                    <a href="{{ route('transactions.show', $transaction) }}">
                                        {{ $transaction->id }}
                                    </a>
                                </td>
                                <td>{{ number_format($transaction->amount, 2) }}</td>
                                <td>{{ $transaction->type }}</td>
                                <td>{{ $transaction->category }}</td>
                                <td>{{ $transaction->notes ?? '-' }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td>{{ $transaction->updated_at }}</td>
                                <td class="action-buttons">
                                    <button class="edit-button" onclick="window.location.href='{{ route('transactions.edit', $transaction) }}'">Edit</button>
                                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="d-inline-block">
                                        @method('DELETE')
                                        @csrf
                                        <button class="delete-button" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">No transactions found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="d-flex justify-content-end">
                        {!! $transactions->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
