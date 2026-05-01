<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $loans = Loan::with('user', 'book')->paginate(15);
            return view('admin.loans.index', compact('loans'));
        } elseif ($user->role === 'petugas') {
            $loans = Loan::with('user', 'book')->paginate(15);
            return view('petugas.loans.index', compact('loans'));
        } else {
            $loans = $user->loans()->with('book')->paginate(10);
            return view('member.loans.index', compact('loans'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        return view('member.loans.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($validated['book_id']);

        if ($book->stock <= 0) {
            return redirect()->back()->with('error', 'Buku tidak tersedia');
        }

        // Check if user already has an active loan for this book
        $existing = Loan::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->where('status', 'borrowed')
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Anda sudah meminjam buku ini');
        }

        // Create loan
        Loan::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'loan_date' => today(),
            'status' => 'borrowed',
        ]);

        // Decrease stock
        $book->decrement('stock');

        return redirect()->route('loans.index')->with('success', 'Buku berhasil dipinjam');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $loan = Loan::with('user', 'book')->findOrFail($id);
        return view('admin.loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $loan = Loan::findOrFail($id);
        return view('petugas.loans.edit', compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);

        $validated = $request->validate([
            'return_date' => 'required|date|after_or_equal:loan_date',
        ]);

        if ($loan->status === 'borrowed') {
            $loan->update([
                'return_date' => $validated['return_date'],
                'status' => 'returned',
            ]);

            // Increase stock
            $loan->book->increment('stock');

            return redirect()->route(auth()->user()->role === 'member' ? 'loans.index' : 'admin.loans.index')->with('success', 'Pengembalian buku berhasil dicatat');
        }

        return redirect()->back()->with('error', 'Loan sudah dikembalikan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loan = Loan::findOrFail($id);
        
        if ($loan->status === 'borrowed') {
            $loan->book->increment('stock');
        }

        $loan->delete();
        return redirect()->route(auth()->user()->role === 'member' ? 'loans.index' : 'admin.loans.index')->with('success', 'Peminjaman berhasil dihapus');
    }
}
