<?php

namespace App\Http\Controllers;

use App\Models\Dpl;
use App\Models\Pamong;
use App\Models\ProgramKegiatan;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        return view('frontend.beranda.index',[
            'total_mahasiswa' => ProgramKegiatan::with('user')->where('status',1)->count(),
            'dpl' => Dpl::all()->count(),
            'pamongs' => Pamong::all()->count(),
        ]);
    }
}
