@extends('layouts.app')
@section('title', 'Buku')
@section('content')
<h2><i class="fas fa-book"></i> Daftar Buku</h2>
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row">
            <div class="col-md-6"><input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}"></div>
            <div class="col-md-4">
                <select name="category_id" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $c)<option value="{{ $c->id }}" @if(request('category_id')==$c->id) selected @endif>{{ $c->name }}</option>@endforeach
                </select>
            </div>
            <div class="col-md-2"><button type="submit" class="btn btn-info w-100">Cari</button></div>
        </form>
    </div>
</div>
<div class="row">
    @forelse($books as $book)
    <div class="col-md-3 mb-4">
        <div class="card h-100">
            @if($book->cover_image)<img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top book-cover" alt="{{ $book->title }}">@else<div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:200px;"><i class="fas fa-book fa-3x text-muted"></i></div>@endif
            <div class="card-body">
                <h5 class="card-title">{{ $book->title }}</h5>
                <p class="text-muted small">{{ $book->author }}</p>
                <p class="text-muted small">{{ $book->category->name }}</p>
                <p>Stock: <strong @if($book->stock>0) class="text-success" @else class="text-danger" @endif>{{ $book->stock }}</strong></p>
                <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary btn-sm w-100">Lihat Detail</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5"><p class="text-muted">Tidak ada buku</p></div>
    @endforelse
</div>
{{ $books->withQueryString()->links('vendor.pagination.bootstrap-5-no-prev-next') }}
@endsection
