<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

class PostController extends Controller
{
    private $path = 'storage/post/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::all();
        return view('backend.berita.index',compact('data'));
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
            'image' => 'required|mimes:jpg,png,gif,jpeg,webp'
        ]);
        $file = $request->file('image');
        $name = $file->hashName();
        $file->move($this->path,$name);
        $data = Post::create([
            'uuid'    => Uuid::uuid4()->toString(),
            'slug' => Str::slug($request->title),
            'title'   => $request->title,
            'content' => $request->content,
            'image'   => $this->path.$name
        ]);
        if($data)
        {
            return redirect()->route('berita.index')->with('success','Berhasil!');
        }else{
            return redirect()->route('berita.index')->with('error','Gagal!');
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
        $data = Post::all()->where('slug',$id)->first();
        return view('frontend.news.detail',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Post::all()->where('uuid',$id)->first();
        return view('backend.berita.edit',compact('data'));
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
        $data = Post::find($id);
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        if($request->hasFile('image'))
        {
            $request->validate([
                'image' => 'required|mimes:jpg,jpeg,png,webp,gif'
            ]);
            File::delete($data->cover);
            $file = $request->file('image');
            $name = $file->hashName();
            $file->move($this->path,$name);
            $data->update([
                'slug' => Str::slug($request->title),
                'title'   => $request->title,
                'content' => $request->content,
                'image'   => $this->path.$name
            ]);
            if($data)
            {
                return redirect()->route('berita.index')->with('success','Berhasil!');
            }else{
                return redirect()->route('berita.index')->with('error','Gagal!');
            }
        }else{
            $data->update([
                'slug' => Str::slug($request->title),
                'title'   => $request->title,
                'content' => $request->content,
            ]);
            if($data)
            {
                return redirect()->route('berita.index')->with('success','Berhasil!');
            }else{
                return redirect()->route('berita.index')->with('error','Gagal!');
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
        $data = Post::find($id);
        File::delete($data->cover);
        $data->delete();
        if($data)
        {
            return redirect()->route('berita.index')->with('success','Berhasil!');
        }else{
            return redirect()->route('berita.index')->with('error','Gagal!');
        }
    }
    
}
