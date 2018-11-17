<?php

namespace App\Http\Controllers;

use App\Domain\Repositories\BookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class BookController extends Controller
{
    protected $book;
    
    /**
     * BookController constructor.
     * @param $book
     */
    public function __construct(BookRepository $book)
    {
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
        $books = $this->book->paginate($limit=3, 'judul', $request->input('search'));
    
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
        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
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
        return view('books.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('books.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
