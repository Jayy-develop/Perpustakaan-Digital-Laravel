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
        if (!in_array(auth()->user()->role, ['admin', 'petugas'])) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
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
        if (!in_array(auth()->user()->role, ['admin', 'petugas']) && auth()->id() !== $fine->loan->user_id) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
        }

        return view('fines.show', compact('fine'));
    }

    /**
     * Mark fine as paid - Admin/Petugas
     */
    public function markPaid(Fine $fine)
    {
        if (!in_array(auth()->user()->role, ['admin', 'petugas'])) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
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
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
        }

        $fine->delete();

        return back()->with('success', 'Denda berhasil dihapus');
    }

    /**
     * Generate fines for overdue loans
     */
    public function generateFines()
    {
        if (!in_array(auth()->user()->role, ['admin', 'petugas'])) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access');
        }

        // Get all returned loans
        $returnedLoans = Loan::where('status', 'returned')
            ->with('book')
            ->get();

        $finesCreated = 0;
        $finesUpdated = 0;

        foreach ($returnedLoans as $loan) {
            $fineAmount = Fine::calculateFine($loan->id);

            if ($fineAmount > 0) {
                $daysOverdue = (int) ($fineAmount / 5000);
                $reason = 'Late return - ' . $daysOverdue . ' days overdue';

                // Check if fine already exists
                $existingFine = Fine::where('loan_id', $loan->id)->first();

                if ($existingFine) {
                    // Update existing fine
                    if ($existingFine->amount != $fineAmount) {
                        $existingFine->update([
                            'amount' => $fineAmount,
                            'reason' => $reason
                        ]);
                        $finesUpdated++;
                    }
                } else {
                    // Create new fine
                    Fine::create([
                        'loan_id' => $loan->id,
                        'amount' => $fineAmount,
                        'reason' => $reason,
                        'status' => 'pending'
                    ]);
                    $finesCreated++;
                }
            }
        }

        $message = "$finesCreated denda baru dibuat";
        if ($finesUpdated > 0) {
            $message .= " dan $finesUpdated denda diperbarui";
        }

        return back()->with('success', $message);
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
