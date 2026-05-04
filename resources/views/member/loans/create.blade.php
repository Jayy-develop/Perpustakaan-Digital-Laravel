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
                        <label class="form-label">Pilih Buku <span class="text-danger">*</span></label>

                        <input type="hidden" name="book_id" id="book_id" value="{{ old('book_id') }}">

                        <div class="mb-2">
                            <input id="bookSearch" type="search" class="form-control" placeholder="Cari judul atau penulis..." />
                        </div>

                        <style>
                            .book-select-item { cursor: pointer; transition: box-shadow .15s, border-color .15s; }
                            .book-select-item.selected { border-color: var(--primary-color); box-shadow: 0 4px 14px rgba(59,130,246,0.12); }
                            .book-list-scroll { max-height: 380px; overflow-y: auto; }
                        </style>

                        <div class="row g-2 book-list-scroll" id="bookList">
                            @foreach($books as $book)
                                <div class="col-12">
                                    <div class="d-flex align-items-center p-2 border rounded book-select-item @if(old('book_id') == $book->id) selected @endif"
                                         data-book-id="{{ $book->id }}">

                                        <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : 'https://picsum.photos/80/120?random=' . $book->id }}"
                                             alt="Cover" class="me-3 book-cover" style="width:60px;height:80px;object-fit:cover;">

                                        <div class="flex-grow-1">
                                            <div class="fw-bold">{{ $book->title }}</div>
                                            <div class="text-muted small">{{ $book->author }} &nbsp; <span class="badge bg-secondary">Stock: {{ $book->stock }}</span></div>
                                        </div>

                                        <div class="ms-3">
                                            <button type="button" class="btn btn-outline-primary btn-sm select-book-btn">Pilih</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @error('book_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-download"></i> Pinjam</button>
                    <a href="{{ route('loans.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </div>
    </div>
</div>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const bookSearch = document.getElementById('bookSearch');
                        const bookList = document.getElementById('bookList');
                        if (!bookList) return;
                        const bookItems = Array.from(bookList.querySelectorAll('.book-select-item'));
                        const bookIdInput = document.getElementById('book_id');

                        function clearSelected() {
                            bookItems.forEach(i => i.classList.remove('selected'));
                        }

                        function selectItem(item) {
                            clearSelected();
                            item.classList.add('selected');
                            bookIdInput.value = item.getAttribute('data-book-id');
                        }

                        bookItems.forEach(item => {
                            item.addEventListener('click', function() {
                                selectItem(item);
                            });

                            const btn = item.querySelector('.select-book-btn');
                            if (btn) {
                                btn.addEventListener('click', function(e) {
                                    e.stopPropagation();
                                    selectItem(item);
                                });
                            }
                        });

                        if (bookIdInput.value) {
                            const initial = bookItems.find(i => i.getAttribute('data-book-id') === String(bookIdInput.value));
                            if (initial) {
                                initial.classList.add('selected');
                                initial.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                        }

                        if (bookSearch) {
                            bookSearch.addEventListener('input', function() {
                                const q = this.value.trim().toLowerCase();
                                bookItems.forEach(item => {
                                    const title = item.querySelector('.fw-bold').textContent.toLowerCase();
                                    const author = item.querySelector('.text-muted').textContent.toLowerCase();
                                    if (title.includes(q) || author.includes(q)) {
                                        item.parentElement.style.display = '';
                                    } else {
                                        item.parentElement.style.display = 'none';
                                    }
                                });
                            });
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
