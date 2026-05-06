📚 Perpustakaan Digital Laravel

Sistem Perpustakaan Digital Berbasis Web yang dibangun menggunakan Laravel Framework untuk memudahkan pengguna dalam mencari buku, melihat katalog, dan melakukan peminjaman buku secara online.

🚀 Fitur Utama
👤 Member (User)
Melihat dashboard perpustakaan
Mencari buku berdasarkan judul / kategori
Melihat detail buku
Melakukan peminjaman buku
Melihat riwayat peminjaman
Status peminjaman buku
📚 Sistem Perpustakaan
Manajemen data buku
Katalog buku digital
Sistem peminjaman
Status pengembalian
Tampilan UI modern berbasis web
🛠️ Teknologi yang Digunakan
Laravel
PHP
MySQL
Blade Template
Bootstrap / CSS
JavaScript
⚙️ Instalasi Project
1️⃣ Clone Repository
git clone https://github.com/Jayy-develop/Perpustakaan-Digital-Laravel.git

Masuk ke folder project:

cd Perpustakaan-Digital-Laravel
2️⃣ Install Dependency
composer install

Jika menggunakan frontend:

npm install
npm run dev
3️⃣ Copy File Environment
cp .env.example .env
4️⃣ Generate Key Laravel
php artisan key:generate
5️⃣ Konfigurasi Database

Edit file .env

DB_DATABASE=perpustakaan
DB_USERNAME=root
DB_PASSWORD=
6️⃣ Migrasi Database
php artisan migrate

(Optional jika ada seeder)

php artisan db:seed
7️⃣ Jalankan Server
php artisan serve

Buka browser:

http://localhost:8000
📂 Struktur Folder Penting
app/            → Logic aplikasi
routes/         → Routing web
resources/views → Tampilan Blade
database/       → Migration & Seeder
public/         → Asset publik
🎯 Tujuan Project

Project ini dibuat untuk:

Pembelajaran Framework Laravel
Implementasi Sistem Informasi Perpustakaan
Simulasi aplikasi layanan digital berbasis web
Project akademik mahasiswa
👨‍💻 Developer

Jaya Pratama
GitHub: https://github.com/Jayy-develop

📄 License

Project ini dibuat untuk kebutuhan pembelajaran dan pengembangan pribadi.
