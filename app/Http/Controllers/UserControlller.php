<?php

namespace App\Http\Controllers;

use App\Models\Dpl;
use App\Models\Pamong;
use App\Models\ProgramKegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\DurasiService;
use Carbon\Carbon;

class UserControlller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('operators')->check())
        {
            $data = User::all();
        
        }
        if(Auth::guard('dpls')->check())
        {   
            if(Auth::guard('dpls')->user()->roles == 'dpl')
            {
                $data = ProgramKegiatan::with('dpls')->where('dpl_id',Auth::guard('dpls')->user()->id)->get();
            }

            if(Auth::guard('dpls')->user()->roles == 'mk')
            {
                $data = User::all();
            }
          
        }
        if(Auth::guard('pamongs')->check())
        {
            $data = ProgramKegiatan::with('pamongs','user')->where('pamong_id',Auth::guard('pamongs')->user()->id)->get();
          
        }

        return view('backend.mahasiswa.index',[
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
        
        $data = User::all()->where('nim',$id)->first();
        
        $dpl = Dpl::all()->where('roles','dpl');
        $pamong = Pamong::all();
    
        $program = ProgramKegiatan::with('pamongs','dpls')->where('user_id',$data->id)->first();
        
        return view('backend.mahasiswa.detail',compact('data','program','dpl','pamong',));
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

    public function status(Request $request,$id)
    {
        $data = User::find($id);
        $data->update($request->all());
        if($data)
        {
            return redirect()->route('mahasiswa.index')->with('success','Berhasil Mengubah Data');
        }else{
            return redirect()->route('mahasiswa.index')->with('error','Gagal Mengubah Data');
        }
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
