@extends('layouts.app')
@section('title', 'Kembalikan Buku')
@section('content')
<h2><i class="fas fa-exchange"></i> Kembalikan Buku</h2>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('loans.update', $loan->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label"><strong>User:</strong></label>
                        <p>{{ $loan->user->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Buku:</strong></label>
                        <p>{{ $loan->book->title }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Tanggal Pinjam:</strong></label>
                        <p>{{ $loan->loan_date->format('d M Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="return_date" class="form-label">Tanggal Kembali <span class="text-danger">*</span></label>
                        <input type="date" name="return_date" id="return_date" class="form-control @error('return_date') is-invalid @enderror" value="{{ old('return_date', today()) }}" required>
                        @error('return_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Catat Pengembalian</button>
                    <a href="{{ route('admin.loans.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
