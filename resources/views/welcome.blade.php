<x-guest-layout>

    <x-guest-navbar />

    <!-- HERO -->
    <section class="relative overflow-hidden bg-white">
        <div class="absolute -right-72 -top-40 transform rotate-12 opacity-20">
            <svg width="520" height="520" viewBox="0 0 520 520" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="260" cy="260" r="260" fill="#6366F1"/>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 md:px-8 py-24">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight">Perpustakaan Digital Modern untuk
                        <span class="text-indigo-600">Pembaca Serius</span>
                    </h1>

                    <p class="mt-6 text-lg text-gray-600 max-w-xl">Akses ribuan judul berkualitas, kelola peminjaman dengan mudah,
                        dan nikmati pengalaman membaca yang cepat, aman, dan menyenangkan.</p>

                    <div class="mt-8 flex gap-3">
                        <a href="{{ auth()->check() ? route('books.index') : route('login') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-lg shadow-lg font-semibold hover:bg-indigo-700">Mulai Membaca</a>
                        <a href="#book-grid" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50">Lihat Koleksi</a>
                    </div>

                    <div class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">{{ $books->count() }}</div>
                            <div class="text-sm text-gray-500">Buku</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">{{ $categories->count() }}</div>
                            <div class="text-sm text-gray-500">Kategori</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">1352</div>
                            <div class="text-sm text-gray-500">Anggota Baru</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">Bebas</div>
                            <div class="text-sm text-gray-500">Akses</div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da" alt="Books" class="rounded-3xl shadow-2xl w-full object-cover h-96 md:h-[520px]">
                    <div class="absolute bottom-6 left-6 bg-white/90 p-3 rounded-xl shadow">
                        <div class="text-sm text-gray-700">Rekomendasi</div>
                        <div class="font-semibold">{{ $books->first()->title ?? 'Buku Pilihan' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 md:px-8">
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <div class="text-indigo-600 text-3xl">📚</div>
                    <h3 class="mt-4 font-bold text-lg">Koleksi Lengkap</h3>
                    <p class="mt-2 text-gray-600 text-sm">Ribuan judul dari berbagai genre, terus diperbarui setiap minggu.</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <div class="text-indigo-600 text-3xl">⚡</div>
                    <h3 class="mt-4 font-bold text-lg">Cepat & Mudah</h3>
                    <p class="mt-2 text-gray-600 text-sm">Sistem peminjaman yang cepat dan notifikasi pengingat otomatis.</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <div class="text-indigo-600 text-3xl">🔒</div>
                    <h3 class="mt-4 font-bold text-lg">Aman & Terpercaya</h3>
                    <p class="mt-2 text-gray-600 text-sm">Data terlindungi dan proses verifikasi anggota yang mudah.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CATEGORY + BOOK GRID -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6 md:px-8">
            <div class="flex items-center justify-between mb-6">
                <h2 id="book-grid" class="text-2xl font-bold">Koleksi Buku Terbaru</h2>
                <div class="flex items-center gap-3">
                    <div class="hidden md:block">
                        <label for="bookSearchInput" class="sr-only">Cari Buku</label>
                        <div class="relative">
                            <input id="bookSearchInput" type="search" placeholder="Cari judul, penulis, atau kategori..." class="rounded-full border border-gray-200 bg-white py-2 pl-4 pr-10 text-sm text-gray-700 outline-none focus:ring-2 focus:ring-indigo-100" />
                            <span class="absolute right-3 top-2 text-gray-400">🔍</span>
                        </div>
                    </div>

                </div>
            </div>

            <div id="categoryButtons" class="mb-6 flex gap-3 overflow-x-auto md:overflow-visible pb-2">
                <button class="category-btn px-4 py-2 bg-indigo-600 text-white rounded-full font-semibold" data-category="all">Semua</button>
                @if($categories->count())
                    @foreach($categories as $cat)
                        <button class="category-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-full" data-category="{{ $cat->name }}">{{ $cat->name }}</button>
                    @endforeach
                @endif
            </div>

            @php
                if (method_exists($books, 'items')) {
                    $allBooks = collect($books->items());
                } else {
                    $allBooks = collect($books);
                }
                $initialBooks = $allBooks->take(12);
                $remainingBooks = $allBooks->slice(12);
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="booksGrid">
                @forelse($initialBooks as $book)
                    <div class="bg-white rounded-xl shadow hover:shadow-2xl overflow-hidden book-card cursor-pointer" 
                         data-title="{{ e($book->title) }}"
                         data-author="{{ e($book->author) }}"
                         data-category="{{ e($book->category->name ?? 'Umum') }}"
                         data-description="{{ e($book->description ?? 'Deskripsi tidak tersedia untuk buku ini.') }}"
                         data-image="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : 'https://picsum.photos/400/600?random=' . $book->id }}"
                         data-url="{{ auth()->check() ? route('books.show', $book->id) : route('login') }}">

                        <div class="h-56 overflow-hidden">
                            <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : 'https://picsum.photos/400/600?random=' . $book->id }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                        </div>

                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 line-clamp-2">{{ $book->title }}</h3>
                            <p class="text-xs text-gray-500 mt-1">{{ $book->author }}</p>
                            <div class="mt-3 flex items-center justify-between">
                                <span class="text-xs text-gray-400">{{ $book->category->name ?? 'Umum' }}</span>
                                <span class="text-xs text-gray-600">Stock: {{ $book->stock }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">Belum ada buku yang tersedia</div>
                @endforelse

                @foreach($remainingBooks as $book)
                    <div class="bg-white rounded-xl shadow hover:shadow-2xl overflow-hidden book-card cursor-pointer extra-book hidden" 
                         data-title="{{ e($book->title) }}"
                         data-author="{{ e($book->author) }}"
                         data-category="{{ e($book->category->name ?? 'Umum') }}"
                         data-description="{{ e($book->description ?? 'Deskripsi tidak tersedia untuk buku ini.') }}"
                         data-image="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : 'https://picsum.photos/400/600?random=' . $book->id }}"
                         data-url="{{ auth()->check() ? route('books.show', $book->id) : route('login') }}">

                        <div class="h-56 overflow-hidden">
                            <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : 'https://picsum.photos/400/600?random=' . $book->id }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                        </div>

                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 line-clamp-2">{{ $book->title }}</h3>
                            <p class="text-xs text-gray-500 mt-1">{{ $book->author }}</p>
                            <div class="mt-3 flex items-center justify-between">
                                <span class="text-xs text-gray-400">{{ $book->category->name ?? 'Umum' }}</span>
                                <span class="text-xs text-gray-600">Stock: {{ $book->stock }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 text-center">
                <button id="showAllBooksBtn" class="text-indigo-600 font-semibold hover:underline bg-transparent border-0 p-0">Lihat Semua</button>
            </div>
        </div>
    </section>

    <!-- WHY US / CTA -->
    <section id="why-us" class="py-20 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white">
        <div class="max-w-6xl mx-auto px-6 md:px-8 text-center">
            <h2 class="text-3xl font-bold">Kenapa Memilih Perpustakaan Kami?</h2>
            <p class="mt-4 text-indigo-100 max-w-2xl mx-auto">Platform modern, koleksi luas, dan fitur peminjaman yang dirancang untuk kenyamanan Anda.</p>

            <div class="mt-10 grid md:grid-cols-3 gap-6">
                <div class="bg-white/10 p-6 rounded-xl">
                    <h4 class="font-semibold">Akses Cepat</h4>
                    <p class="text-sm text-indigo-100 mt-2">Antarmuka yang cepat dan responsif di semua perangkat.</p>
                </div>
                <div class="bg-white/10 p-6 rounded-xl">
                    <h4 class="font-semibold">Rekomendasi Pintar</h4>
                    <p class="text-sm text-indigo-100 mt-2">Dapatkan rekomendasi berdasarkan minat dan riwayat baca.</p>
                </div>
                <div class="bg-white/10 p-6 rounded-xl">
                    <h4 class="font-semibold">Dukungan Anggota</h4>
                    <p class="text-sm text-indigo-100 mt-2">Tim support siap membantu kapan saja.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6 md:px-8">
            <h3 class="text-2xl font-bold text-center mb-8">Apa Kata Pengguna</h3>
            <div class="grid md:grid-cols-3 gap-6">
                @for($i=1;$i<=3;$i++)
                    <div class="p-6 rounded-xl shadow">
                        <p class="text-gray-700">"Pengalaman membaca jadi lebih mudah. Fitur pencarian dan rekomendasinya sangat membantu."</p>
                        <div class="mt-4 font-semibold">Member {{ $i }}</div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- MODAL -->
    <div id="bookModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 px-4 py-8">
        <div class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full mx-4 overflow-hidden">
            <div class="grid md:grid-cols-3 gap-4 p-4 md:p-6">
                <div class="md:col-span-1">
                    <img id="modalImage" src="" class="w-full h-48 md:h-64 object-cover rounded-2xl" alt="Cover Buku">
                </div>
                <div class="md:col-span-2">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 id="modalTitle" class="text-xl md:text-2xl font-bold text-gray-900"></h3>
                            <p id="modalCategory" class="text-sm text-gray-500 mt-2"></p>
                        </div>
                        <button id="modalClose" class="text-gray-500 hover:text-gray-900 text-2xl">&times;</button>
                    </div>
                    <p id="modalAuthor" class="text-sm text-gray-600 mt-4"></p>
                    <div class="mt-6 text-gray-700 leading-relaxed text-sm md:text-base" id="modalDescription"></div>
                    <div class="mt-8">
                        <a id="modalAction" href="" class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-4 md:px-6 py-3 text-white font-semibold shadow-lg hover:bg-indigo-700 transition text-sm md:text-base">
                            {{ auth()->check() ? 'Lihat Detail Buku' : 'Login untuk Detail' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-6xl mx-auto px-6 md:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <div class="text-lg font-semibold text-white">Perpustakaan Digital</div>
                    <div class="text-sm text-gray-400">© {{ date('Y') }} Smart Library Management System. All rights reserved.</div>
                </div>

                <div class="flex gap-4">
                    <a href="#" class="text-gray-400 hover:text-white">Terms</a>
                    <a href="#" class="text-gray-400 hover:text-white">Privacy</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // filtering, revealing more books, and modal wiring
        document.addEventListener('DOMContentLoaded', function(){
            const searchInput = document.getElementById('bookSearchInput');
            const categoryButtons = document.querySelectorAll('.category-btn');
            let bookCards = Array.from(document.querySelectorAll('.book-card'));
            const booksGrid = document.getElementById('booksGrid');
            const categoryContainer = document.getElementById('categoryButtons');

            function filterBooks(){
                const q = searchInput ? searchInput.value.trim().toLowerCase() : '';
                const active = Array.from(categoryButtons).find(b=>b.classList.contains('bg-indigo-600'));
                const cat = active ? active.getAttribute('data-category').toLowerCase() : 'all';

                bookCards.forEach(card => {
                    const title = (card.getAttribute('data-title')||'').toLowerCase();
                    const author = (card.getAttribute('data-author')||'').toLowerCase();
                    const category = (card.getAttribute('data-category')||'').toLowerCase();
                    const matchQ = q==='' || title.includes(q) || author.includes(q) || category.includes(q);
                    const matchCat = cat==='all' || category===cat;
                    card.style.display = (matchQ && matchCat) ? '' : 'none';
                });
            }

            if(searchInput){ searchInput.addEventListener('input', filterBooks); }
            categoryButtons.forEach(btn=>{
                btn.addEventListener('click', function(){
                    categoryButtons.forEach(b=>b.classList.remove('bg-indigo-600','text-white'));
                    this.classList.add('bg-indigo-600','text-white');
                    filterBooks();
                });
            });

            // Modal helpers
            const modal = document.getElementById('bookModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');
            const modalAuthor = document.getElementById('modalAuthor');
            const modalCategory = document.getElementById('modalCategory');
            const modalDescription = document.getElementById('modalDescription');
            const modalAction = document.getElementById('modalAction');
            const modalClose = document.getElementById('modalClose');

            function openModalForCard(card){
                modalImage.src = card.getAttribute('data-image') || '';
                modalTitle.textContent = card.getAttribute('data-title') || '';
                modalAuthor.textContent = 'Penulis: ' + (card.getAttribute('data-author') || '');
                modalCategory.textContent = 'Kategori: ' + (card.getAttribute('data-category') || '');
                modalDescription.textContent = card.getAttribute('data-description') || '';
                modalAction.href = card.getAttribute('data-url') || '#';
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function attachCardListeners(root=document){
                const cards = root.querySelectorAll('.book-card');
                cards.forEach(card => {
                    if (!card._listenerAttached) {
                        card.addEventListener('click', function(){ openModalForCard(card); });
                        card._listenerAttached = true;
                    }
                });
                bookCards = Array.from(document.querySelectorAll('.book-card'));
            }

            attachCardListeners();

            modalClose && modalClose.addEventListener('click', function(){ modal.classList.add('hidden'); modal.classList.remove('flex'); });
            modal && modal.addEventListener('click', function(e){ if(e.target===modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); } });

            // Show all button behavior
            const showBtn = document.getElementById('showAllBooksBtn');
            if (showBtn){
                showBtn.addEventListener('click', function(e){
                    e.preventDefault();
                    // reveal additional books
                    document.querySelectorAll('.extra-book').forEach(el => el.classList.remove('hidden'));
                    // disable horizontal overflow on category buttons for wider screens
                    if (categoryContainer) categoryContainer.classList.remove('overflow-x-auto');
                    // attach listeners for newly shown items
                    attachCardListeners();
                    // hide the button
                    showBtn.style.display = 'none';
                    // scroll to books grid
                    const grid = document.getElementById('booksGrid');
                    grid && grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            }
        });
    </script>

</x-guest-layout>