@extends('layouts.app')
@section('title', 'Review - ' . $book->title)
@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="fas fa-star"></i> Review untuk {{ $book->title }}</h2>
    </div>
    <div class="col-md-4 text-end">
        @auth
            <a href="{{ route('reviews.create', $book->id) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tulis Review</a>
        @endauth
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h3 class="text-warning">{{ number_format($averageRating, 1) }}</h3>
                <div class="text-warning" style="font-size: 1.2rem;">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= round($averageRating))
                            <i class="fas fa-star"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <p class="text-muted mb-0">{{ $ratingCount }} review</p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-3">Distribusi Rating</h6>
                @for($i = 5; $i >= 1; $i--)
                    <div class="mb-2">
                        <small>{{ $i }} <i class="fas fa-star text-warning"></i></small>
                        <div class="progress" style="height: 20px;">
                            @php $percentage = $ratingCount > 0 ? ($ratingBreakdown[$i] / $ratingCount) * 100 : 0; @endphp
                            <div class="progress-bar bg-warning" style="width: {{ $percentage }}%">
                                {{ $ratingBreakdown[$i] }}
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Ulasan dari Pembaca</h5>
    </div>
    <div class="card-body">
        @forelse($reviews as $review)
            <div class="border-bottom pb-3 mb-3">
                <div class="d-flex justify-content-between align-items-start">
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
    </div>
</div>

{{ $reviews->links() }}
@endsection
