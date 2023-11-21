<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('backend.auth.forgot_password');
    }
    
    public function store(Request $request)
    {
        $data = $request->email;
        $check = User::all()->where('email', $data)->first();
        if($check)
        {
            $request->validate([
                'email' => 'required|email',
            ]);
            $status = Password::sendResetLink(
                $request->only('email')
            );
            return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
        }else{
            return back()->with(['error' => 'Email Tidak Terdaftar']);
        }
    }

    public function resetPassword(Request $request,$token)
    {
        return view('backend.auth.reset_password', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('auth')->with('success', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
