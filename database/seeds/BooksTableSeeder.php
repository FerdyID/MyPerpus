<?php

use Illuminate\Database\Seeder;
use App\Domain\Entities\Book;
use Carbon\Carbon;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::insert([
            [
                'id'           => 1,
                'judul'        => 'Belajar Pemrograman Java',
                'pengarang'    => 'Abdul Kadir',
                'penerbit'     => 'PT. Restu Ibu',
                'tahun_terbit' => 2018,
                'jumlah_buku'  => 20,
                'deskripsi'    => 'Buku Pertama Belajar Pemrograman Java Utk Pemula',
                'cover'        => 'buku_java.jpg',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now()
            ],
            [
                'id'           => 2,
                'judul'        => 'Pemrograman Android',
                'pengarang'    => 'Muhammad Nurhidayat',
                'penerbit'     => 'PT. Restu Guru',
                'tahun_terbit' => 2018,
                'jumlah_buku'  => 14,
                'deskripsi'    => 'Jurus Rahasia Menguasai Pemrograman Android',
                'cover'        => 'jurus_rahasia.jpg',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now()
            ],
            [
                'id'           => 3,
                'judul'        => 'Android Application',
                'pengarang'    => 'Dina Aulia',
                'penerbit'     => 'PT. Restu Ayah',
                'tahun_terbit' => 2018,
                'jumlah_buku'  => 5,
                'deskripsi'    => 'Buku Pertama Belajar Pemrograman Java Utk Pemula',
                'cover'        => 'create_your.jpg',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now()
            ],
        ]);
    }
}
