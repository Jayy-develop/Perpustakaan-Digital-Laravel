@extends('layouts.app')
@section('title', 'Peminjaman')
@section('content')
<div class="row mb-4">
    <div class="col-md-6"><h2><i class="fas fa-exchange"></i> Peminjaman</h2></div>
</div>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>ID</th><th>User</th><th>Buku</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                <tr>
                    <td>{{ $loan->id }}</td>
                    <td>{{ $loan->user->name }}</td>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ $loan->loan_date->format('d M Y') }}</td>
                    <td>{{ $loan->return_date?->format('d M Y') ?? '-' }}</td>
                    <td><span class="badge @if($loan->status==='borrowed') badge-borrowed @else badge-returned @endif">{{ $loan->status }}</span></td>
                    <td>
                        @if($loan->status === 'borrowed' && (auth()->user()->role === 'admin' || auth()->user()->role === 'petugas'))
                        <a href="{{ route('admin.loans.edit', $loan->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-check"></i> Kembalikan</a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $loans->links() }}
@endsection
