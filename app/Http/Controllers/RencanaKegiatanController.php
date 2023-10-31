<?php

namespace App\Http\Controllers;

use App\Models\ProgramKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class RencanaKegiatanController extends Controller
{

    private $path = 'storage/plan/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = ProgramKegiatan::all()->where('user_id',Auth::user()->id);
        $program = ProgramKegiatan::with('pamongs','dpls')->where('user_id',Auth::user()->id)->first();
        return view('backend.mahasiswa.plan.index',compact('check','program'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        $data = ProgramKegiatan::find($request->id);
        $data->update([
            'status' => $request->status
        ]);
        if($data)
        {
            return redirect()->back()->with('success','Berhasil Mengubah Status');
        }else{
            return redirect()->back()->with('error','Gagal Mengubah Status');
        }
    }
    public function add_catatan(Request $request,$id)
    {
        $data = ProgramKegiatan::find($id);
        $data->update([
            'catatan' => $request->catatan
        ]);
        if($data)
        {
            return redirect()->back()->with('success','Berhasil Menambahkan Catatan');
        }else{
            return redirect()->back()->with('error', 'Gagal Menambahkan Catatan');
        }
    }
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
            'nama_kegiatan' => 'required',
            'rencana_kegiatan' => 'required|mimes:pdf',
        ]);
        $files = $request->file('rencana_kegiatan');
        $nameFile = $files->hashName();
        $files->move($this->path,$nameFile);
        $check = ProgramKegiatan::create([
            'user_id' => Auth::user()->id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'rencana_kegiatan' => $this->path.$nameFile,
        ]);
        if($check)
        {
            return redirect()->route('rencana-kegiatan.index')->with('success','Berhasil Menambahkan Data');
        }else{
            return redirect()->back()->with('error','Gagal Menambahkan Data');
        }
    }

    public function ubah_pembagian(Request $request,$id)
    {
        $request->validate([
            'user_id' => 'required',
            'pamong_id' => 'required',
            'dpl_id' => 'required',
            'waktu_mulai' => 'required',
            'waktu_berakhir' => 'required'
        ]);
        $data = ProgramKegiatan::find($id);
        $data->update($request->all());
        if($data)
        {
            return redirect()->back()->with('success','Berhasil Mengubah Data');
        }else{
            return redirect()->back()->with('error','Gagal Mengubah Data');
        }
    }
    public function upload_pembagian(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'pamong_id' => 'required',
            'dpl_id' => 'required',
            'waktu_mulai' => 'required',
            'waktu_berakhir' => 'required'
        ]);
        $data = ProgramKegiatan::create([
            'user_id' => $request->user_id,
            'pamong_id' => $request->pamong_id,
            'dpl_id' => $request->dpl_id,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_berakhir' => $request->waktu_berakhir
        ]);
        if($data)
        {
            return redirect()->back()->with('success','Berhasil Menambahkan Data');
        }else{
            return redirect()->back()->with('error','Gagal Menambahkan Data');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data = ProgramKegiatan::find($id);
        if($request->hasFile('file'))
        {
            $request->validate([
                'nama_kegiatan' => 'required',
                'file' => 'required|mimes:pdf',
            ]);
            File::delete($this->path.$data->rencana_kegiatan);
            $files = $request->file('file');
            $nameFile = $files->hashName();
            $files->move($this->path,$nameFile);
            $data->update([
                'user_id' => Auth::user()->id,
                'nama_kegiatan' => $request->nama_kegiatan,
                'rencana_kegiatan' => $this->path.$nameFile,
            ]);
            if($data)
            {
                return redirect()->route('rencana-kegiatan.index')->with('success','Berhasil Menambahkan Data');
            }else{
                return redirect()->back()->with('error','Gagal Menambahkan Data');
            }
        }else{
            $request->validate([
                'nama_kegiatan' => 'required',
               
            ]);
            $data->update([
                'user_id' => Auth::user()->id,
                'nama_kegiatan' => $request->nama_kegiatan,
            ]);
            if($data)
            {
                return redirect()->route('rencana-kegiatan.index')->with('success','Berhasil Menambahkan Data');
            }else{
                return redirect()->back()->with('error','Gagal Menambahkan Data');
            }
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
