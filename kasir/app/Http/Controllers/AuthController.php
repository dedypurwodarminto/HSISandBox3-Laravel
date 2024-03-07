<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // public function index()
    // {
    //     // kita ambil data user lalu simpan pada variable $user
    //     $user = Auth::user();
    //     // kondisi jika user nya ada 
    //     if ($user) {
    //         // jika user nya memiliki level admin
    //         if ($user->role == 'admin') {
    //             // arahkan ke halaman admin ya :P
    //             return redirect()->intended('index');
    //         }
    //         // jika user nya memiliki level user
    //         else if ($user->role == 'kasir') {
    //             // arahkan ke halaman user
    //             return redirect()->intended('kasir');
    //         }
    //     }
    //     return view('index');
    // }
    public function index()
    {
        $pages = array(
            'title' => 'Home Page'
        );

        if (Auth::user()) {
            return view('home', $pages);
        }

        return view('index', $pages);
    }

    public function login(Request $request)
    {
        // kita buat validasi pada saat tombol login di klik
        // validas nya username & password wajib di isi 
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // ambil data request username & password saja 
        $credential = $request->only('email', 'password');

        // cek jika data username dan password valid (sesuai) dengan data
        if (Auth::attempt($credential)) {
            // kalau berhasil simpan data user nya di variabel $user
            $user =  Auth::user();
            // cek lagi jika level user admin maka arahkan ke halaman admin
            if ($user->role == 'admin') {
                return redirect('')->with('sukses', 'Anda berhasil login!');
            }
            // tapi jika level user nya user biasa maka arahkan ke halaman user
            else if ($user->role == 'kasir') {
                return redirect()->intended('home')->with('sukses', 'Anda berhasil login!');
            }
            // jika belum ada role maka ke halaman /
            return redirect()->back()->withErrors('Email atau password salah!');
        }

        // User invalid kembalikan lagi ke halaman login
        return redirect('/')->with('error', 'These credentials does not match our records');
    }

    public function register()
    {
        // tampilkan view register
        return view('register');
    }


    // aksi form register
    public function proses_register(Request $request)
    {
        //. kita buat validasi nih buat proses register
        // validasinya yaitu semua field wajib di isi
        // validasi username itu harus unique atau tidak boleh duplicate username ya
        $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required'
        ]);

        // kalau gagal kembali ke halaman register dengan munculkan pesan error
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }
        // kalau berhasil isi level & hash passwordnya ya biar secure
        $request['role'] = 'kasir';
        $request['password'] = bcrypt($request->password);

        // masukkan semua data pada request ke table user
        User::create($request->all());

        // kalo berhasil arahkan ke halaman login
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        // logout itu harus menghapus session nya 
        $request->session()->flush();

        // jalankan juga fungsi logout pada auth 
        Auth::logout();
        return redirect('')->with('sukses','Anda telah berhasil logout.');
    }
}
