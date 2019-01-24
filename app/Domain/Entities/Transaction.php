<?php
/**
 * Created by PhpStorm.
 * User: FERDY
 * Date: 12/16/2018
 * Time: 3:32 AM
 */

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['kd_transaksi', 'member_id', 'book_id', 'tgl_pinjam', 'tgl_kembali', 'status', 'ket'];
    
    
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}