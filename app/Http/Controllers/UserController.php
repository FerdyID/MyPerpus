<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use PDF;
use Excel;
use App\Export\DataExport;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Softon\SweetAlert\Facades\SWAL;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $search)
    {
        if (Auth::user()->level == 'user') {
            Swal::message('Opss..', 'Access Denied!', 'error');
            return redirect('/');
        }
 
        $perPage = 3;
        $users = User::where('name', 'like', '%' . $search->input('search'). '%')->paginate($perPage);
        
//        $users   = User::paginate($perPage);
        $i       = ($users->currentPage() - 1) * $perPage;
        return view('auth.users', compact('users', 'i'));
    }

    public function create()
    {
        if (Auth::user()->level == 'user') {
            Swal::message('Opss..', 'Access Denied!', 'error');
            return redirect()->to('/');
        }
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $count = User::where('email', $request->input('email'))->count();

        if ($count > 0) {
            Session::flash('message', 'Email sudah digunakan!');
            Session::flash('message_type', 'danger');
            //            return redirect()->to('user');
        }

        $this->validate($request, [
            'name'     => 'required|string|max:100',
            'email'    => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);


        if ($request->file('gambar') == '') {
            $gambar = NULL;
        } else {
            $file     = $request->file('gambar');
            $dt       = Carbon::now();
            $acak     = $file->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak;
            $request->file('gambar')->move("images/user", $fileName);
            $gambar = $fileName;
        }

        User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'level'    => $request->input('level'),
            'password' => bcrypt(($request->input('password'))),
            'gambar'   => $gambar
        ]);

        Session::flash('message', 'Berhasil ditambahkan!');
        Session::flash('message_type', 'success');
        return redirect()->to('user');
    }

    public function show($id)
    {
        if ((Auth::user()->level == 'user') && (Auth::user()->id != $id)) {
            Swal::message('Opss..', 'Access Denied!', 'error');
            return redirect()->to('/');
        }

        $user = User::findOrFail($id);

        return view('auth.show', compact('user'));
    }

    public function edit($id)
    {
        if ((Auth::user()->level == 'user') && (Auth::user()->id != $id)) {
            Swal::message('Opss..', 'Access Denied!', 'error');
            return redirect()->to('/');
        }

        $user = User::findOrFail($id);

        return view('auth.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user_data = User::findOrFail($id);

        if ($request->file('gambar')) {
            $file     = $request->file('gambar');
            $dt       = Carbon::now();
            $acak     = $file->getClientOriginalExtension();
            $fileName = rand(1111, 9999) . '-' . $dt->format('Y-m-d-H-i-s') . '.' . $acak;
            $request->file('gambar')->move("images/user", $fileName);
            $user_data->gambar = $fileName;
        }

        $user_data->name  = $request->input('name');
        $user_data->email = $request->input('email');
        if ($request->input('password')) {
            if ($user_data->level == 'admin') {
                $user_data->level = $request->input('level');
            } else {
                $user_data->level = 'user';
            }
        }

        if ($request->input('password')) {
            $user_data->password = bcrypt(($request->input('password')));

        }

        $user_data->update();

        Session::flash('message', 'Berhasil diubah!');
        Session::flash('message_type', 'success');


        if (Auth::user()->level == 'admin') {
            return redirect()->to('user');
        } else {
            return redirect()->to('/');
        }

    }

    public function destroy($id)
    {
        if (Auth::user()->id != $id) {
            $user_data = User::findOrFail($id);
            $user_data->delete();
            Session::flash('message', 'Berhasil dihapus!');
            Session::flash('message_type', 'success');
        } else {
            Session::flash('message', 'Akun anda sendiri tidak bisa dihapus!');
            Session::flash('message_type', 'danger');
        }
        return redirect()->to('user');
    }

    public function exportPDF()
    {
        $users = User::all();
        $pdf   = PDF::loadView('auth.pdf', compact('users'))->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->download('Laporan_User_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function exportExcel()
    {
        $nama = 'laporan_user_' . date('Y-m-d_H-i-s');
        return Excel::download(new DataExport, $nama . '.xlsx');
    }

    public function createImport(Request $file)
    {
        try {

            \Excel::filter('chunk')->load($file)->chunk(20000, function ($results) {
                $is_valid_import_file = count($results) > 0;
                if ($is_valid_import_file) {
                    $result = [];

                    foreach ($results as $roww) {
                        foreach ($roww as $row) {

                            //                            $confirmation_code = str_random(30);
                            $password = str_random(30);
                            if ($row->nik != null) {
                                $data = [
                                    'name'       => $row->nama,
                                    'email'      => $row->email,
                                    'password'   => bcrypt($password),
                                    'gambar'     => ($row['gambar'] == null) ? '0' : ('gambar'),
                                    'level'      => ($row['level'] == null) ? '0' : ('user'),
                                    'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                                    'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                                ];
                                dd($data);
                                array_push($result, $data);
                            }
                        }
                    }
                    //dump($result);
                    foreach (array_chunk($result, 100) as $t) {
                        \DB::table('users')->insert($t);
                    }
                }
            });

            return response()->json(
                [
                    'success' => true,
                    'result'  => [
                        'message' => 'Berhasil menyimpan data.',
                    ],
                ]
            );
        } catch (\Exception $e) {
            // store errors to log
            \Log::error('class : ' . User::class . ' method : create | ' . $e);

            return $e;

        }
    }


}
