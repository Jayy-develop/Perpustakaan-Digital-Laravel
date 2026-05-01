<header class="bg-white shadow-md" id="home">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between px-8 py-5">

        <h1 class="text-2xl font-bold text-indigo-600">
            Perpustakaan Digital
        </h1>

        <div class="flex flex-wrap items-center gap-4 text-gray-700 font-medium">
            <a href="#home" class="hover:text-indigo-600">Beranda</a>
            <a href="#book-grid" class="hover:text-indigo-600">Koleksi</a>
            <a href="#category" class="hover:text-indigo-600">Kategori</a>
            <a href="#why-us" class="hover:text-indigo-600">Tentang</a>

            <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-lg">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="border border-indigo-600 text-indigo-600 px-5 py-2 rounded-lg hover:bg-indigo-50">Register</a>
            @endif
        </div>

    </div>
</header>
