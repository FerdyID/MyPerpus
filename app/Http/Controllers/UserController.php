<?php

namespace App\Http\Controllers;

use App\Domain\Entities\User;
use Illuminate\Http\Request;
use App\Domain\Repositories\UserRepository;
use Auth;
use PDF;
use Excel;
use App\Export\DataExport;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use SWAL;

class UserController extends Controller
{
    protected $user;
    
    public function __construct(UserRepository $user)
    {
        $this->middleware('auth');
        $this->middleware('authAdmin', ['except' => ['edit', 'update', 'show']]);
        $this->user = $user;
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
//        User::withTrashed()->restore();
        $users = $this->user->paginate($limit = 10, 'name', $request->input('search'));
        
        $i     = ($users->currentPage() - 1) * $limit;
        return view('auth.users', compact('users', 'i'));
    }
    
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        return view('auth.create');
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $count = $this->user->getByField('email', $request->input('email'))->count();
        if ($count > 0) {
            Session::flash('message', 'Email sudah digunakan!');
            Session::flash('message_type', 'danger');
        }
        
        $this->validate($request, [
            'name'     => 'required|string|max:100',
            'email'    => 'required|string|email|max:100|unique:users',
            //            'password' => 'required|string|min:6|confirmed',
        ]);
        
        if ($request->file('gambar') == '') {
            $image = NULL;
        } else {
            $file     = $request->file('gambar');
            $dt       = Carbon::now();
            $type     = $file->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $type;
            $request->file('gambar')->move("images/user", $fileName);
            $image = $fileName;
        }
        
        $this->user->created($image, $request->all());
        SWAL::message('Berhasil.', 'Data telah ditambahkan!', 'success');
        return redirect()->to('user');
    }
    
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = $this->user->getById($id);
        
        if (Auth::user()->level == 'admin'){
            return view('auth.show', compact('user'));
        }
        if (Auth::user()->id != $id) {
            Swal::message('Opss..', 'Access Denied!', 'error');
            return redirect()->to('/');
        }
        return view('auth.show', compact('user'));
    }
    
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->user->getById($id);
        
        if (Auth::user()->level == 'admin'){
            return view('auth.edit', compact('user'));
        }
        if (Auth::user()->id != $id) {
            Swal::message('Opss..', 'Access Denied!', 'error');
            return redirect()->to('/');
        }
        return view('auth.edit', compact('user'));
    }
    
    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $user = $this->user->getById($id);
        
        if ($request->file('gambar')) {
            \File::delete(public_path('images/user/'.$user->gambar));
            $file     = $request->file('gambar');
            $dt       = Carbon::now();
            $type     = $file->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $type;
            $request->file('gambar')->move("images/user", $fileName);
            $image = $fileName;
        }else{
            $image = $user->gambar;
        }
        
        $this->user->updated($id, $image, $request->all());
    
        SWAL::message('Berhasil.', 'Berhasil diubah!', 'success');
        
        if (Auth::user()->level == 'admin') {
            return redirect()->to('user');
        } else {
            return redirect()->to('/');
        }
    }
    
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (Auth::user()->id != $id) {
            $this->user->delete($id);
            SWAL::message('Berhasil.', 'Berhasil dihapus!', 'success');
        } else {
            SWAL::message('Oopss.', 'Akun anda sendiri tidak bisa dihapus!', 'error');
        }
        return redirect()->to('user');
    }
    
    /**
     * @return mixed
     */
    public function exportPDF()
    {
        $users = $this->user->getAll();
        $pdf   = PDF::loadView('auth.pdf', compact('users'))->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->download('Laporan_User_' . date('Y-m-d_H-i-s') . '.pdf');
    }
    
    /**
     * @return mixed
     */
    public function exportExcel()
    {
        $name = 'laporan_user_' . date('Y-m-d_H-i-s');
        return Excel::download(new DataExport, $name . '.xlsx');
    }
}
