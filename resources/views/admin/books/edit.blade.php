@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h2><i class="fas fa-book"></i> Edit Buku</h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if(old('category_id', $book->category_id) == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $book->title) }}" placeholder="Masukkan judul buku">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Pengarang <span class="text-danger">*</span></label>
                        <input type="text" name="author" id="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author', $book->author) }}" placeholder="Masukkan nama pengarang">
                        @error('author')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="publisher" class="form-label">Penerbit</label>
                                <input type="text" name="publisher" id="publisher" class="form-control @error('publisher') is-invalid @enderror" value="{{ old('publisher', $book->publisher) }}" placeholder="Masukkan nama penerbit">
                                @error('publisher')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="year" class="form-label">Tahun Terbit</label>
                                <input type="number" name="year" id="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year', $book->year) }}" placeholder="Contoh: 2020">
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Jumlah Stock <span class="text-danger">*</span></label>
                        <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $book->stock) }}" min="0" placeholder="Masukkan jumlah stock">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Foto Cover</label>
                        @if($book->cover_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="book-cover">
                            </div>
                        @endif
                        <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG (Max 2MB)</small>
                        @error('cover_image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Masukkan deskripsi buku">{{ old('description', $book->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Perbarui Buku
                        </button>
                        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Detail Buku</h5>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $book->id }}</p>
                <p><strong>Kategori:</strong> {{ $book->category->name }}</p>
                <p><strong>Dibuat:</strong> {{ $book->created_at->format('d M Y') }}</p>
                <p><strong>Diperbarui:</strong> {{ $book->updated_at->format('d M Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
