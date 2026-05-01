<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['category_id' => 1, 'title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang Pustaka', 'year' => 2005, 'stock' => 12, 'description' => 'Kisah inspiratif murid di Belitung.'],
            ['category_id' => 1, 'title' => 'Sang Pemimpi', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang Pustaka', 'year' => 2006, 'stock' => 10, 'description' => 'Lanjutan perjalanan impian anak-anak Belitung.'],
            ['category_id' => 1, 'title' => 'Edensor', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang Pustaka', 'year' => 2007, 'stock' => 9, 'description' => 'Petualangan di negeri orang.'],
            ['category_id' => 1, 'title' => 'Maryamah Karpov', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang Pustaka', 'year' => 2012, 'stock' => 8, 'description' => 'Kisah lanjut dari keluarga Laskar Pelangi.'],
            ['category_id' => 1, 'title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'publisher' => 'Hasta Mitra', 'year' => 1980, 'stock' => 14, 'description' => 'Novel sejarah kolonialisme Hindia Belanda.'],
            ['category_id' => 1, 'title' => 'Anak Semua Bangsa', 'author' => 'Pramoedya Ananta Toer', 'publisher' => 'Hasta Mitra', 'year' => 1980, 'stock' => 12, 'description' => 'Kisah perjuangan Minke dan teman-temannya.'],
            ['category_id' => 1, 'title' => 'Gadis Pantai', 'author' => 'Pramoedya Ananta Toer', 'publisher' => 'Hasta Mitra', 'year' => 1980, 'stock' => 11, 'description' => 'Novel perjalanan kehidupan Raden Mas.'],
            ['category_id' => 1, 'title' => 'Saman', 'author' => 'Ayu Utami', 'publisher' => 'Gramedia', 'year' => 1998, 'stock' => 13, 'description' => 'Kisah perempuan dan politik Indonesia.'],
            ['category_id' => 1, 'title' => 'Larung', 'author' => 'Ayu Utami', 'publisher' => 'Gramedia', 'year' => 2001, 'stock' => 10, 'description' => 'Novel tentang kebebasan dan cinta.'],
            ['category_id' => 1, 'title' => 'Cantik Itu Luka', 'author' => 'Eka Kurniawan', 'publisher' => 'Gramedia', 'year' => 2002, 'stock' => 15, 'description' => 'Novel magis tentang keluarga dan sejarah.'],
            ['category_id' => 1, 'title' => 'Seperti Dendam, Rindu Harus Dibayar Tuntas', 'author' => 'Eka Kurniawan', 'publisher' => 'Gramedia', 'year' => 2014, 'stock' => 8, 'description' => 'Kisah balas dendam dan cinta di Indonesia modern.'],
            ['category_id' => 1, 'title' => 'Man Tiger', 'author' => 'Eka Kurniawan', 'publisher' => 'Gramedia', 'year' => 2018, 'stock' => 7, 'description' => 'Novel tentang cinta, balas dendam, dan nasib.'],
            ['category_id' => 1, 'title' => 'Pulang', 'author' => 'Leila S. Chudori', 'publisher' => 'Gramedia', 'year' => 2012, 'stock' => 9, 'description' => 'Kisah keluarga Indonesia di pengasingan.'],
            ['category_id' => 1, 'title' => 'Laut Bercerita', 'author' => 'Leila S. Chudori', 'publisher' => 'Gramedia', 'year' => 2018, 'stock' => 10, 'description' => 'Novel sejarah 1965 dan rasa kerinduan.'],
            ['category_id' => 1, 'title' => 'Amba', 'author' => 'Laksmi Pamuntjak', 'publisher' => 'Gramedia', 'year' => 2012, 'stock' => 10, 'description' => 'Kisah cinta dan politik pasca 1965.'],
            ['category_id' => 1, 'title' => 'Pintu', 'author' => 'Laksmi Pamuntjak', 'publisher' => 'Gramedia', 'year' => 2008, 'stock' => 8, 'description' => 'Novel tentang identitas dan ingatan.'],
            ['category_id' => 1, 'title' => 'Negeri 5 Menara', 'author' => 'Ahmad Fuadi', 'publisher' => 'Gramedia', 'year' => 2009, 'stock' => 13, 'description' => 'Cerita pesantren dan persahabatan.'],
            ['category_id' => 1, 'title' => 'Ranah 3 Warna', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang Pustaka', 'year' => 2013, 'stock' => 12, 'description' => 'Lanjutan kisah Laskar Pelangi di negeri lima warna.'],
            ['category_id' => 1, 'title' => 'Filosofi Kopi', 'author' => 'Dee Lestari', 'publisher' => 'Bentang Pustaka', 'year' => 2006, 'stock' => 11, 'description' => 'Cerita kopi, persahabatan, dan pilihan hidup.'],
            ['category_id' => 1, 'title' => 'Perahu Kertas', 'author' => 'Dee Lestari', 'publisher' => 'Bentang Pustaka', 'year' => 2009, 'stock' => 10, 'description' => 'Kisah cinta dua anak muda dan mimpi mereka.'],
            ['category_id' => 1, 'title' => 'Supernova: Ksatria, Putri, dan Bintang Jatuh', 'author' => 'Dee Lestari', 'publisher' => 'Bentang Pustaka', 'year' => 2001, 'stock' => 9, 'description' => 'Novel fiksi ilmiah dengan nuansa mistis.'],
            ['category_id' => 1, 'title' => 'Milea: Suara dari Dilan', 'author' => 'Pidi Baiq', 'publisher' => 'GagasMedia', 'year' => 2014, 'stock' => 14, 'description' => 'Sudut pandang Milea dari kisah Dilan.'],
            ['category_id' => 1, 'title' => 'Dilan: Dia adalah Dilanku Tahun 1990', 'author' => 'Pidi Baiq', 'publisher' => 'PenaKid Kids', 'year' => 2014, 'stock' => 16, 'description' => 'Novel romansa remaja era 1990-an.'],
            ['category_id' => 1, 'title' => 'Ada Apa dengan Cinta?', 'author' => 'Eka Kurniawan', 'publisher' => 'Gramedia', 'year' => 2016, 'stock' => 8, 'description' => 'Novel adaptasi film romantis Indonesia.'],
            ['category_id' => 1, 'title' => 'Napoleon Bonaparte', 'author' => 'Tere Liye', 'publisher' => 'Gramedia', 'year' => 2010, 'stock' => 7, 'description' => 'Novel sejarah dengan tokoh fiksi.'],
            ['category_id' => 1, 'title' => 'Bulan', 'author' => 'Tere Liye', 'publisher' => 'Gramedia', 'year' => 2012, 'stock' => 12, 'description' => 'Cerita fantasi dan persahabatan di negeri asing.'],
            ['category_id' => 1, 'title' => 'Hujan', 'author' => 'Tere Liye', 'publisher' => 'Gramedia', 'year' => 2014, 'stock' => 10, 'description' => 'Novel fantasi dengan nilai persahabatan.'],
            ['category_id' => 1, 'title' => 'Daun yang Jatuh Tak Pernah Membenci Angin', 'author' => 'Tere Liye', 'publisher' => 'Gramedia', 'year' => 2018, 'stock' => 9, 'description' => 'Kumpulan kisah inspiratif dan renungan.'],
            ['category_id' => 2, 'title' => '99 Cahaya di Langit Eropa', 'author' => 'Hanum Salsabiela Rais', 'publisher' => 'Atria', 'year' => 2013, 'stock' => 11, 'description' => 'Catatan perjalanan spiritual ke Eropa.'],
            ['category_id' => 2, 'title' => '99 Cahaya di Langit Eropa: Muslimah', 'author' => 'Raihanah', 'publisher' => 'Atria', 'year' => 2014, 'stock' => 10, 'description' => 'Lanjutan kisah perjalanan spiritual.'],
            ['category_id' => 2, 'title' => 'Sebuah Seni untuk Bersikap Bodo Amat', 'author' => 'Mark Manson', 'publisher' => 'Erlangga', 'year' => 2016, 'stock' => 13, 'description' => 'Buku pengembangan diri populer.'],
            ['category_id' => 2, 'title' => 'The Power of Habit', 'author' => 'Charles Duhigg', 'publisher' => 'Gramedia Pustaka Utama', 'year' => 2012, 'stock' => 11, 'description' => 'Analisis kebiasaan manusia.'],
            ['category_id' => 2, 'title' => 'Lima CM', 'author' => 'Donny Dhirgantoro', 'publisher' => 'Gramedia', 'year' => 2005, 'stock' => 14, 'description' => 'Cerita persahabatan dan pendakian.'],
            ['category_id' => 2, 'title' => 'Rectoverso', 'author' => 'Tere Liye', 'publisher' => 'Gramedia', 'year' => 2012, 'stock' => 12, 'description' => 'Kumpulan prosa dan puisi emosional.'],
            ['category_id' => 2, 'title' => 'Perahu Kertas: Remastered', 'author' => 'Dee Lestari', 'publisher' => 'Bentang Pustaka', 'year' => 2018, 'stock' => 8, 'description' => 'Edisi ulang dengan catatan penulis.'],
            ['category_id' => 3, 'title' => 'Guru Aini: Cinta di Sekolah Tuhan', 'author' => 'Sania', 'publisher' => 'Mizan', 'year' => 2017, 'stock' => 10, 'description' => 'Buku religi dan motivasi.'],
            ['category_id' => 3, 'title' => 'Catatan Juang', 'author' => 'Abraham Gea', 'publisher' => 'Mizan', 'year' => 2013, 'stock' => 9, 'description' => 'Memoar perjuangan di jalan dakwah.'],
            ['category_id' => 3, 'title' => 'Kisah Tanah Jawa', 'author' => 'Pramoedya Ananta Toer', 'publisher' => 'Hasta Mitra', 'year' => 1983, 'stock' => 9, 'description' => 'Catatan keindahan dan budaya Jawa.'],
            ['category_id' => 3, 'title' => 'Sang Pemimpi: Kisah Inspiratif', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang Pustaka', 'year' => 2006, 'stock' => 8, 'description' => 'Novel yang membangkitkan semangat.'],
            ['category_id' => 4, 'title' => 'Ikigai', 'author' => 'Héctor García & Francesc Miralles', 'publisher' => 'Gramedia Pustaka Utama', 'year' => 2017, 'stock' => 12, 'description' => 'Buku mengenai tujuan hidup dan kebahagiaan.'],
            ['category_id' => 4, 'title' => 'Membaca Fiksi', 'author' => 'Umberto Eco', 'publisher' => 'Gramedia', 'year' => 2010, 'stock' => 7, 'description' => 'Panduan memahami karya sastra.'],
            ['category_id' => 5, 'title' => 'Design Thinking', 'author' => 'Tim Brown', 'publisher' => 'Penerbit Erlangga', 'year' => 2009, 'stock' => 10, 'description' => 'Pendekatan desain dalam inovasi dan bisnis.'],
            ['category_id' => 5, 'title' => 'Seni Menggambar', 'author' => 'Tardi', 'publisher' => 'Erlangga', 'year' => 2004, 'stock' => 8, 'description' => 'Panduan dasar seni dan ilustrasi.'],
            ['category_id' => 6, 'title' => 'Berpikir Cepat dan Lambat', 'author' => 'Daniel Kahneman', 'publisher' => 'Gramedia Pustaka Utama', 'year' => 2012, 'stock' => 12, 'description' => 'Buku psikologi kognitif yang mendalam.'],
            ['category_id' => 6, 'title' => 'Rich Dad Poor Dad', 'author' => 'Robert T. Kiyosaki', 'publisher' => 'Gramedia Pustaka Utama', 'year' => 2000, 'stock' => 13, 'description' => 'Buku literasi keuangan populer.'],
            ['category_id' => 6, 'title' => 'Mindset: The New Psychology of Success', 'author' => 'Carol S. Dweck', 'publisher' => 'Gramedia Pustaka Utama', 'year' => 2006, 'stock' => 11, 'description' => 'Buku tentang pola pikir bertumbuh.'],
            ['category_id' => 6, 'title' => 'The Alchemist', 'author' => 'Paulo Coelho', 'publisher' => 'Gramedia Pustaka Utama', 'year' => 1988, 'stock' => 10, 'description' => 'Novel inspiratif terjemahan Indonesia.'],
            ['category_id' => 6, 'title' => 'Titik Nol', 'author' => 'Tere Liye', 'publisher' => 'Gramedia', 'year' => 2016, 'stock' => 9, 'description' => 'Kisah perjalanan fisika dan spiritual.'],
            ['category_id' => 5, 'title' => 'Artistry', 'author' => 'Nina Wisnu', 'publisher' => 'Mizan', 'year' => 2019, 'stock' => 8, 'description' => 'Seni desain dan kreativitas visual.'],
            ['category_id' => 4, 'title' => 'Fenomena Bunga', 'author' => 'Felicia Yap', 'publisher' => 'Gramedia', 'year' => 2020, 'stock' => 9, 'description' => 'Novel remaja dengan latar budaya Asia.'],
            ['category_id' => 2, 'title' => 'Catatan Seorang Demonstran', 'author' => 'Rendra Karno', 'publisher' => 'Kompas Gramedia', 'year' => 2011, 'stock' => 8, 'description' => 'Memoar mahasiswa dan perubahan sosial.'],
            ['category_id' => 3, 'title' => 'Rahasia Hidup Bahagia', 'author' => 'Andrie Wongso', 'publisher' => 'Mizan', 'year' => 2010, 'stock' => 12, 'description' => 'Buku motivasi dan inspirasi sehari-hari.'],
            ['category_id' => 4, 'title' => 'Buku Pintar Coding', 'author' => 'Ridwan A.', 'publisher' => 'Deepublish', 'year' => 2021, 'stock' => 15, 'description' => 'Panduan dasar pemrograman untuk pelajar.'],
            ['category_id' => 5, 'title' => 'Seni Menulis Novel', 'author' => 'Ruhut Sitompul', 'publisher' => 'Erlangga', 'year' => 2015, 'stock' => 10, 'description' => 'Panduan praktis menulis cerita dengan baik.'],
            ['category_id' => 6, 'title' => 'Belajar Bahasa Indonesia', 'author' => 'Irmawati', 'publisher' => 'Erlangga', 'year' => 2012, 'stock' => 14, 'description' => 'Buku pendidikan bahasa Indonesia.'],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
