<?php

namespace App\Http\Controllers;

use App\Models\Dpl;
use App\Models\Informasi;
use App\Models\Pamong;
use App\Models\Pengaturan;
use App\Models\Post;
use App\Models\ProgramKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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
            'total_mahasiswa' => ProgramKegiatan::with('user')->count(),
            'dpl' => Dpl::all()->count(),
            'pamongs' => Pamong::all()->count(),
            'app' => Pengaturan::all()->first(),
            'post' => $post,
            'berita' => Post::paginate(5),
            'pengaturan' => Pengaturan::all()->first()
        ]);
    }
}
