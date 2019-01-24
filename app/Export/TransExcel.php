<?php
/**
 * Created by PhpStorm.
 * User: FERDY
 * Date: 1/2/2019
 * Time: 3:05 AM
 */

namespace App\Export;


use App\Domain\Entities\Transaction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class TransExcel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
     * @return Collection
     */
    public function collection()
    {
        $q = Transaction::query();
        $q->join('books', 'books.id', '=', 'transactions.book_id')
            ->join('members', 'members.id', '=', 'transactions.member_id')
            ->join('users', 'users.id', '=', 'members.user_id')
            ->select('transactions.kd_transaksi', 'books.judul', 'users.name', 'tgl_pinjam', 'tgl_kembali', 'transactions.status', 'transactions.ket');
        
        if (Auth::user()->level == 'user') {
            $q->where('transactions.member_id', Auth::user()->member->id);
        }
        
        return $q->get();
    }
    
    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12)->setBold(true);
            },
        ];
    }
    
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Kode',
            'Buku',
            'Peminjam',
            'Tgl Pinjam',
            'Tgl Kembali',
            'Status',
            'Ket'
        ];
    }
}