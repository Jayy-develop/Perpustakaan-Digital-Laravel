@extends('layouts.app')
@section('title', 'Tulis Review - ' . $book->title)
@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h2><i class="fas fa-pen"></i> Tulis Review untuk {{ $book->title }}</h2>

        <div class="card mb-4">
            <div class="row g-0">
                <div class="col-md-3">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center rounded-start" style="height: 250px;">
                            <i class="fas fa-book fa-5x text-muted"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text"><strong>Pengarang:</strong> {{ $book->author }}</p>
                        <p class="card-text"><strong>Penerbit:</strong> {{ $book->publisher }}</p>
                        <p class="card-text"><strong>Tahun:</strong> {{ $book->year }}</p>
                        <p class="card-text"><strong>Kategori:</strong> {{ $book->category->name }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('reviews.store', $book->id) }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating <span class="text-danger">*</span></label>
                        <div class="rating-input">
                            @for($i = 5; $i >= 1; $i--)
                                <label class="form-check form-check-inline">
                                    <input type="radio" name="rating" value="{{ $i }}" class="form-check-input" @if(old('rating') == $i) checked @endif>
                                    <span class="text-warning" style="font-size: 1.5rem; cursor: pointer;">
                                        @for($j = 1; $j <= $i; $j++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @for($j = $i; $j < 5; $j++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                    </span>
                                </label>
                            @endfor
                        </div>
                        @error('rating')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Komentar</label>
                        <textarea name="comment" id="comment" rows="6" class="form-control @error('comment') is-invalid @enderror" placeholder="Bagikan pengalaman Anda membaca buku ini...">{{ old('comment') }}</textarea>
                        <small class="form-text text-muted">Maksimal 1000 karakter</small>
                        @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle"></i> Review Anda akan ditampilkan setelah disetujui oleh admin.
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fas fa-send"></i> Kirim Review</button>
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
