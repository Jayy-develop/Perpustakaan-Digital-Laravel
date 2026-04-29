@extends('layouts.app')

@section('content')

<div class="container py-5">

    <h2 class="mb-4 fw-bold">
        📚 Cari Buku Perpustakaan
    </h2>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('books.index') }}" class="mb-5">
        <div class="input-group">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari judul buku...">
            <button class="btn btn-dark">
                Cari
            </button>
        </div>
    </form>

    {{-- LIST BUKU --}}
    <div class="row">

        @forelse($books as $book)
        <div class="col-md-3 mb-4">

            <div class="card shadow-sm h-100 border-0">

                <div class="card-body">
                    <h5 class="fw-bold">{{ $book->title }}</h5>

                    <p class="text-muted mb-1">
                        Tahun: {{ $book->year }}
                    </p>

                    <span class="badge bg-success">
                        Tersedia
                    </span>
                </div>

            </div>

        </div>
        @empty
            <p>Buku belum tersedia.</p>
        @endforelse

    </div>

</div>

@endsection