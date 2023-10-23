<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->paginate(10);
        $allTransactions = Transaction::all();
        $totalIncome = $allTransactions->where('type', 'income')->sum('amount');
        $totalExpense = $allTransactions->where('type', 'expense')->sum('amount');
        $totalIncomeTransactions = $allTransactions->where('type', 'income')->count();
        $totalExpenseTransactions = $allTransactions->where('type', 'expense')->count();
        return view('transactions.index', [
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'totalIncomeTransactions' => $totalIncomeTransactions,
            'totalExpenseTransactions' => $totalExpenseTransactions,
        ]);
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'category' => 'required|in:wage,bonus,gift,food & drinks,shopping,charity,housing,insurance,taxes,transportation',
            'notes' => 'nullable|string',
        ]);



        $transaction = Transaction::create([
            'amount' => $validated['amount'],
            'type' => $validated['type'],
            'category' => $validated['category'],
            'notes' => $validated['notes'],
        ]);

        return $transaction;
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
            $validated = $request->validate([
                'amount' => 'required|numeric',
                'type' => 'required|in:uncategorized,income,expense',
                'category' => 'required|in:uncategorized,wage,bonus,gift,food & drinks,shopping,charity,housing,insurance,taxes,transportation',
                'notes' => 'nullable|string',
            ]
        );
    $transaction->update([
        'amount' => $validated['amount'],
        'type' => $validated['type'],
        'category' => $validated['category'],
        'notes' => $validated['notes'],
        'image' => $validated['image'] ?? $transaction->image,
    ]);

    return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
