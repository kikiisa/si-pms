<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Operator::all();
        return view('backend.operator.index',compact('data')); 
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
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm' => 'required|same:password',
        ]);
        $data = Operator::create([
            'uuid' => Uuid::uuid4()->toString(),
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        if($data)
        {
            return redirect()->route('operator.index')->with('success','Data Berhasilasil Disimpan');
        }else{
            return redirect()->route('operator.index')->with('error','Data Gagal Disimpan');
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
        $data = Operator::all()->where('uuid',$id)->first();
        return view('backend.operator.edit',compact('data'));
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
        $operator = Operator::find($id);
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'username' => 'required',
            ]);
            if($request->new != '')
            {
                $request->validate([
                    'new'  => 'required|min:8',
                    'confirm' => 'required|same:new'
                ]);
                $operator->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $request->username,
                    'password' => bcrypt($request->new)
                ]);
                if($operator)
                {
                    return redirect()->route('operator.index')->with('success','Berhasil');
                }else{
                    return redirect()->route('operator.index')->with('error','Gagal');
                }
            }else{
                $operator->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $request->username,
                ]);
                if($operator)
                {
                    return redirect()->route('operator.index')->with('success','Berhasil');
                }else{
                    return redirect()->route('operator.index')->with('error','Gagal');
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
        $data = Operator::find($id);
        $data->delete();
        if($data)
        {
            return redirect()->route('operator.index')->with('success','Data Berhasilasil Dihapus');
        }else{
            return redirect()->route('operator.index')->with('error','Data Gagal Dihapus');
        }
    }
}
