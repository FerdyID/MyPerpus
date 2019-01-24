<?php
/**
 * Created by PhpStorm.
 * User: FERDY
 * Date: 1/2/2019
 * Time: 3:05 AM
 */

namespace App\Export;

use App\Domain\Entities\Book;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class BookExcel implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    
    /**
     * @return Collection
     */
    public function collection()
    {
        return Book::get(['judul', 'pengarang', 'penerbit', 'tahun_terbit', 'jumlah_buku']);
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
            'Judul',
            'Pengarang',
            'Penerbit',
            'Tahun Terbit',
            'Jumlah Buku'
        ];
    }
}