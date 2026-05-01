<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function riwayat()
    {
        $user = auth()->user();
        $loans = $user->loans()->with('book')->paginate(10);

        return view('peminjaman.riwayat', compact('loans'));
    }
}
