@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <a href="{{ route('admin.loans.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Detail Peminjaman</h4>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">User</dt>
                    <dd class="col-sm-8">{{ $loan->user->name }} ({{ $loan->user->email }})</dd>

                    <dt class="col-sm-4">Buku</dt>
                    <dd class="col-sm-8">{{ $loan->book->title }}</dd>

                    <dt class="col-sm-4">Tanggal Pinjam</dt>
                    <dd class="col-sm-8">{{ $loan->loan_date->format('d M Y') }}</dd>

                    <dt class="col-sm-4">Tanggal Kembali</dt>
                    <dd class="col-sm-8">{{ $loan->return_date?->format('d M Y') ?? '-' }}</dd>

                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">
                        <span class="badge @if($loan->status === 'borrowed') bg-warning @else bg-success @endif">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Informasi Tambahan</h5>
            </div>
            <div class="card-body">
                <p><strong>Judul Buku:</strong> {{ $loan->book->title }}</p>
                <p><strong>Pengarang:</strong> {{ $loan->book->author }}</p>
                <p><strong>Status Buku:</strong> {{ $loan->book->stock > 0 ? 'Tersedia' : 'Habis' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
