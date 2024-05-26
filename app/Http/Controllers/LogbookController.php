<?php

namespace App\Http\Controllers;

use App\Models\LogHarian;
use App\Models\ProgramKegiatan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;

class LogbookController extends Controller
{
    private $path = "storage/image/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $result = LogHarian::all()->where('user_id', Auth::user()->id);
        
        $groupedLogs = $result->groupBy(function ($log) {
            return Carbon::parse($log->created_at)->weekOfYear;
        });
        
        $checkLogBookMingguan = $groupedLogs->sortBy(function ($logsInWeek, $weekNumber) {
            return $weekNumber;
        });
        $program = ProgramKegiatan::all()->where('user_id', Auth::user()->id);
        // $checkLogBookHarian = LogHarian::all()->where('user_id', Auth::user()->id);
        $checkLogBookHarian = LogHarian::where('user_id',Auth::user()->id)
        ->get()
        ->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m-d');
        });
        
        return view('backend.mahasiswa.log.index', [
            'data' => $result,
            'mingguan' => $checkLogBookMingguan,
            'program' => $program,
            'harian' => $checkLogBookHarian,
        ]);
    }

    public function rekap(Request $request)
    {
        if ($request->has("harian") && $request->has("mingguan")) {
            $mingguan = $request->get("mingguan");
            $harian = $request->get("harian");
            if ($mingguan) {
                if (!Auth::check()) {
                    $nim = $request->nim;
                    $getUserEntity = User::all()->where('nim', $nim)->first();

                    // jika tidak terauntentikasi
                    $result = LogHarian::all()->where('user_id', $getUserEntity->id);
                    $groupedLogs = $result->groupBy(function ($log) {
                        return Carbon::parse($log->created_at)->weekOfMonth;
                    });
                    $checkLogBookMingguan = $groupedLogs->sortBy(function ($logsInWeek, $weekNumber) {
                        return $weekNumber;
                    });
                    $program = ProgramKegiatan::with('pamongs', 'user', 'dpls')->where('user_id', $getUserEntity->id)->first();
                    // dd($mingguan);
                    return response()->view("backend.mahasiswa.log.report-mingguan", [
                        'program' => $program,
                        'mingguan' => $checkLogBookMingguan[$mingguan],
                    ]);
                } else {
                    // jika terauntikasi
                    $result = LogHarian::all()->where('user_id', Auth::user()->id);
                    
                    $groupedLogs = $result->groupBy(function ($log) {
                        
                        return Carbon::parse($log->created_at)->weekOfMonth;
                    });
                    // dd($groupedLogs);
                    $checkLogBookMingguan = $groupedLogs->sortBy(function ($logsInWeek, $weekNumber) {
                        return $weekNumber;
                    });
                    
                    $program = ProgramKegiatan::with('pamongs', 'user', 'dpls')->where('user_id', Auth::user()->id)->first();
                    
                    return response()->view("backend.mahasiswa.log.report-mingguan", [
                        'program' => $program,
                        'mingguan' => $checkLogBookMingguan[$mingguan],
                    ]);
                    
                }
            }

            if ($harian != "") {
                if(!Auth::check())
                {
                    $nim = $request->nim;
                    $getUserEntity = User::all()->where('nim', $nim)->first();
                    
                    $result = LogHarian::all()->where('user_id',$getUserEntity->id);
                    $checkLogBookHarian = LogHarian::where('user_id',$getUserEntity->id)
                    ->get()
                    ->groupBy(function ($date) {
                        return \Carbon\Carbon::parse($date->created_at)->format('Y-m-d');
                    });
                    $program = ProgramKegiatan::with('pamongs', 'user', 'dpls')->where('user_id', $getUserEntity->id)->first();
                    return response()->view("backend.mahasiswa.log.report-harian", [
                        'program' => $program,
                        'mingguan' => $checkLogBookHarian->get($harian,[]),
                    ]);
                }else{
                    $program = ProgramKegiatan::with('pamongs', 'user', 'dpls')->where('user_id',Auth::user()->id)->first();
                    $result = LogHarian::all()->where('user_id', Auth::user()->id);
                    $checkLogBookHarian = LogHarian::where('user_id',Auth::user()->id)
                    ->get()
                    ->groupBy(function ($date) {
                        return \Carbon\Carbon::parse($date->created_at)->format('Y-m-d');
                    });
                    return response()->view("backend.mahasiswa.log.report-harian", [
                        'program' => $program,
                        'mingguan' => $checkLogBookHarian->get($harian,[]),
                    ]);
                    
                }
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
            'berakhir' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $file = $request->file("image");
        $newName = $file->hashName();
        $file->move($this->path, $newName);
        $finalName = $this->path . $newName;
        $data = LogHarian::create([
            'uuid' => Uuid::uuid4()->toString(),
            'rencana_kegiatan' => $request->rencana_kegiatan,
            'deskripsi' => $request->deskripsi,
            'mulai' => $request->mulai,
            'berakhir' => $request->berakhir,
            'category' => $request->kategori,
            'user_id' => Auth::user()->id,
            "image" => $finalName,
        ]);
        if ($data) {
            return redirect()->back()->with('success', 'Berhasil Menambahkan Log Book Harian');
        } else {
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
        return view('backend.mahasiswa.log.detail', [
            'data' => LogHarian::all()->where('uuid', $id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailLogBook(Request $request, $id)
    {

        $data = User::with('logbook')->where("nim", $id)->first();
        $program = ProgramKegiatan::all()->where('user_id', $data->id);
        $checkLogBookHarian = LogHarian::all()->where('user_id', $data->id);
        $groupedLogs = $checkLogBookHarian->groupBy(function ($log) {
            return Carbon::parse($log->created_at)->weekOfYear;
        });
        $checkLogBookMingguan = $groupedLogs->sortBy(function ($logsInWeek, $weekNumber) {
            return $weekNumber;
        });
        $harian = LogHarian::where('user_id',$data->id)
            ->orderBy('created_at') // Pastikan data diurutkan berdasarkan tanggal
            ->get()
            ->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('Y-m-d');
            });
        return view('backend.mahasiswa.log.index', [
            'data' => $data->logbook,
            'program' => $program,
            'check' => $checkLogBookHarian,
            'mingguan' => $checkLogBookMingguan,
            'harian' => $harian,
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
        if ($data) {
            return redirect()->back()->with('success', 'Berhasil Mengubah Data');
        } else {
            return redirect()->back()->with('error', 'Gagal Mengubah Data');
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
        $data = LogHarian::find($id);
        File::delete($data->image);
        $data->delete();
        if ($data) {
            return redirect()->back()->with('success', 'Berhasil Menghapus Data');
        } else {
            return redirect()->back()->with('error', 'Gagal Menghapus Data');
        }
    }
}
