@extends('layouts.app')
@section('title', 'Denda Saya')
@section('content')
<h2><i class="fas fa-file-invoice-dollar"></i> Denda Saya</h2>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <p class="card-text">Denda Tertunda</p>
                <h3>Rp {{ number_format($memberStats['pending_amount'] ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <p class="card-text">Denda Dibayar</p>
                <h3>Rp {{ number_format($memberStats['paid_amount'] ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Buku</th>
                    <th>Jumlah Denda</th>
                    <th>Alasan</th>
                    <th>Status</th>
                    <th>Tgl Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fines as $fine)
                <tr>
                    <td>{{ $fine->loan->book->title }}</td>
                    <td><strong>Rp {{ number_format($fine->amount, 0, ',', '.') }}</strong></td>
                    <td>{{ $fine->reason }}</td>
                    <td>
                        <span class="badge @if($fine->status === 'pending') badge-danger @else badge-success @endif">
                            {{ $fine->status === 'pending' ? 'Tertunda' : 'Dibayar' }}
                        </span>
                    </td>
                    <td>{{ $fine->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Tidak ada denda</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $fines->links() }}
@endsection
