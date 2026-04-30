<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Perpustakaan')</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <style>
            :root {
                --primary-color: #3b82f6;
                --secondary-color: #6b7280;
            }
            
            body {
                background-color: #f9fafb;
            }
            
            .navbar {
                background-color: #fff;
                border-bottom: 1px solid #e5e7eb;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            }
            
            .sidebar {
                background-color: #1f2937;
                min-height: calc(100vh - 70px);
                padding: 20px 0;
            }
            
            .sidebar a {
                color: #d1d5db;
                text-decoration: none;
                padding: 12px 20px;
                display: block;
                transition: all 0.3s;
            }
            
            .sidebar a:hover {
                background-color: #374151;
                color: #fff;
                padding-left: 25px;
            }
            
            .sidebar a.active {
                background-color: var(--primary-color);
                color: #fff;
                border-right: 4px solid #fff;
            }
            
            .main-content {
                padding: 20px;
            }
            
            .card {
                border: none;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                margin-bottom: 20px;
            }
            
            .badge-borrowed {
                background-color: #fbbf24;
                color: #111827;
            }
            
            .badge-returned {
                background-color: #10b981;
                color: #fff;
            }
            
            .btn-primary {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
            }
            
            .btn-primary:hover {
                background-color: #2563eb;
                border-color: #2563eb;
            }
            
            .table-hover tbody tr:hover {
                background-color: #f3f4f6;
            }
            
            .book-cover {
                max-height: 250px;
                object-fit: cover;
                border-radius: 8px;
            }
            
            .user-role {
                font-size: 0.875rem;
                color: #6b7280;
            }
        </style>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <i class="fas fa-book"></i> Perpustakaan
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user"></i> {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                @auth
                <div class="col-md-2 sidebar">
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) active @endif">
                            <i class="fas fa-chart-line"></i> Dashboard
                        </a>
                        <a href="{{ route('users.index') }}" class="@if(request()->routeIs('users.*')) active @endif">
                            <i class="fas fa-users"></i> Pengguna
                        </a>
                        <a href="{{ route('categories.index') }}" class="@if(request()->routeIs('categories.*')) active @endif">
                            <i class="fas fa-list"></i> Kategori
                        </a>
                        <a href="{{ route('admin.books.index') }}" class="@if(request()->routeIs('admin.books.*')) active @endif">
                            <i class="fas fa-book"></i> Buku
                        </a>
                        <a href="{{ route('admin.loans.index') }}" class="@if(request()->routeIs('admin.loans.*')) active @endif">
                            <i class="fas fa-exchange"></i> Peminjaman
                        </a>
                        <a href="{{ route('fines.index') }}" class="@if(request()->routeIs('fines.*')) active @endif">
                            <i class="fas fa-file-invoice-dollar"></i> Denda
                        </a>
                        <a href="{{ route('reviews.admin-index') }}" class="@if(request()->routeIs('reviews.admin-index')) active @endif">
                            <i class="fas fa-star"></i> Review & Rating
                        </a>
                    @elseif(auth()->user()->role === 'petugas')
                        <a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) active @endif">
                            <i class="fas fa-chart-line"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.books.index') }}" class="@if(request()->routeIs('admin.books.*')) active @endif">
                            <i class="fas fa-book"></i> Buku
                        </a>
                        <a href="{{ route('admin.loans.index') }}" class="@if(request()->routeIs('admin.loans.*')) active @endif">
                            <i class="fas fa-exchange"></i> Peminjaman
                        </a>
                        <a href="{{ route('fines.index') }}" class="@if(request()->routeIs('fines.*')) active @endif">
                            <i class="fas fa-file-invoice-dollar"></i> Denda
                        </a>
                    @elseif(auth()->user()->role === 'member')
                        <a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) active @endif">
                            <i class="fas fa-chart-line"></i> Riwayat Peminjaman
                        </a>
                        <a href="{{ route('books.index') }}" class="@if(request()->routeIs('books.index')) active @endif">
                            <i class="fas fa-search"></i> Cari Buku
                        </a>
                        <a href="{{ route('loans.index') }}" class="@if(request()->routeIs('loans.index')) active @endif">
                            <i class="fas fa-exchange"></i> Peminjaman Saya
                        </a>
                        <a href="{{ route('fines.member') }}" class="@if(request()->routeIs('fines.member')) active @endif">
                            <i class="fas fa-file-invoice-dollar"></i> Denda Saya
                        </a>
                    @endif
                </div>
                @endauth

                <!-- Main Content -->
                <div class="col-md-10 main-content">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Terjadi Kesalahan!</h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Auto-hide alerts after 5 seconds
            document.querySelectorAll('.alert').forEach(function(element) {
                setTimeout(function() {
                    let alert = new bootstrap.Alert(element);
                    alert.close();
                }, 5000);
            });

            // Confirm delete
            function confirmDelete(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3b82f6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.submit();
                    }
                });
            }
        </script>
    </body>
</html>
