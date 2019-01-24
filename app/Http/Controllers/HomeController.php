<?php

namespace App\Http\Controllers;

use App\Domain\Entities\Book;
use App\Domain\Entities\Member;
use App\Domain\Entities\Transaction;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Domain\Entities\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function index()
    {
        $users   = User::where('level', 'user')->get();
        $members = Member::get();
        $books   = Book::get();
        
        if (Auth::user()->level == 'user') {
            $datas = Transaction::where('status', 'pinjam')
                ->where('member_id', Auth::user()->member->id)
                ->get();
            $trans = Transaction::where('member_id', Auth::user()->member->id)
                ->get();
        } else {
            $datas = Transaction::where('status', 'pinjam')->get();
            $trans = Transaction::get();
        }
        
        return view('home', compact('users', 'trans', 'books', 'members', 'datas'));
    }
}
