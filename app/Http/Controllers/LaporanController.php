<?php

namespace App\Http\Controllers;

use App\Models\ProgramKegiatan;
use App\Services\DurasiService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LaporanController extends Controller
{
    private $duration;
    private $path = 'storage/report/';
    public function __construct()
    {
        $this->duration = new DurasiService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadLaporanMk(Request $request)
    {
        $user = ProgramKegiatan::with('user')->where('user_id', auth()->user()->id)->first();
        $request->validate([
            'laporan_mk' => 'required|mimes:pdf',
        ]);
        File::delete($user->laporan_mk);
        $file = $request->file('laporan_mk');
        $name = $file->hashName();
        $file->move($this->path, $name);
        $user->update([
            'laporan_mk' => $this->path.$name
        ]);
        if($user)
        {
            return redirect()->back()->with('success', 'Berhasil Menambahkan Laporan MK');
        }else{
            return redirect()->back()->with('error', 'Gagal Menambahkan Laporan MK');
        }
    }
    public function tambahLaporan(Request $request)
    {
        $request->validate([
            'laporan_akhir' => 'required|mimes:pdf',
            'laporan_umum'  => 'required|mimes:pdf',
        ]);
        $user = ProgramKegiatan::with('user')->where('user_id', auth()->user()->id)->first();
        
        File::delete($user->laporan_akhir);
        File::delete($user->laporan_umum);
        $fileAkhir = $request->file('laporan_akhir');
        $fileUmum = $request->file('laporan_umum');
        $newNameAkhir = $fileAkhir->hashName();
        $newNameUmum = $fileUmum->hashName();
        $fileAkhir->move($this->path, $newNameAkhir);
        $fileUmum->move($this->path, $newNameUmum);
        $user->update([
            'laporan_akhir' => $this->path.$newNameAkhir,
            'laporan_umum' => $this->path.$newNameUmum
        ]);
        if($user){
            return redirect()->back()->with('success', 'Berhasil Menambahkan Laporan Akhir Dan Umum');
        }else{
            return redirect()->back()->with('error', 'Terjadi Kesalahan');
        }

    }
    public function index()
    {

        $user = ProgramKegiatan::with('user')->where('user_id', auth()->user()->id);
        // $sisa_waktu = $this->duration->totalHari(Carbon::today(), $user->waktu_berakhir); 
        return view('backend.mahasiswa.report.index',[
          'data' => $user,
          'service' => $this->duration
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
        //
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
