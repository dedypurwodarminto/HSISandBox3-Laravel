<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index()
    {
        return view('index');//login
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email belum dimasukkan',
            'password.required' => 'Password belum dimasukkan'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('admin');
            } else if (Auth::user()->role == 'kasir') {
                return redirect()->intended('kasir');
            }
        } else {
            return redirect('')->withErrors('Akun tidak ditemukan')->withInput();
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
