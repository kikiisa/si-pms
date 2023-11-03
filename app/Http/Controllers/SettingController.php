<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    private $path = 'storage/setting/';
    private $service;
    public function __construct()
    {
        $this->service = new UploadService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = Pengaturan::all()->first();
        return view('backend.setting.index',[
            'data' => $data
        ]);
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
        //
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
        $data = Pengaturan::all()->first();
        $request->validate([
            'title' => 'required',
            'judul' => 'required',
            'sub_judul' => 'required',
            'deskripsi_full' => 'required',
        ]);
        if($request->hasFile('sk_rektor') && $request->hasFile('surat_pernyataan'))
        {
            $request->validate([
                'sk_rektor' => 'required|mimes:pdf',
                'surat_pernyataan' => 'required|mimes:docx',
            ]);
            File::delete($data->sk_rektor);
            File::delete($data->surat_pernyataan);
            $data->update([
                'title' => $request->title,
                'judul' => $request->judul,
                'sub_judul' => $request->sub_judul,
                'deskripsi_full' => $request->deskripsi_full,
                'sk_rektor' => $this->service->upload('sk_rektor',$this->path),
                'surat_pernyataan' => $this->service->upload('surat_pernyataan',$this->path),
            ]);
            if($data)
            {
                return redirect()->back()->with('success','Berhasil Mengubah Data');
            }else{
                return redirect()->back()->with('error','Gagal Mengubah Data');
            }
        }elseif($request->hasFile('sk_rektor'))
        {
            $request->validate([
                'sk_rektor' => 'required|mimes:pdf',
            ]);
            File::delete($data->sk_rektor);
            $data->update([
                'title' => $request->title,
                'judul' => $request->judul,
                'sub_judul' => $request->sub_judul,
                'deskripsi_full' => $request->deskripsi_full,
                'sk_rektor' => $this->service->upload('sk_rektor',$this->path),
            ]);
            if($data)
            {
                return redirect()->back()->with('success','Berhasil Mengubah Data');
            }else{
                return redirect()->back()->with('error','Gagal Mengubah Data');
            }
        }elseif($request->hasFile('surat_pernyataan'))
        {
            $request->validate([
                'surat_pernyataan' => 'required|mimes:docx',
            ]);
            File::delete($data->surat_pernyataan);
            $data->update([
                'title' => $request->title,
                'judul' => $request->judul,
                'sub_judul' => $request->sub_judul,
                'deskripsi_full' => $request->deskripsi_full,
                'surat_pernyataan' => $this->service->upload('surat_pernyataan',$this->path),
            ]);
            if($data)
            {
                return redirect()->back()->with('success','Berhasil Mengubah Data');
            }else{
                return redirect()->back()->with('error','Gagal Mengubah Data');
            }   
        }else{
            $data->update($request->all());
            if($data)
            {
                return redirect()->back()->with('success','Berhasil Mengubah Data');
            }else{
                return redirect()->back()->with('error','Gagal Mengubah Data');
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
