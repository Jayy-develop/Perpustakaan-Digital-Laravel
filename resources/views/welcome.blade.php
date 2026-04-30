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

@foreach(['Teknologi','Novel','Sejarah','Bisnis'] as $cat)
<div class="p-10 bg-indigo-50 rounded-2xl text-center shadow hover:shadow-xl">
<h3 class="font-semibold text-lg">{{$cat}}</h3>
</div>
@endforeach

</div>
</section>

<!-- BOOK GRID -->
<section id="book-grid" class="py-24 bg-gray-50">

<h2 class="text-3xl font-bold text-center mb-16">
Rekomendasi Buku
</h2>

<div class="max-w-7xl mx-auto grid md:grid-cols-5 gap-8 px-8">

@for($i=1;$i<=15;$i++)
<div class="bg-white rounded-xl shadow hover:shadow-xl transition">

<img src="https://picsum.photos/300/400?random={{$i}}"
class="rounded-t-xl">

<div class="p-4">
<h3 class="font-semibold">Buku {{$i}}</h3>
<p class="text-sm text-gray-500">Best Seller</p>
</div>

</div>
@endfor

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

<!-- FOOTER -->
<footer class="bg-black text-gray-400 py-12 text-center">
© {{ date('Y') }} Smart Library Management System. All rights reserved.
</footer>

</x-guest-layout>