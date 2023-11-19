@extends('backend.layout.master', ['title' => 'Setting']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pengaturan</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{Route('pengaturan.update',$data->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label for="">Judul Aplikasi</label>
                                    <input type="text" value="{{ $data->title}}" name="title" placeholder="Judul Aplikasi" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Hero Title</label>
                                    <input type="text" name="judul" value="{{ $data->judul}}" placeholder="Hero Title" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi Hero Title</label>
                                    <input type="text" value="{{ $data->sub_judul}}" name="sub_judul" placeholder="Hero Title" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi Full</label>
                                    <textarea name="deskripsi_full" id="deskripsi" cols="30" rows="10">{{ $data->deskripsi_full }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">File SK REKTOR</label>
                                    <input type="file" name="sk_rektor" id="" class="form-control-file">
                                    <small class="text-info mt-2">File : PDF</small>
                                </div>
                                <div class="form-group">
                                    <label for="">File Surat Pertanyaan</label>
                                    <input type="file" name="surat_pernyataan" id="" class="form-control-file">
                                    <small class="text-info mt-2">File : DOCX</small>
                                </div>
                                <button class="btn btn-primary">simpan</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('vendor/modules/toastify/src/toastify.js') }}"></script>
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
@endsection
