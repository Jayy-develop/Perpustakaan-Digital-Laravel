@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 mb-1"><i class="fas fa-history me-2 text-primary"></i>Riwayat Peminjaman</h1>
        <p class="text-muted mb-0">Lihat riwayat lengkap peminjaman buku Anda, mulai dari tanggal pinjam hingga status pengembalian.</p>
    </div>
    <div class="text-end">
        <span class="badge bg-secondary">Total transaksi: {{ $loans->total() }}</span>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-3 p-3 rounded-circle bg-primary bg-opacity-10 text-primary">
                        <i class="fas fa-book-reader fa-lg"></i>
                    </div>
                    <div>
                        <div class="text-uppercase text-muted fs-7 mb-1">Total Riwayat</div>
                        <div class="h4 mb-0">{{ number_format($loans->total()) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-3 p-3 rounded-circle bg-warning bg-opacity-10 text-warning">
                        <i class="fas fa-spinner fa-lg"></i>
                    </div>
                    <div>
                        <div class="text-uppercase text-muted fs-7 mb-1">Sedang Dipinjam</div>
                        <div class="h4 mb-0">{{ number_format($loans->where('status', 'borrowed')->count()) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-3 p-3 rounded-circle bg-success bg-opacity-10 text-success">
                        <i class="fas fa-check-circle fa-lg"></i>
                    </div>
                    <div>
                        <div class="text-uppercase text-muted fs-7 mb-1">Selesai Dikembalikan</div>
                        <div class="h4 mb-0">{{ number_format($loans->where('status', 'returned')->count()) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2 class="h6 mb-0">Tabel Riwayat Peminjaman</h2>
                <p class="text-muted mb-0">Daftar transaksi peminjaman terbaru Anda.</p>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-borderless align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $loan)
                        <tr>
                            <td>
                                <a href="{{ route('books.show', $loan->book->id) }}" class="text-decoration-none fw-semibold text-dark">
                                    {{ $loan->book->title }}
                                </a>
                                <div class="text-muted fs-7">{{ optional($loan->book)->author ?? 'Penulis tidak tersedia' }}</div>
                            </td>
                            <td>
                                @if($loan->loan_date)
                                    <div class="fw-semibold">{{ $loan->loan_date->format('d M Y H:i') }}</div>
                                    <div class="text-muted fs-7">{{ $loan->loan_date->diffForHumans() }}</div>
                                @else
                                    <span class="text-muted">Tidak tersedia</span>
                                @endif
                            </td>
                            <td>
                                @if($loan->return_date)
                                    <div class="fw-semibold">{{ $loan->return_date->format('d M Y H:i') }}</div>
                                    <div class="text-muted fs-7">{{ $loan->return_date->diffForHumans() }}</div>
                                @else
                                    <span class="text-muted">Belum dikembalikan</span>
                                @endif
                            </td>
                            <td>
                                @if($loan->status === 'borrowed')
                                    <span class="badge bg-warning text-dark px-3 py-2">Sedang Dipinjam</span>
                                @else
                                    <span class="badge bg-success px-3 py-2">Sudah Dikembalikan</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">Belum ada riwayat peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 d-flex justify-content-end">
    {{ $loans->links() }}
</div>
@endsection
