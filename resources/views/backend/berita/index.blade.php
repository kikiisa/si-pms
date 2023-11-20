@extends('backend.layout.master', ['title' => 'Berita']);
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Daftar Berita</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button class="mb-4 btn btn-primary" onclick="return openModal()">Tambah Berita</button>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Berita</th>
                                        <th>Tanggal Terbit</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{$loop->index+=1}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td>
                                                <form action="{{Route('berita.destroy',$item->id)}}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button class="btn btn-danger" onclick="return confirm('apakah anda ingin menghapus  data ini ?')">Hapus</button>
                                                    <a href="{{Route('berita.edit',$item->uuid)}}" class="btn btn-warning">Edit</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{Route('berita.store')}}"  method="post" enctype="multipart/form-data">
                    @csrf
                    @method("POST")
                    <div class="form-group">
                        <label for="">Judul Berita</label>
                        <input type="text" value="{{old('judul')}}" placeholder="Judul Berita" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        <textarea name="content" id="deskripsi">{{old('content')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih File</label>
                        <input type="file" name="image" class="form-control-file">
                        <small class="text-info">JPG|PNG|GIF|JPEG|WEBP</small>
                    </div>
                    <button class="btn btn-primary">simpan</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('vendor/modules/toastify-js/src/toastify.js') }}"></script>
@if (count($errors) > 0)
<script>
    var errors = @json($errors->all());
    Toastify({
        text: errors,
        duration: 3000,
        close: true,
        backgroundColor: "#D61355",
    }).showToast();
    
</script>
@enderror
@if (session()->has('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 3000,
            close: true,
            backgroundColor: "#19C37D",
        }).showToast();
    </script>
@endif
@if (session()->has('error'))
    <script>
        Toastify({
            text: "{{ session('error') }}",
            duration: 3000,
            close: true,
            backgroundColor: "#D61355",
        }).showToast();
    </script>
@endif
<script>
    const openModal = () => {
        $('#add').appendTo("body").modal('show');
    }
</script>
@endsection
