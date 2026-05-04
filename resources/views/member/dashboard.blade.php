@extends('layouts.app')
@section('title', 'Dashboard Member')
@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h2 class="h3 mb-1">Halo, {{ auth()->user()->name }}</h2>
        <p class="text-muted mb-0">Ringkasan pinjaman, pengingat pengembalian, dan rekomendasi untuk Anda.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="{{ route('books.index') }}" class="btn btn-primary">Jelajahi Koleksi</a>
        <a href="{{ route('loans.create') }}" class="btn btn-outline-success ms-2">Pinjam Buku</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Peminjaman Aktif</strong>
                <small class="text-muted">{{ method_exists($loans, 'total') ? $loans->total() : $loans->count() }} total</small>
            </div>
            <div class="card-body">
                @if($loans->count())
                    <div class="list-group">
                        @foreach($loans as $loan)
                            @php $cover = $loan->book->cover_image ? asset('storage/'.$loan->book->cover_image) : 'https://picsum.photos/80/120'; @endphp
                            <div class="list-group-item d-flex align-items-center">
                                <img src="{{ $cover }}" alt="cover" style="width:64px;height:96px;object-fit:cover;border-radius:6px;" class="me-3">
                                <div class="flex-fill">
                                    <a href="{{ route('books.show', $loan->book->id) }}" class="h6 mb-0 d-block">{{ $loan->book->title }}</a>
                                    <div class="small text-muted">oleh {{ $loan->book->author ?? '-' }}</div>
                                    <div class="small text-muted mt-2">Pinjam: {{ $loan->loan_date->format('d M Y') }} · Kembali: {{ $loan->return_date?->format('d M Y') ?? '-' }}</div>
                                </div>
                                <div class="text-end ms-3">
                                    @if($loan->status === 'borrowed')
                                        <span class="badge bg-warning text-dark">Dipinjam</span>
                                        @if($loan->return_date)
                                            <div class="small text-muted mt-2">Jatuh tempo {{ $loan->return_date?->diffForHumans() }}</div>
                                        @endif
                                    @elseif($loan->status === 'returned')
                                        <span class="badge bg-success">Dikembalikan</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($loan->status) }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        Anda belum memiliki peminjaman aktif. <a href="{{ route('books.index') }}">Jelajahi koleksi</a> untuk meminjam buku.
                    </div>
                @endif
            </div>
            <div class="card-footer text-center">
                {{ $loans->links() }}
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-body">
                <div class="muted small">Ringkasan</div>
                <div class="h4">{{ $loans->count() }} aktif</div>
                <p class="mb-2"><a href="{{ route('fines.member') }}">Lihat denda dan tagihan</a></p>
                <div class="d-grid gap-2">
                    <a class="btn btn-outline-primary" href="{{ route('books.index') }}">Rekomendasi untuk Anda</a>
                    <a class="btn btn-outline-success" href="{{ route('loans.create') }}">Perpanjang / Pinjam Lagi</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="mb-2">Tips</h5>
                <ul class="small text-muted mb-0">
                    <li>Periksa tanggal pengembalian untuk menghindari denda.</li>
                    <li>Gunakan fitur pencarian untuk menemukan judul cepat.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
