<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\MultipleLogin;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    private $services;

    public function __construct()
    {
        $this->services = new MultipleLogin();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.auth.login');
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
        if($request->role == 'mahasiswa')
        {
            return $this->services->login_user();
        }elseif($request->role == 'pamong')
        {
            return $this->services->login_pamong();
        }elseif($request->role == 'dpl')
        {
            return $this->services->login_dpl();
        }else{
            return $this->services->login_operator();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Auth::logout();
        Auth::guard('pamongs')->logout();
        Auth::guard('dpls')->logout();
        Auth::guard('operators')->logout();
        return redirect()->route('auth')->with('success','Berhasil Logout');
    }
}
