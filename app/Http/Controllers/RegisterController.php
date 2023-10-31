<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('backend.auth.registrasi');
    
    }
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:users',
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'tahun_masuk' => 'required',
            'password' => 'required',
            'konfirmasi' => 'required|same:password',
            'term_condition' => 'required'
        
        ]);
        $data  = User::create([
            'nim' => $request->nim,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'tahun_masuk' => $request->tahun_masuk,
            'password' => bcrypt($request->password),
        ]);
        if($data)
        {
            return redirect()->route('auth')->with('success','Registrasi Berhasil, Akun Masih Dalam Peninjauan');
        }else{
            return redirect()->route('register')->with('error','Terjadi Kesalahan');
        }

    }
}
