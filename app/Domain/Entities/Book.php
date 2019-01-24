<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['judul', 'pengarang', 'penerbit',  'tahun_terbit', 'jumlah_buku', 'deskripsi', 'cover'];
    
    
    /**
     * Method One To Many
     */
    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
