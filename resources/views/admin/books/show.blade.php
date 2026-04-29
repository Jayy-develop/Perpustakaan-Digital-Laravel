@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <a href="{{ auth()->user()->role === 'admin' ? route('books.index') : route('admin.books.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            @if($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top book-cover" alt="{{ $book->title }}">
            @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                    <i class="fas fa-book fa-5x text-muted"></i>
                </div>
            @endif
            <div class="card-body">
                <p class="text-muted">Stock: <strong>{{ $book->stock }}</strong></p>
                @if(auth()->user()->role === 'member' && $book->stock > 0)
                    <form action="{{ route('loans.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-download"></i> Pinjam Buku
                        </button>
                    </form>
                @elseif(auth()->user()->role === 'member' && $book->stock <= 0)
                    <button class="btn btn-danger w-100" disabled>
                        <i class="fas fa-times"></i> Stock Habis
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h2>{{ $book->title }}</h2>
                <p class="text-muted">Pengarang: <strong>{{ $book->author }}</strong></p>
                
                <hr>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Kategori:</strong> <span class="badge bg-light text-dark">{{ $book->category->name }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Penerbit:</strong> {{ $book->publisher ?? '-' }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Tahun Terbit:</strong> {{ $book->year ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Jumlah Stock:</strong> 
                            @if($book->stock > 0)
                                <span class="badge bg-success">{{ $book->stock }}</span>
                            @else
                                <span class="badge bg-danger">Habis</span>
                            @endif
                        </p>
                    </div>
                </div>

                <hr>

                <h5>Deskripsi</h5>
                <p>{{ $book->description ?? 'Tidak ada deskripsi' }}</p>

                <hr>

                <div class="text-muted small">
                    <p>Dibuat: {{ $book->created_at->format('d M Y H:i') }}</p>
                    <p>Diperbarui: {{ $book->updated_at->format('d M Y H:i') }}</p>
                </div>

                @if(auth()->user()->role === 'admin')
                    <div class="mt-3">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="confirmDelete(event)">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
