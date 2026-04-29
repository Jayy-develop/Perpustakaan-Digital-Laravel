@extends('layouts.app')
@section('title', $book->title)
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            @if($book->cover_image)<img src="{{ asset('storage/' . $book->cover_image) }}" class="card-img-top book-cover" alt="{{ $book->title }}">@else<div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:300px;"><i class="fas fa-book fa-5x text-muted"></i></div>@endif
            <div class="card-body">
                <p>Stock: <strong>{{ $book->stock }}</strong></p>
                <div class="mb-3">
                    <div class="text-warning">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($averageRating))
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <small class="text-muted">{{ number_format($averageRating, 1) }} ({{ $ratingCount }} review)</small>
                </div>
                @if(auth()->user()->role === 'member' && $book->stock > 0)
                    <form action="{{ route('loans.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-download"></i> Pinjam</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h2>{{ $book->title }}</h2>
                <p class="text-muted"><strong>{{ $book->author }}</strong></p>
                <hr>
                <p><strong>Kategori:</strong> {{ $book->category->name }}</p>
                <p><strong>Penerbit:</strong> {{ $book->publisher ?? '-' }}</p>
                <p><strong>Tahun:</strong> {{ $book->year ?? '-' }}</p>
                <p><strong>Stock:</strong> <span class="badge @if($book->stock>0) bg-success @else bg-danger @endif">{{ $book->stock }}</span></p>
                <hr>
                <h5>Deskripsi</h5>
                <p>{{ $book->description ?? 'Tidak ada' }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0"><i class="fas fa-comments"></i> Review & Rating</h5>
                @if(auth()->check() && auth()->user()->role === 'member')
                    <a href="{{ route('reviews.create', $book->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tulis Review</a>
                @endif
            </div>
            <div class="card-body">
                @forelse($reviews as $review)
                    <div class="border-bottom pb-3 mb-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <strong>{{ $review->user->name }}</strong>
                                <div class="text-warning" style="font-size: 0.9rem;">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                            @if(auth()->check() && (auth()->id() === $review->user_id || auth()->user()->role === 'admin'))
                                <div>
                                    <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus review?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        @if($review->comment)
                            <p class="mt-2 mb-0">{{ $review->comment }}</p>
                        @endif
                    </div>
                @empty
                    <p class="text-center text-muted py-4">Belum ada review untuk buku ini</p>
                @endforelse
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
