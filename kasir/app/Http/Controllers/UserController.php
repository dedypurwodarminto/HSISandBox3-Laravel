<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data User',
            'data_user' => User::all()
        );

        return view('admin.master.user.list', $data);
    }
    
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        
        return redirect('/user')->with('success', 'Akun baru telah ditambahkan');
    }
    
    public function update(Request $request, $id)
    {
        User::where('id', $id)
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        
        return redirect('/user')->with('success', 'Data user telah diubah');
    }
    
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect('/user')->with('success', 'Akun telah dihapus');
    }    
    
    public function profile()
    {
        $user = Auth::user()->id;

        $data = array(
            'title' => 'User Profile',
            'data_profile' => User::where('id', $user)->get()
        );

        return view('profile', $data);
    }
    
    public function updateProfile(Request $request, $id)
    {
        User::where('id', $id)
        ->where('id', $id)
            ->update([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

        return redirect('/profile')->with('success', 'Data profile telah diubah');
    }
}
