@extends('layouts.template')

@section('title', 'Add New Transaction')

@section('content')
  <section class="content-header">
    <h1>
      Add New Transaction
      <small>Tambahkan Transaksi</small>
    </h1>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="box box-primary">
          <div class="box-body">
            <form action="{{ route('transactions.store') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="amount">Amount (Rupiah)</label>
                <input type="number" step="1000" class="form-control" name="amount" required>
              </div>
              <div class="form-group">
                <label for="type">Type</label>
                <select name="type" class="form-control" id="transactionType" required>
                  <option value="uncategorized">Uncategorized</option>
                  <option value="income">Income</option>
                  <option value="expense">Expense</option>
                </select>
              </div>
              <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" name="category" required>
                  <option value="uncategorized">Uncategorized</option>
                  <option value="wage" class="income-option">Wage</option>
                  <option value="bonus" class="income-option">Bonus</option>
                  <!-- Tambahkan opsi lainnya di sini -->
                </select>
              </div>
              <div class="form-group">
                <label for="notes">Notes</label>
                <textarea name="notes" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      hideCategories();
    });
    document.getElementById('transactionType').addEventListener('change', function() {
      hideCategories();
      const selectedType = this.value;
      document.querySelectorAll('.' + selectedType + '-option').forEach(function(option) {
        option.style.display = 'block';
      });
    });

    function hideCategories() {
      document.querySelectorAll('.income-option, .expense-option').forEach(function(option) {
        option.style.display = 'none';
      });
    }
  </script>
@endsection
