<header id="home" class="w-full z-40">
    <div class="bg-gradient-to-r from-indigo-600 via-indigo-500 to-indigo-700 text-white">
        <div class="max-w-7xl mx-auto px-6 md:px-8">
            <div class="flex items-center justify-between py-4">
                <a href="/" class="flex items-center gap-3">
    
                    <div class="text-lg font-semibold">Perpustakaan Digital</div>
                </a>

                <nav class="hidden md:flex items-center gap-6 font-medium">
                    <a href="#home" class="hover:underline">Beranda</a>
                    <a href="#book-grid" class="hover:underline">Koleksi</a>
                    <a href="#category" class="hover:underline">Kategori</a>
                    <a href="#why-us" class="hover:underline">Tentang</a>
                </nav>

                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-md bg-white text-indigo-600 font-semibold shadow-sm hover:opacity-95">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-md border border-white/30 text-white hover:bg-white/10">Register</a>
                    @endif
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobileMenuBtn" aria-label="Open menu" class="text-white">
                        <svg id="iconOpen" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="iconClose" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobileMenu" class="hidden bg-white border-b">
        <div class="max-w-7xl mx-auto px-6 md:px-8 py-4">
            <div class="flex flex-col gap-3">
                <a href="#home" class="text-gray-800 font-medium">Beranda</a>
                <a href="#book-grid" class="text-gray-800 font-medium">Koleksi</a>
                <a href="#category" class="text-gray-800 font-medium">Kategori</a>
                <a href="#why-us" class="text-gray-800 font-medium">Tentang</a>
                <div class="pt-2">
                    <a href="{{ route('login') }}" class="block text-center px-4 py-2 rounded-md bg-indigo-600 text-white font-semibold">Login</a>
                </div>
                @if (Route::has('register'))
                <div>
                    <a href="{{ route('register') }}" class="block text-center px-4 py-2 rounded-md border border-indigo-600 text-indigo-600">Register</a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        (function(){
            const btn = document.getElementById('mobileMenuBtn');
            const menu = document.getElementById('mobileMenu');
            const iconOpen = document.getElementById('iconOpen');
            const iconClose = document.getElementById('iconClose');
            if(!btn) return;
            btn.addEventListener('click', function(){
                const open = menu.classList.toggle('hidden');
                iconOpen.classList.toggle('hidden');
                iconClose.classList.toggle('hidden');
            });
        })();
    </script>
</header>
