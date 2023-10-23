@extends('layouts.template')

@section('title', 'Home Fanuel Clemens UTS')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Halaman Utama
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="padding-left: 0;"> <!-- Menghilangkan padding kiri -->
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Selamat datang di Halaman Utama</h3>
              </div>
            </div>
          </div>
        </div>

        <!-- Transactions Card -->
        <div class="row mb-2">
          @forelse ($transactions as $transaction)
            <div class="col-md-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Transaction</h3>
                </div>
                <div class="box-body">
                  <h3>Transaction ID: {{ $transaction->id }}</h3>
                  <p>Created At: {{ $transaction->created_at }}</p>
                  <p>Amount: {{ number_format($transaction->amount, 2) }} Rupiah</p>
                  <a href="{{ route('transactions.show', $transaction) }}" class="btn btn-primary">Details</a>
                </div>
              </div>
            </div>
          @empty
            <div class="col-md-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">No transactions found.</h3>
                </div>
              </div>
            </div>
          @endforelse
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
