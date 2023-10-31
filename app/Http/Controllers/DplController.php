<?php

namespace App\Http\Controllers;

use App\Models\Dpl;
use App\Models\ProgramKegiatan;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class DplController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.dosen.index',[
            'data' => Dpl::all() 
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
            'name' => 'required',
            'username' => 'required|unique:dpls',
            'email' => 'required|unique:dpls',
            'password' => 'required',
            'roles' => 'required',
            'confirm' => 'required|same:password',
        ]);
        $data = Dpl::create([
            'uuid' => Uuid::uuid4()->toString(),
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'roles' => $request->roles
        ]);
        if($data)
        {
            return redirect()->route('dosen.index')->with('success','Berhasil Di Tambahkan');
        }else{
            return redirect()->route('dosen.index')->with('error','Gagal Di Tambahkan');
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
        $data = Dpl::all()->where('uuid',$id)->first();
        return view('backend.dosen.edit',[
            'data' => $data
        ]);
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
        $data = Dpl::find($id);
        if(isset($request->password))
        {
            $request->validate([
                'username' => 'required',
                'name' => 'required',
                'email' => 'required',
                'roles' => 'required',
                'password' => 'required',
                'confirm' => 'required|same:password',
            ]);
            $data->update([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'roles' => $request->roles,
                'password' => bcrypt($request->password),
            ]);
            if($data)
            {
                return redirect()->route('dosen.index')->with('success','Berhasil Mengubah Data');
            }else{
                return redirect()->route('dosen.index')->with('error','Gagal Mengubah Data');
            }
        }else{
            $request->validate([
                'username' => 'required',
                'name' => 'required',
                'email' => 'required',
                'roles' => 'required',
            ]);
            $data->update([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'roles' => $request->roles,
            ]);
            if($data)
            {
                return redirect()->route('dosen.index')->with('success','Berhasil Mengubah Data');
            }else{
                return redirect()->route('dosen.index')->with('error','Gagal Mengubah Data');
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
        $data = ProgramKegiatan::with('dpls')->where('dpl_id',$id)->delete();
        $dosen = Dpl::find($id)->delete();
        return redirect()->route('dosen.index')->with('success','Berhasil Di Hapus');
    }
}
