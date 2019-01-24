<?php

namespace App\Http\Controllers;

use App\Domain\Entities\Transaction;
use App\Domain\Repositories\BookRepository;
use App\Domain\Repositories\TransactionRepository;
use App\Export\BookExcel;
use App\Export\TransExcel;
use Illuminate\Support\Facades\Auth;
use PDF;
use Excel;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    protected $book, $trans;
    
    public function __construct(BookRepository $book, TransactionRepository $trans)
    {
        $this->middleware('auth');
        $this->book  = $book;
        $this->trans = $trans;
    }
    
    public function book()
    {
        return view('laporan.book');
    }
    
    public function bookPdf()
    {
        $i     = 0;
        $books = $this->book->getAll();
        $pdf   = PDF::loadView('laporan.book_pdf', compact('books', 'i'))->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->download('laporan_buku_' . date('Y-m-d_H-i-s') . '.pdf');
    }
    
    
    public function bookExcel()
    {
        $name = 'laporan_buku_' . date('Y-m-d_H-i-s');
        return Excel::download(new BookExcel(), $name . '.xlsx');
    }
    
    
    public function transaction()
    {
        return view('laporan.transaction');
    }
    
    
    public function transPdf(Request $request)
    {
        $q = Transaction::query();
        
        if ($request->get('status')) {
            if ($request->get('status') == 'pinjam') {
                $q->where('status', 'pinjam');
            } else {
                $q->where('status', 'kembali');
            }
        }
        
        if (Auth::user()->level == 'user') {
            $q->where('member_id', Auth::user()->member->id);
        }
        
        $datas = $q->get();
        
        $pdf = PDF::loadView('laporan.transaction_pdf', compact('datas'))->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->download('laporan_transaksi_' . date('Y-m-d_H-i-s') . '.pdf');
    }
    
    
    public function transExcel()
    {
        $name = 'laporan_buku_' . date('Y-m-d_H-i-s');
        return Excel::download(new TransExcel(), $name . '.xlsx');
    }
}
