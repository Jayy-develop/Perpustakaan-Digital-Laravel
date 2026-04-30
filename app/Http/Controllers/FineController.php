<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\Loan;
use Illuminate\Http\Request;

class FineController extends Controller
{
    /**
     * Display a listing of fines - Admin view
     */
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $fineStats = $this->getStats();
        $fines = Fine::with(['loan.user', 'loan.book'])
            ->latest()
            ->paginate(15);

        return view('fines.index', compact('fines', 'fineStats'));
    }

    /**
     * Display member's fines
     */
    public function memberFines()
    {
        $user = auth()->user();
        $fines = Fine::whereIn('loan_id', $user->loans->pluck('id'))
            ->latest()
            ->paginate(10);

        $memberStats = [
            'pending_amount' => $fines->where('status', 'pending')->sum('amount'),
            'paid_amount' => $fines->where('status', 'paid')->sum('amount'),
        ];

        return view('fines.member', compact('fines', 'memberStats'));
    }

    /**
     * Show fine details
     */
    public function show(Fine $fine)
    {
        if (auth()->user()->role !== 'admin' && auth()->id() !== $fine->loan->user_id) {
            abort(403);
        }

        return view('fines.show', compact('fine'));
    }

    /**
     * Mark fine as paid - Admin/Petugas
     */
    public function markPaid(Fine $fine)
    {
        if (!in_array(auth()->user()->role, ['admin', 'petugas'])) {
            abort(403);
        }

        if ($fine->status === 'paid') {
            return back()->with('error', 'Denda sudah dibayar sebelumnya');
        }

        $fine->markAsPaid();

        return back()->with('success', 'Denda berhasil ditandai sebagai dibayar');
    }

    /**
     * Delete a fine - Admin only
     */
    public function destroy(Fine $fine)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $fine->delete();

        return back()->with('success', 'Denda berhasil dihapus');
    }

    /**
     * Generate fines for overdue loans
     */
    public function generateFines()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $overdueLoans = Loan::where('status', 'returned')
            ->whereDoesntHave('fines')
            ->with('book')
            ->get();

        $finesCreated = 0;

        foreach ($overdueLoans as $loan) {
            $fineAmount = Fine::calculateFine($loan->id);

            if ($fineAmount > 0) {
                Fine::create([
                    'loan_id' => $loan->id,
                    'amount' => $fineAmount,
                    'reason' => 'Late return - ' . $fineAmount / 5000 . ' days overdue',
                    'status' => 'pending'
                ]);
                $finesCreated++;
            }
        }

        return back()->with('success', "$finesCreated denda berhasil dibuat");
    }

    /**
     * Get fines for dashboard stats
     */
    public function getStats()
    {
        return [
            'pending_fines' => Fine::pending()->count(),
            'total_pending_amount' => Fine::pending()->sum('amount'),
            'paid_fines' => Fine::paid()->count(),
            'total_paid_amount' => Fine::paid()->sum('amount'),
        ];
    }
}
