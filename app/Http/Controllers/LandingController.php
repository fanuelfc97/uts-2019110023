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
        //Ambil data artikel diurutkan berdasarkan tanggal terbaru. lalu tampilkan 7 artikel per halaman
        $transactions = Transaction::query()->latest()->paginate(7);
        return view('landing', compact('transactions'));
    }

}
