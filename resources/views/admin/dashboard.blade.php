@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2><i class="fas fa-chart-line"></i> Dashboard Admin</h2>
        <p class="text-muted">Selamat datang di Sistem Manajemen Perpustakaan</p>
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-0">Total Pengguna</p>
                        <h3 class="text-primary">{{ $total_users }}</h3>
                    </div>
                    <i class="fas fa-users fa-3x text-primary" style="opacity: 0.1;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-0">Total Buku</p>
                        <h3 class="text-info">{{ $total_books }}</h3>
                    </div>
                    <i class="fas fa-book fa-3x text-info" style="opacity: 0.1;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-0">Total Kategori</p>
                        <h3 class="text-success">{{ $total_categories }}</h3>
                    </div>
                    <i class="fas fa-list fa-3x text-success" style="opacity: 0.1;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-0">Peminjaman Aktif</p>
                        <h3 class="text-warning">{{ $active_loans }}</h3>
                    </div>
                    <i class="fas fa-exchange fa-3x text-warning" style="opacity: 0.1;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-0">Total Peminjaman</p>
                        <h3 class="text-secondary">{{ $total_loans }}</h3>
                    </div>
                    <i class="fas fa-history fa-3x text-secondary" style="opacity: 0.1;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Navigasi Cepat</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('users.index') }}" class="btn btn-outline-primary btn-sm me-2 mb-2">
                    <i class="fas fa-users"></i> Kelola Pengguna
                </a>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-info btn-sm me-2 mb-2">
                    <i class="fas fa-list"></i> Kelola Kategori
                </a>
                <a href="{{ route('admin.books.index') }}" class="btn btn-outline-success btn-sm me-2 mb-2">
                    <i class="fas fa-book"></i> Kelola Buku
                </a>
                <a href="{{ route('admin.loans.index') }}" class="btn btn-outline-warning btn-sm mb-2">
                    <i class="fas fa-exchange"></i> Kelola Peminjaman
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Informasi Sistem</h5>
            </div>
            <div class="card-body">
                <p><strong>Nama Sistem:</strong> Perpustakaan</p>
                <p><strong>Versi:</strong> 1.0</p>
                <p><strong>Peran Anda:</strong> <span class="badge bg-danger">Admin</span></p>
                <p class="mb-0"><strong>Waktu:</strong> {{ date('d M Y H:i:s') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
