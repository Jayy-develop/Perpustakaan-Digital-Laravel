@extends('layouts.app')
@section('title', 'Moderasi Review')
@section('content')
<h2><i class="fas fa-check-square"></i> Moderasi Review</h2>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-center bg-warning text-dark">
            <div class="card-body">
                <h3>{{ $stats['pending'] }}</h3>
                <p class="mb-0">Review Tertunda</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center bg-success text-white">
            <div class="card-body">
                <h3>{{ $stats['approved'] }}</h3>
                <p class="mb-0">Review Disetujui</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center bg-info text-white">
            <div class="card-body">
                <h3>{{ $stats['total'] }}</h3>
                <p class="mb-0">Total Review</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Pengguna</th>
                    <th>Buku</th>
                    <th>Rating</th>
                    <th>Komentar</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reviews as $review)
                    <tr>
                        <td>
                            <strong>{{ $review->user->name }}</strong><br>
                            <small class="text-muted">{{ $review->user->email }}</small>
                        </td>
                        <td>{{ $review->book->title }}</td>
                        <td>
                            <div class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </td>
                        <td>
                            @if($review->comment)
                                <small>{{ Str::limit($review->comment, 50) }}</small>
                            @else
                                <small class="text-muted">Tanpa komentar</small>
                            @endif
                        </td>
                        <td>
                            @if($review->is_approved)
                                <span class="badge bg-success"><i class="fas fa-check"></i> Disetujui</span>
                            @else
                                <span class="badge bg-warning"><i class="fas fa-hourglass-half"></i> Tertunda</span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                        </td>
                        <td>
                            <a href="{{ route('admin.books.show', $review->book_id) }}" class="btn btn-sm btn-info" title="Lihat Buku"><i class="fas fa-book"></i></a>
                            @if(!$review->is_approved)
                                <form action="{{ route('reviews.approve', $review->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" title="Setujui"><i class="fas fa-check"></i></button>
                                </form>
                                <form action="{{ route('reviews.reject', $review->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" title="Tolak" onclick="return confirm('Tolak review ini?')"><i class="fas fa-times"></i></button>
                                </form>
                            @else
                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Hapus review?')"><i class="fas fa-trash"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            Tidak ada review
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{ $reviews->links() }}
@endsection
