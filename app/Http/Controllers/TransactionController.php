<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
            $validated = $request->validate([
                'amount' => 'required|numeric',
                'type' => 'required|in:uncategorized,income,expense',
                'category' => 'required|in:uncategorized,wage,bonus,gift,food & drinks,shopping,charity,housing,insurance,taxes,transportation',
                'notes' => 'nullable|string',
            ]
        );
    // Update transaksi
    $transaction->update([
        'amount' => $validated['amount'],
        'type' => $validated['type'],
        'category' => $validated['category'],
        'notes' => $validated['notes'],
        'image' => $validated['image'] ?? $transaction->image,
    ]);

    return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
