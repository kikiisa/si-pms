<?php

namespace App\Http\Controllers;

use App\Models\Dpl;
use App\Models\Pamong;
use App\Models\Pengaturan;
use App\Models\ProgramKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            $data = Pengaturan::all()->first();
            return view('backend.dashboard.index',compact('data'));
        }elseif(Auth::guard('pamongs')->check())
        {
            
            $program = ProgramKegiatan::with('pamongs')->where('pamong_id',Auth::guard('pamongs')->user()->id)->count();
            return view('backend.dashboard.pamong',compact('program'));
        }elseif(Auth::guard('dpls')->check())
        {
            if(Auth::guard('dpls')->user()->roles == 'mk')
            {
                $program = ProgramKegiatan::with('user')->count();

            }else{
                $program = ProgramKegiatan::with('user')->where('dpl_id',Auth::guard('dpls')->user()->id)->count();
            }
            return view('backend.dashboard.dpl',[
                'program' => $program
            ]);
        }else{
            return view('backend.dashboard.operator',[
                'mahasiswa' => ProgramKegiatan::with('user')->count(),
                'dpl' => Dpl::all()->count(),
                'pamong' => Pamong::all()->count(),
                'mk' => Dpl::all()->where('roles','mk')->count() 
            ]);
        }
    }
}
