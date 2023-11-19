@extends('backend.layout.master', ['title' => 'Detail Log Book']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Loog Book</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>{{$data->rencana_kegiatan}}</h5>
                            <div class="content mt-3 mb-3">
                                {!! $data->deskripsi !!}
                            </div>
                            <a href="{{Route('logbook')}}" class="btn btn-primary">Kembali</a>
                            @if ($data->status == 0)
                            <td><span class="text-light badge bg-warning">Dalam Peninjauan</span></td>
                            @endif
                            @if ($data->status == 1)
                                <td><span class="text-light badge bg-success">Sesuai</span></td>
                            @endif
                            @if ($data->status == 2)
                                <td><span class="text-light badge bg-success">Tidak Sesuai</span></td>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Log Book Harian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{Route('logbook.store')}}" method="post">
                            @method("POST")
                            @csrf
                            <div class="form-group">
                                <label for="">Rencana Kegiatan</label>
                                <input type="text" value="{{old('rencana_kegiatan')}}" name="rencana_kegiatan" placeholder="Masukan Rencana Kegiatan"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi Kegiatan</label>
                                <textarea required id="deskripsi" name="deskripsi" id="" cols="30" rows="10">{{old('deskripsi')}}</textarea>
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
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const themeOptions = document.body.classList.contains("theme-dark") ? {
                skin: "oxide-dark",
                content_css: "dark",
            } : {
                skin: "oxide",
                content_css: "default",
            }

            tinymce.init({
                selector: "#deskripsi",
                ...themeOptions
            })
            tinymce.init({
                selector: "#dark",
                toolbar: "undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code",
                plugins: "code",
                ...themeOptions,
            })
        })
    </script>
    <script>
        const openModal = () => {
            $('#add').appendTo("body").modal('show');
        }
    </script>
@endsection
