<?php

namespace App\Http\Controllers;

use App\Domain\Entities\Book;
use App\Domain\Entities\Member;
use App\Domain\Entities\Transaction;
use App\Domain\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SWAL;

class TransactionController extends Controller
{
    protected $trans;
    
    /**
     * TransactionController constructor.
     * @param $trans
     */
    public function __construct(TransactionRepository $trans)
    {
        $this->middleware('auth');
        $this->middleware('authAdmin', ['except' => ['index', 'show']]);
        $this->trans = $trans;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->level == 'user') {
            $datas = $this->trans->getByField('member_id', Auth::user()->member->id)->get();
        } else {
            $datas = $this->trans->getAll();
        }
        return view('transactions.index', compact('datas'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getRow   = Transaction::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();
        
        $kode = "TR00001";
        
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "TR0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "TR000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "TR00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "TR0" . '' . ($lastId->id + 1);
            } else {
                $kode = "TR" . '' . ($lastId->id + 1);
            }
        }
        
        $books   = Book::where('jumlah_buku', '>', 0)->get();
        $members = Member::get();
        return view('transactions.create', compact('books', 'kode', 'members'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_transaksi' => 'required|string|max:255',
            'tgl_pinjam'     => 'required',
            'tgl_kembali'    => 'required',
            'buku_id'        => 'required',
            'anggota_id'     => 'required',
        
        ]);
        
        $transaksi = Transaction::create([
            'kd_transaksi' => $request->get('kode_transaksi'),
            'tgl_pinjam'   => $request->get('tgl_pinjam'),
            'tgl_kembali'  => $request->get('tgl_kembali'),
            'book_id'      => $request->get('buku_id'),
            'member_id'    => $request->get('anggota_id'),
            'ket'          => $request->get('ket'),
            'status'       => 'pinjam'
        ]);
        
        //        $transaksi = $this->trans->create($request->all());
        
        $transaksi->book->where('id', $transaksi->book_id)
            ->update([
                'jumlah_buku' => ($transaksi->book->jumlah_buku - 1),
            ]);
        
        SWAL::message('Berhasil.', 'Data telah ditambahkan!', 'success');
        return redirect()->to('transaction');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->trans->getById($id);
        
        if ((Auth::user()->level == 'user') && (Auth::user()->member->id != $data->member_id)) {
            SWAL::message('Oopss..', 'Anda dilarang masuk ke area ini.', 'error');
            return redirect()->to('/');
        }
        return view('transactions.show', compact('data'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaksi = $this->trans->getById($id);
        
        $transaksi->update([
            'status' => 'kembali'
        ]);
        
        $transaksi->book->where('id', $transaksi->book->id)
            ->update([
                'jumlah_buku' => ($transaksi->book->jumlah_buku + 1),
            ]);
        
        SWAL::message('Berhasil.', 'Data telah diubah!', 'success');
        return redirect()->route('transaction.index');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->trans->delete($id);
        SWAL::message('Berhasil.', 'Data telah dihapus!', 'success');
        return redirect()->route('transaction.index');
    }
}
