@extends('layouts.app')
@section('title', 'Dashboard Petugas')
@section('content')
<h2><i class="fas fa-chart-line"></i> Dashboard Petugas</h2>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <p class="text-muted mb-0">Total Buku</p>
                <h3 class="text-info">{{ $total_books }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <p class="text-muted mb-0">Peminjaman Aktif</p>
                <h3 class="text-warning">{{ $active_loans }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <p class="text-muted mb-0">Dikembalikan Hari Ini</p>
                <h3 class="text-success">{{ $returned_today }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection
