@component('mail::message')

# Halo {{ $name }},

Selamat datang di **Smart Library Management System**! Akun Anda hampir selesai.

Klik tombol di bawah untuk memverifikasi alamat email Anda dan mulai akses perpustakaan digital kami.

@component('mail::button', ['url' => $url, 'color' => 'primary'])
Verifikasi Email Saya
@endcomponent

Jika tombol di atas tidak berfungsi, salin dan tempel tautan berikut ke browser Anda:

[{{ $url }}]({{ $url }})

---

## Mengapa ini penting?
- Menjaga keamanan akun Anda
- Memastikan notifikasi peminjaman dan pengembalian terkirim
- Mengaktifkan akses penuh ke fitur member

Terima kasih telah bergabung dengan Smart Library.

Salam hangat,
Tim Smart Library

@endcomponent
