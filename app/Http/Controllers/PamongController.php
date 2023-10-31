<?php

namespace App\Http\Controllers;

use App\Models\Pamong;
use App\Models\ProgramKegiatan;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class PamongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pamong::all();
        return view('backend.pamong.index',[
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
        $request->validate([
            'username' => 'required|unique:pamongs',
            'name' => 'required',
            'email' => 'required|unique:pamongs',
            'asal_sekolah' => 'required',
            'password' => 'required',
            'confirm' => 'required|same:password',
        ]);

        $data = Pamong::create(
            [
                'uuid' => Uuid::uuid4()->toString(),
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'asal_sekolah' => $request->asal_sekolah,
                'password' => bcrypt($request->password),
            ]
        );
        if($data)
        {
            return redirect()->route('pamong.index')->with('success','Berhasil Menambkan Data');
        }else{
            return redirect()->route('pamong.index')->with('error','Gagal Menambkan Data');
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
        $data = Pamong::all()->where('uuid',$id)->first();
        return view('backend.pamong.edit',compact('data'));
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
        $data = Pamong::find($id);
        if(isset($request->password))
        {
            $request->validate([
                'username' => 'required',
                'name' => 'required',
                'email' => 'required',
                'asal_sekolah' => 'required',
                'password' => 'required',
                'confirm' => 'required|same:password',
            ]);
            $data->update([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'asal_sekolah' => $request->asal_sekolah,
                'password' => bcrypt($request->password),
            ]);
            if($data)
            {
                return redirect()->route('pamong.index')->with('success','Berhasil Mengubah Data');
            }else{
                return redirect()->route('pamong.index')->with('error','Gagal Mengubah Data');
            }
        }else{
            $request->validate([
                'username' => 'required',
                'name' => 'required',
                'email' => 'required',
                'asal_sekolah' => 'required',
            ]);
            $data->update([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'asal_sekolah' => $request->asal_sekolah,
            ]);
            if($data)
            {
                return redirect()->route('pamong.index')->with('success','Berhasil Mengubah Data');
            }else{
                return redirect()->route('pamong.index')->with('error','Gagal Mengubah Data');
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
        $pamong = Pamong::find($id)->delete();
        ProgramKegiatan::with('pamongs')->where('pamong_id',$id)->delete();
        if($pamong)
        {
            return redirect()->back()->with('success','Data Pamong Berhasil Di Hapus');    
        }else{
            return redirect()->back()->with('error','Data Pamong Gagal Di Hapus');    
        }
        
    }
}
