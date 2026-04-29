@extends('layouts.app')
@section('title', 'Detail Denda')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail Denda</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Member</h6>
                        <p class="fs-5"><strong>{{ $fine->loan->user->name }}</strong></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Buku</h6>
                        <p class="fs-5"><strong>{{ $fine->loan->book->title }}</strong></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Tgl Peminjaman</h6>
                        <p class="fs-5">{{ $fine->loan->loan_date->format('d M Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Tgl Pengembalian</h6>
                        <p class="fs-5">{{ $fine->loan->return_date->format('d M Y') }}</p>
                    </div>
                </div>

                <hr>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Jumlah Denda</h6>
                        <p class="fs-4"><strong class="text-danger">Rp {{ number_format($fine->amount, 0, ',', '.') }}</strong></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Status Denda</h6>
                        <p class="fs-5">
                            <span class="badge @if($fine->status === 'pending') badge-danger @else badge-success @endif">
                                {{ $fine->status === 'pending' ? 'Tertunda' : 'Dibayar' }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="mb-3">
                    <h6 class="text-muted">Alasan Denda</h6>
                    <p class="fs-5">{{ $fine->reason }}</p>
                </div>

                <div class="mb-3">
                    <h6 class="text-muted">Catatan</h6>
                    <p class="fs-5">Denda peminjaman terlambat untuk buku "{{ $fine->loan->book->title }}" yang dipinjam oleh {{ $fine->loan->user->name }} pada {{ $fine->loan->loan_date->format('d M Y') }} dan dikembalikan pada {{ $fine->loan->return_date->format('d M Y') }}.</p>
                </div>

                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'petugas')
                <div class="mb-3">
                    <h6 class="text-muted">Tindakan Admin</h6>
                    @if($fine->status === 'pending')
                        <form action="{{ route('fines.mark-paid', $fine->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success" onclick="return confirm('Tandai denda sebagai dibayar?')"><i class="fas fa-check"></i> Tandai Sebagai Dibayar</button>
                        </form>
                    @endif
                    <a href="{{ route('fines.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
                @else
                <a href="{{ route('fines.member') }}" class="btn btn-secondary">Kembali ke Daftar Denda</a>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Info Buku</h5>
            </div>
            <div class="card-body">
                @if($fine->loan->book->cover_image)
                    <img src="{{ asset('storage/' . $fine->loan->book->cover_image) }}" alt="Cover" class="img-fluid rounded mb-3">
                @else
                    <div class="bg-light rounded p-5 text-center mb-3">
                        <i class="fas fa-book fa-3x text-muted"></i>
                    </div>
                @endif
                <p><strong>Judul:</strong> {{ $fine->loan->book->title }}</p>
                <p><strong>Pengarang:</strong> {{ $fine->loan->book->author }}</p>
                <p><strong>Penerbit:</strong> {{ $fine->loan->book->publisher }}</p>
                <p><strong>Tahun:</strong> {{ $fine->loan->book->year }}</p>
                <p><strong>Kategori:</strong> {{ $fine->loan->book->category->name }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
