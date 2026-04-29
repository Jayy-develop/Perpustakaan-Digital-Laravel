@extends('layouts.app')
@section('title', 'Peminjaman Saya')
@section('content')
<div class="row mb-4">
    <div class="col-md-6"><h2><i class="fas fa-exchange"></i> Peminjaman Saya</h2></div>
    <div class="col-md-6 text-end"><a href="{{ route('loans.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Pinjam Buku</a></div>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>Buku</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                <tr>
                    <td><a href="{{ route('books.show', $loan->book->id) }}">{{ $loan->book->title }}</a></td>
                    <td>{{ $loan->loan_date->format('d M Y') }}</td>
                    <td>{{ $loan->return_date?->format('d M Y') ?? '-' }}</td>
                    <td><span class="badge @if($loan->status==='borrowed') badge-borrowed @else badge-returned @endif">{{ $loan->status }}</span></td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-4">Belum ada peminjaman</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $loans->links() }}
@endsection
