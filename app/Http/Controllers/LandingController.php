<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Transaction;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $transactions = Transaction::query()->latest()->paginate(7);
        return view('landing', compact('transactions'));
    }

}
