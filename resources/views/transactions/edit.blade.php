@extends('layouts.template')

@section('title', 'Edit Transaction')

@section('content')
<section class="mt-4 p-1 content-header">
    <h1>
      Edit Transaction
      <small>Edit Transaksi</small>
    </h1>
    <p></p>
    <p></p>

    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row my-5">
        <div class="col-12 px-5">
            <form action="{{ route('transactions.update', $transaction) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-3 col-md-12 col-sm-12">
                    <label for="amount" class="form-label">Amount (Rupiah)</label>
                    <input type="number" step="1000" class="form-control" name="amount" value="{{ old('amount', $transaction->amount) }}" required>
                </div>
                <div class="mb-3 col-md-12 col-sm-12">
                    <label for="type" class="form-label">Type</label>
                    <select name="type" class="form-control" id="transactionType" required>
                        <option value="uncategorized" {{ old('type', $transaction->type) == 'uncategorized' ? 'selected' : '' }}>Uncategorized</option>
                        <option value="income" {{ old('type', $transaction->type) == 'income' ? 'selected' : '' }}>Income</option>
                        <option value="expense" {{ old('type', $transaction->type) == 'expense' ? 'selected' : '' }}>Expense</option>
                    </select>
                </div>
                <div class="mb-3 col-md-12 col-sm-12">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control" name="category" required>
                        <option value="uncategorized" {{ old('category', $transaction->category) == 'uncategorized' ? 'selected' : '' }}>Uncategorized</option>
                        <option value="wage" class="income-option" {{ old('category', $transaction->category) == 'wage' ? 'selected' : '' }}>Wage</option>
                        <option value="bonus" class="income-option" {{ old('category', $transaction->category) == 'bonus' ? 'selected' : '' }}>Bonus</option>
                        <option value="gift" class="income-option" {{ old('category', $transaction->category) == 'gift' ? 'selected' : '' }}>Gift</option>
                        <option value="food & drinks" class="expense-option" {{ old('category', $transaction->category) == 'food & drinks' ? 'selected' : '' }}>Food & Drinks</option>
                        <option value="shopping" class="expense-option" {{ old('category', $transaction->category) == 'shopping' ? 'selected' : '' }}>Shopping</option>
                        <option value="charity" class="expense-option" {{ old('category', $transaction->category) == 'charity' ? 'selected' : '' }}>Charity</option>
                        <option value="housing" class="expense-option" {{ old('category', $transaction->category) == 'housing' ? 'selected' : '' }}>Housing</option>
                        <option value="insurance" class="expense-option" {{ old('category', $transaction->category) == 'insurance' ? 'selected' : '' }}>Insurance</option>
                        <option value="taxes" class="expense-option" {{ old('category', $transaction->category) == 'taxes' ? 'selected' : '' }}>Taxes</option>
                        <option value="transportation" class="expense-option" {{ old('category', $transaction->category) == 'transportation' ? 'selected' : '' }}>Transportation</option>
                    </select>
                </div>
                <div class="mb-3 col-md-12 col-sm-12">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea name="notes" class="form-control">{{ old('notes', $transaction->notes) }}</textarea>
                </div>
                <div class="mb-3 col-md-12 col-sm-12">
                    <label for="submit" class="form-label">  </label>
                    <button type="submit" class="btn btn-block btn-primary btn-lg">Save</button>
                </div>
            </form>
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
