@extends('layouts.app')

@section('title', 'Kelola Buku')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h2><i class="fas fa-book"></i> Kelola Buku</h2>
    </div>
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'petugas')
    <div class="col-md-6 text-end">
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Buku
        </a>
        @endif
    </div>
    @endif
</div>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.books.index') }}" class="row">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Cari judul atau pengarang..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="category_id" class="form-select">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(request('category_id') == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-info w-100">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Kategori</th>
                    <th>Stock</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'petugas')
                    <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td><strong>{{ $book->title }}</strong></td>
                    <td>{{ $book->author }}</td>
                    <td><span class="badge bg-light text-dark">{{ $book->category->name }}</span></td>
                    <td>
                        @if($book->stock > 0)
                            <span class="badge bg-success">{{ $book->stock }}</span>
                        @else
                            <span class="badge bg-danger">Habis</span>
                        @endif
                    </td>
                    <td>{{ $book->publisher ?? '-' }}</td>
                    <td>{{ $book->year ?? '-' }}</td>
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'petugas')
                    <td>
                        <a href="{{ route('admin.books.show', $book->id) }}" class="btn btn-sm btn-info" title="Lihat">
                            <i class="fas fa-eye"></i>
                        </a>
                        @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-warning" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="confirmDelete(event)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="fas fa-inbox fa-3x mb-3" style="opacity: 0.5;"></i>
                        <p>Tidak ada buku yang ditemukan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $books->links('pagination::bootstrap-5') }}
</div>
@endsection
