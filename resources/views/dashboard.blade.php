@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="h3 mb-1"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h1>
        <p class="text-muted mb-0">Selamat datang kembali, {{ auth()->user()->name }}. Berikut ringkasan aktivitas perpustakaan Anda.</p>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-primary rounded-pill p-2 me-3"><i class="fas fa-book fa-lg"></i></span>
                    <div>
                        <h6 class="text-uppercase text-muted mb-1">Total Buku</h6>
                        <h3 class="mb-0">{{ number_format($total_books) }}</h3>
                    </div>
                </div>
                <p class="text-muted mb-0">Jumlah buku yang tersedia dalam koleksi perpustakaan.</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-warning rounded-pill p-2 me-3"><i class="fas fa-spinner fa-lg"></i></span>
                    <div>
                        <h6 class="text-uppercase text-muted mb-1">Sedang Dipinjam</h6>
                        <h3 class="mb-0">{{ number_format($active_loans) }}</h3>
                    </div>
                </div>
                <p class="text-muted mb-0">Buku yang saat ini Anda pinjam dan belum dikembalikan.</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-success rounded-pill p-2 me-3"><i class="fas fa-check fa-lg"></i></span>
                    <div>
                        <h6 class="text-uppercase text-muted mb-1">Sudah Dikembalikan</h6>
                        <h3 class="mb-0">{{ number_format($returned_loans) }}</h3>
                    </div>
                </div>
                <p class="text-muted mb-0">Total peminjaman yang telah Anda selesaikan.</p>
            </div>
        </div>
    </div>
</div>
@endsection
