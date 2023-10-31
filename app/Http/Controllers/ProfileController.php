<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    private $path = "storage/profile/";
    public function __construct()
    {
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        if(Auth::check())
        {
            return view('backend.profile.mahasiswa');
        }elseif(Auth::guard('pamongs')->check())
        {
            
           
        }elseif(Auth::guard('dpls')->check())
        {
           
        }else{
            
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
    public function profile(Request $request,$id)
    {
        $user = User::find($id);
        $request->validate([
            'profile' => 'required|mimes:jpg,png,gif,webp,jpeg'
        ]);
        File::delete($user->profile);
        $file = $request->file('profile');
        $newName = $file->hashName();
        $file->move($this->path,$newName);
        $user->update([
            'profile' => $this->path.$newName
        ]);
        if($user)
        {
            return redirect()->route('profile.index')->with('success','Berhasil');
        }else{
            return redirect()->route('profile.index')->with('error','Gagal');
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
        if(Auth::check())
        {
           if($request->new != '')
           {
            $request->validate([
                'nim' => 'required',
                'username' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'new'  => 'required',
                'confirm' => 'required|same:new'
            ]);
            $user = User::find($id);
            $user->update([
                'nim' => $request->nim,
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->new)
            ]);
            if($user)
            {
                return redirect()->route('profile.index')->with('success','Berhasil');
            }else{
                return redirect()->route('profile.index')->with('error','Gagal');
            }
           }else{
            $request->validate([
                'nim' => 'required',
                'username' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'tahun_masuk' => 'required'
              
            ]);
            $user = User::find($id);
            $user->update([
                'nim' => $request->nim,
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'tahun_masuk' => $request->tahun_masuk
              
            ]);
            if($user)
            {
                return redirect()->route('profile.index')->with('success','Berhasil');
            }else{
                return redirect()->route('profile.index')->with('error','Gagal');
            }
           }
        }elseif(Auth::guard('pamongs')->check())
        {
            
        }elseif(Auth::guard('dpls')->check())
        {
           
        }else{
            
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
