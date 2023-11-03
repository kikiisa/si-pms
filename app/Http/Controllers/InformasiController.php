<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $data = Informasi::all();
        return view('backend.post.index',compact('data'));
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
            'title' => 'required',
            'content' => 'required',
        ]);
        $data = Informasi::create([
            'uuid' => Uuid::uuid4()->toString(),
            'slug' => Str::slug($request->title),
            'title' => $request->title,
            'content' => $request->content
        ]);
        
        if($data)
        {
            return redirect()->route('post.index')->with('success','Data Berhasilasil Disimpan');
        }else{
            return redirect()->route('post.index')->with('error','Data Gagal Disimpan');
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
       $data = Informasi::all()->where('slug',$id)->first();
       return view('frontend.detail.index',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Informasi::all()->where('uuid',$id)->first();
        return view('backend.post.edit',compact('data'));
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
        $data = Informasi::find($id);
        $data->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content
        ]);
        if($data)
        {
            return redirect()->route('post.index')->with('success','Data Berhasil Diupdate');
        }else{
            return redirect()->route('post.index')->with('error','Data Gagal Diupdate');
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
        $data = Informasi::find($id);
        $data->delete();
        if($data)
        {
            return redirect()->route('post.index')->with('success','Data Berhasil Dihapus');
        }else{
            return redirect()->route('post.index')->with('error','Data Gagal Dihapus');
        }
    }
}
