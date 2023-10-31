<?php

namespace App\Http\Controllers;

use App\Models\LogHarian;
use App\Models\ProgramKegiatan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!Auth::check())
        {
            if($request->has('q') && $request->get('aksi') && $request->get('nim'))
            {
                if($request->get('aksi') == 'filter')
                {
                    $nim = $request->get('nim');
                    $getUserEntity = User::all()->where('nim',$nim)->first();
                    $program = ProgramKegiatan::all()->where('user_id',$getUserEntity->id);
                    $checkLogBookHarian = LogHarian::all()->where('user_id',$getUserEntity->id)->where('category',$request->get('q'));
                    return view('backend.mahasiswa.log.index',[
                        'data' => $checkLogBookHarian,
                        'program' => $program
                    ]);
                }else{
                    $nim = $request->get('nim');
                    $getUserEntity = User::all()->where('nim',$nim)->first();
                    $program = ProgramKegiatan::with('pamongs','user')->where('user_id',$getUserEntity->id)->first();
                    $checkLogBookHarian = LogHarian::all()->where('user_id',$getUserEntity->id)->where('category',$request->get('q'));
                    return view('backend.mahasiswa.log.report',[
                        'data' => $checkLogBookHarian,
                        'program' => $program,
                        'filter' => $request->get('q'),
                        'user' => $program
                    ]);
                }
            }
        }else{
            if($request->has('q') && $request->get('aksi'))
            {
                if($request->get('aksi') == 'filter')
                {
                    $program = ProgramKegiatan::all()->where('user_id',Auth::user()->id);
                    $checkLogBookHarian = LogHarian::all()->where('user_id',Auth::user()->id)->where('category',$request->get('q'));
                    return view('backend.mahasiswa.log.index',[
                        'data' => $checkLogBookHarian,
                        'program' => $program
                    ]);
                }else{
                    $program = ProgramKegiatan::with('pamongs','user')->where('user_id',Auth::user()->id)->first();
                    $checkLogBookHarian = LogHarian::all()->where('user_id',Auth::user()->id)->where('category',$request->get('q'));
                    return view('backend.mahasiswa.log.report',[
                        'data' => $checkLogBookHarian,
                        'program' => $program,
                        'filter' => $request->get('q'),
                        'user' => $program
                    ]);
                }
               
            }else{
                $program = ProgramKegiatan::all()->where('user_id',Auth::user()->id);
                $checkLogBookHarian = LogHarian::all()->where('user_id',Auth::user()->id);
                return view('backend.mahasiswa.log.index',[
                    'data' => $checkLogBookHarian,
                    'program' => $program
                ]);
            }
        }
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'rencana_kegiatan' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'mulai' => 'required',
            'berakhir' => 'required'
        ]);
        $data = LogHarian::create([
            'uuid' => Uuid::uuid4()->toString(),
            'rencana_kegiatan' => $request->rencana_kegiatan,
            'deskripsi' => $request->deskripsi,
            'mulai' => $request->mulai,
            'berakhir' => $request->berakhir,
            'category' => $request->kategori,
            'user_id' => Auth::user()->id
        ]);
        if($data)
        {
            return redirect()->back()->with('success','Berhasil Menambahkan Log Book Harian');
        }else{
            return redirect()->back()->with('error', 'Gagal Menambahkan Log Book Harian');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.mahasiswa.log.detail',[
            'data' => LogHarian::all()->where('uuid',$id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailLogBook($id)
    {
        $data = User::with('logbook')->where("nim",$id)->first();
        $program = ProgramKegiatan::all()->where('user_id',$data->id);
        $checkLogBookHarian = LogHarian::all()->where('user_id',$data->id);
        return view('backend.mahasiswa.log.index',[
            'data' => $data->logbook,
            'program' => $program,
            'check' => $checkLogBookHarian
        ]);
    }
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = LogHarian::find($id);
        $request->validate([
            'status' => 'required'
        ]);
        $data->update($request->all());
        if($data)
        {
            return redirect()->back()->with('success','Berhasil Mengubah Data');
        }else{
            return redirect()->back()->with('error','Gagal Mengubah Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
