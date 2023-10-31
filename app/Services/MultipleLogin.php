<?php 

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException as Valid;

class MultipleLogin 
{
    public function login_user()
    {
        $credentialUser = Request::only('username','password');
        if(Auth::attempt($credentialUser))
        {
            $user = Auth::user();
            if($user->status == 0)
            {
                Auth::logout();
                throw Valid::withMessages(['message' => 'Maaf Akun Anda Dalam Proses Verifikasi']);
            }else{
                Request::session()->regenerate();
                return redirect()->route('dashboard');
            }
        }
        throw Valid::withMessages(['message' => 'Maaf Email Dan Password Anda Tidak Terdaftar']);
    
    }

    public function login_pamong()
    {
        $credential = Request::only('username','password');
        if(Auth::guard('pamongs')->attempt($credential))
        {
            Request::session()->regenerate();
            return redirect()->route('dashboard');
        }    
        throw Valid::withMessages(['message' => 'Maaf Email Dan Password Anda Tidak Terdaftar']);
    }

    public function login_dpl()
    {
        $credential = Request::only('username','password');
        if(Auth::guard('dpls')->attempt($credential))
        {
            Request::session()->regenerate();
            return redirect()->route('dashboard');
        }
        throw Valid::withMessages(['message' => 'Maaf Email Dan Password Anda Tidak Terdaftar']);
        
    }
    public function login_operator()
    {
        $credential = Request::only('username','password');
        if(Auth::guard('operators')->attempt($credential))
        {
            Request::session()->regenerate();
            return redirect()->route('dashboard');
        }
        throw Valid::withMessages(['message' => 'Maaf Email Dan Password Anda Tidak Terdaftar']);
    }
}
