<?php

namespace App\Http\Controllers;

use App\Domain\Repositories\BookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use SWAL;

class BookController extends Controller
{
    protected $book;
    
    /**
     * BookController constructor.
     * @param $book
     */
    public function __construct(BookRepository $book)
    {
        $this->middleware('auth');
        $this->middleware('authAdmin', ['except' => ['index', 'show']]);
        $this->book = $book;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = $this->book->paginate($limit = 10, 'judul', $request->input('search'));
        
        $i     = ($books->currentPage() - 1) * $limit;
        return view('books.index', compact('books', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string|max:255',
        ]);
    
        if($request->file('cover')) {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $type  = $file->getClientOriginalExtension();
            $judul = preg_replace('/\s+/','-',$request->input('judul'));
            $fileName = $judul.'-'.$dt->format('Y-m-d').'.'.$type;
            $request->file('cover')->move("images/book", $fileName);
            $cover = $fileName;
        } else {
            $cover = NULL;
        }
        
        $this->book->created($cover, $request->all());
        SWAL::message('Berhasil.', 'Data telah ditambahkan!', 'success');
        return redirect()->to('book');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = $this->book->getById($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = $this->book->getById($id);
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = $this->book->getById($id);
        if ($request->file('cover')) {
            \File::delete(public_path('images/book/' . $book->cover));
            $file     = $request->file('cover');
            $dt       = Carbon::now();
            $judul    = preg_replace('/\s+/', '-', $request->input('judul'));
            $type     = $file->getClientOriginalExtension();
            $fileName = $judul . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $type;
            $request->file('cover')->move("images/book", $fileName);
            $cover = $fileName;
        } else {
            $cover = $book->cover;
        }
    
        $this->book->updated($id, $cover, $request->all());
        SWAL::message('Berhasil.', 'Data telah diubah!', 'success');
        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = $this->book->getById($id);
        $this->book->delete($id);
        \File::delete(public_path('images/book/' . $book->cover));
        SWAL::message('Berhasil.', 'Berhasil dihapus!', 'success');
        return redirect()->to('book');
    }
}
