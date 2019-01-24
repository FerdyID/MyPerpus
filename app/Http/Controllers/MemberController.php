<?php

namespace App\Http\Controllers;

use App\Domain\Entities\Member;
use App\Domain\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use SWAL;
use App\Domain\Entities\User;
use App\Domain\Repositories\MemberRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    protected $member, $user;
    
    /**
     * MemberController constructor.
     * @param MemberRepository $member
     * @param UserRepository $user
     */
    public function __construct(MemberRepository $member, UserRepository $user)
    {
        $this->middleware('auth');
        $this->middleware('authAdmin');
        $this->member = $member;
        $this->user   = $user;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = $this->member->getAll();
        return view('members.index', compact('members'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::WhereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('members')
                ->whereRaw('members.user_id = users.id');
        })->get();
        
        return view('members.create', compact('users'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = $this->member->getByField('npm', $request->input('npm'))->count();
        
        if ($count > 0) {
            Session::flash('message', 'Already exist!');
            Session::flash('message_type', 'danger');
        }
        
        
        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'npm'  => 'required|string|max:20|unique:members'
        ]);
        
        
        $this->member->create($request->all());
        
        //Sending Email
        $user = $this->user->getByField('id', $request->input('user_id'))->first();
        $pass = str_random(16);
        $user->update(['password' => bcrypt($pass)]);
        Log::info($pass);
        \Mail::send('emails/notifikasipass', [
            'email'    => $user->email,
            'password' => $pass], function ($message) use ($user, $pass) {
            $message->to($user->email);
            $message->subject('Info dari MyPerpus');
        });
        
        SWAL::message('Berhasil.', 'Data telah ditambahkan!', 'success');
        
        return redirect()->route('member.index');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ((Auth::user()->level == 'user') && (Auth::user()->id != $id)) {
            Swal::message('Opss..', 'Access Denied!', 'error');
            return redirect()->to('/');
        }
        $data = $this->member->getById($id);
        return view('members.show', compact('data'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ((Auth::user()->level == 'user') && (Auth::user()->id != $id)) {
            Swal::message('Opss..', 'Access Denied!', 'error');
            return redirect()->to('/');
        }
        $data  = $this->member->getById($id);
        $users = User::get();
        return view('members.edit', compact('data', 'users'));
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
        $this->member->update($id, $request->all());
        SWAL::message('Berhasil.', 'Data telah diubah!', 'success');
        return redirect()->to('member');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->member->delete($id);
        SWAL::message('Berhasil.', 'Berhasil Dihapus!', 'success');
        return redirect()->to('member');
    }
}
