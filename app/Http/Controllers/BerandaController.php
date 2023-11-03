<?php

namespace App\Http\Controllers;

use App\Models\Dpl;
use App\Models\Informasi;
use App\Models\Pamong;
use App\Models\Pengaturan;
use App\Models\ProgramKegiatan;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index(Request $request)
    {
        if($request->get('post'))
        {
            $post = Informasi::where('title','like','%'.$request->get('post').'%')->paginate(5);
        }else{
            $post = Informasi::paginate(5);
        }
        return view('frontend.beranda.index',[
            'total_mahasiswa' => ProgramKegiatan::with('user')->where('status',1)->count(),
            'dpl' => Dpl::all()->count(),
            'pamongs' => Pamong::all()->count(),
            'app' => Pengaturan::all()->first(),
            'post' => $post,
        ]);
    }
}
