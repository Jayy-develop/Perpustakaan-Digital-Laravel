@extends('layouts.app')
@section('title', 'Manajemen Denda')
@section('content')
<div class="row mb-4">
    <div class="col-md-6"><h2><i class="fas fa-file-invoice-dollar"></i> Manajemen Denda</h2></div>
    <div class="col-md-6 text-end"><a href="{{ route('fines.generate') }}" class="btn btn-warning"><i class="fas fa-recalculate"></i> Hitung Ulang Denda</a></div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <p class="card-text">Denda Tertunda</p>
                <h3>{{ $fineStats['pending_fines'] ?? 0 }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <p class="card-text">Total Tertunda</p>
                <h3>Rp {{ number_format($fineStats['total_pending_amount'] ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <p class="card-text">Denda Dibayar</p>
                <h3>{{ $fineStats['paid_fines'] ?? 0 }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-secondary text-white">
            <div class="card-body">
                <p class="card-text">Total Dibayar</p>
                <h3>Rp {{ number_format($fineStats['total_paid_amount'] ?? 0, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Member</th>
                    <th>Buku</th>
                    <th>Jumlah Denda</th>
                    <th>Alasan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fines as $fine)
                <tr>
                    <td>{{ $fine->loan->user->name }}</td>
                    <td>{{ $fine->loan->book->title }}</td>
                    <td><strong>Rp {{ number_format($fine->amount, 0, ',', '.') }}</strong></td>
                    <td>{{ $fine->reason }}</td>
                    <td>
                        <span class="badge @if($fine->status === 'pending') badge-danger @else badge-success @endif">
                            {{ $fine->status === 'pending' ? 'Tertunda' : 'Dibayar' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('fines.show', $fine->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        @if($fine->status === 'pending')
                            <form action="{{ route('fines.mark-paid', $fine->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Tandai denda sebagai dibayar?')"><i class="fas fa-check"></i></button>
                            </form>
                        @endif
                        <form action="{{ route('fines.destroy', $fine->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus denda ini?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada data denda</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $fines->links() }}
@endsection
