<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            return view('backend.dashboard.index');
        }elseif(Auth::guard('pamongs')->check())
        {
            return view('backend.dashboard.pamong');
        }elseif(Auth::guard('dpls')->check())
        {
            return view('backend.dashboard.dpl');
        }else{
            return view('backend.dashboard.operator');
        }
    }
}
