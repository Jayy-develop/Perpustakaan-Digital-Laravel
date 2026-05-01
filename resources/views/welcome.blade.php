<x-guest-layout>

<x-guest-navbar />

<!-- HERO -->
<section class="bg-gradient-to-r from-indigo-50 to-white">
<div class="max-w-7xl mx-auto grid md:grid-cols-2 items-center px-8 py-24">

<div>
<h1 class="text-5xl font-bold text-gray-800 mb-6">
Perpustakaan Digital Modern
</h1>

<p class="text-lg text-gray-600 mb-8">
Temukan ribuan buku terbaik, kelola peminjaman,
dan nikmati pengalaman membaca kelas premium.
</p>

<a href="{{ route('login') }}"
class="bg-indigo-600 text-white px-8 py-4 rounded-xl font-semibold shadow-lg">
Mulai Membaca
</a>
</div>

<img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da"
class="rounded-3xl shadow-2xl">

</div>
</section>

<!-- CATEGORY -->
<section id="category" class="py-20 bg-white">
<h2 class="text-3xl font-bold text-center mb-12">
Kategori Populer
</h2>

<div class="max-w-6xl mx-auto grid md:grid-cols-4 gap-8 px-8">

@forelse($categories as $cat)
<div class="p-10 bg-indigo-50 rounded-2xl text-center shadow hover:shadow-xl">
<h3 class="font-semibold text-lg">{{ $cat->name }}</h3>
</div>
@empty
@foreach(['Teknologi','Novel','Sejarah','Bisnis'] as $cat)
<div class="p-10 bg-indigo-50 rounded-2xl text-center shadow hover:shadow-xl">
<h3 class="font-semibold text-lg">{{ $cat }}</h3>
</div>
@endforeach
@endforelse

</div>
</section>

<!-- BOOK GRID -->
<section id="book-grid" class="py-24 bg-gray-50">

<h2 class="text-3xl font-bold text-center mb-16">
Rekomendasi Buku
</h2>

<div class="max-w-7xl mx-auto grid md:grid-cols-5 gap-8 px-8">

@forelse($books as $book)
<div class="bg-white rounded-xl shadow hover:shadow-xl transition overflow-hidden cursor-pointer book-card"
    data-title="{{ e($book->title) }}"
    data-author="{{ e($book->author) }}"
    data-category="{{ e($book->category->name ?? 'Umum') }}"
    data-description="{{ e($book->description ?? 'Deskripsi tidak tersedia untuk buku ini.') }}"
    data-image="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : 'https://picsum.photos/300/400?random=' . $book->id }}"
    data-url="{{ auth()->check() ? route('books.show', $book->id) : route('login') }}">

    <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : 'https://picsum.photos/300/400?random=' . $book->id }}"
        class="rounded-t-xl w-full h-64 object-cover">

    <div class="p-4">
        <h3 class="text-lg font-semibold text-gray-800 hover:text-indigo-600 mb-1">{{ $book->title }}</h3>
        <p class="text-sm text-gray-500">{{ $book->author }}</p>
        <p class="text-sm text-gray-500">{{ $book->category->name ?? 'Umum' }}</p>
    </div>

</div>
@empty
<div class="col-span-5 text-center py-20 text-gray-500">
    Tidak ada buku yang tersedia saat ini.
</div>
@endforelse

</div>
</section>

<!-- WHY US -->
<section id="why-us" class="bg-indigo-600 text-white py-24">

<h2 class="text-3xl font-bold text-center mb-16">
Kenapa Memilih Kami?
</h2>

<div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-10 text-center">

<div>
<h3 class="text-xl font-bold mb-2">📚 Koleksi Lengkap</h3>
<p>Ribuan buku tersedia.</p>
</div>

<div>
<h3 class="text-xl font-bold mb-2">⚡ Cepat & Modern</h3>
<p>Sistem digital realtime.</p>
</div>

<div>
<h3 class="text-xl font-bold mb-2">👥 Member System</h3>
<p>Manajemen anggota profesional.</p>
</div>

</div>
</section>

<!-- TESTIMONI -->
<section class="py-24 bg-white">

<h2 class="text-3xl font-bold text-center mb-16">
Apa Kata Pengguna
</h2>

<div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-10 px-8">

@for($i=1;$i<=3;$i++)
<div class="shadow-lg p-8 rounded-xl">
<p>"Perpustakaan digital terbaik yang pernah saya gunakan."</p>
<h4 class="mt-4 font-bold">Member {{$i}}</h4>
</div>
@endfor

</div>
</section>


</section>

<!-- BOOK DETAIL MODAL -->
<div id="bookModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 px-4 py-8">
    <div class="bg-white rounded-3xl shadow-2xl max-w-3xl w-full overflow-hidden">
        <div class="grid md:grid-cols-3 gap-4 p-6">
            <div class="md:col-span-1">
                <img id="modalImage" src="" class="w-full h-64 object-cover rounded-2xl" alt="Cover Buku">
            </div>
            <div class="md:col-span-2">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 id="modalTitle" class="text-2xl font-bold text-gray-900"></h3>
                        <p id="modalCategory" class="text-sm text-gray-500 mt-2"></p>
                    </div>
                    <button id="modalClose" class="text-gray-500 hover:text-gray-900 text-2xl">&times;</button>
                </div>
                <p id="modalAuthor" class="text-sm text-gray-600 mt-4"></p>
                <div class="mt-6 text-gray-700 leading-relaxed" id="modalDescription"></div>
                <div class="mt-8">
                    <a id="modalAction" href="" class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-white font-semibold shadow-lg hover:bg-indigo-700 transition">
                        {{ auth()->check() ? 'Lihat Detail Buku' : 'Login untuk Detail' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="bg-black text-gray-400 py-12 text-center">
© {{ date('Y') }} Smart Library Management System. All rights reserved.
</footer>

<script>
    document.querySelectorAll('.book-card').forEach(function(card) {
        card.addEventListener('click', function() {
            var modal = document.getElementById('bookModal');
            document.getElementById('modalImage').src = card.dataset.image;
            document.getElementById('modalTitle').textContent = card.dataset.title;
            document.getElementById('modalAuthor').textContent = 'Penulis: ' + card.dataset.author;
            document.getElementById('modalCategory').textContent = 'Kategori: ' + card.dataset.category;
            document.getElementById('modalDescription').textContent = card.dataset.description;
            document.getElementById('modalAction').href = card.dataset.url;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });
    });

    document.getElementById('modalClose').addEventListener('click', function() {
        var modal = document.getElementById('bookModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    document.getElementById('bookModal').addEventListener('click', function(event) {
        if (event.target === this) {
            this.classList.add('hidden');
            this.classList.remove('flex');
        }
    });
</script>

</x-guest-layout>