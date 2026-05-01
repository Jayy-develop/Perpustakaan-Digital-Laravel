<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $data = [
                'total_users' => User::count(),
                'total_books' => Book::count(),
                'total_categories' => Category::count(),
                'total_loans' => Loan::count(),
                'active_loans' => Loan::where('status', 'borrowed')->count(),
            ];
            return view('admin.dashboard', $data);
        } elseif ($user->role === 'petugas') {
            $data = [
                'total_books' => Book::count(),
                'active_loans' => Loan::where('status', 'borrowed')->count(),
                'returned_today' => Loan::where('status', 'returned')
                    ->whereDate('return_date', today())
                    ->count(),
            ];
            return view('petugas.dashboard', $data);
        } else {
            $data = [
                'total_books' => Book::count(),
                'active_loans' => $user->loans()->where('status', 'borrowed')->count(),
                'returned_loans' => $user->loans()->where('status', 'returned')->count(),
            ];
            return view('dashboard', $data);
        }
    }
}
