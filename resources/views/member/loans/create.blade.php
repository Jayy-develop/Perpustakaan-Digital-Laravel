@extends('layouts.app')
@section('title', 'Pinjam Buku')
@section('content')
<h2><i class="fas fa-plus"></i> Pinjam Buku</h2>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('loans.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="book_id" class="form-label">Pilih Buku <span class="text-danger">*</span></label>
                        <select name="book_id" id="book_id" class="form-select @error('book_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Buku --</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}" @if(old('book_id')==$book->id) selected @endif>
                                    {{ $book->title }} - {{ $book->author }} (Stock: {{ $book->stock }})
                                </option>
                            @endforeach
                        </select>
                        @error('book_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-download"></i> Pinjam</button>
                    <a href="{{ route('loans.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
