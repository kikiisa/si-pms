@extends('backend.layout.master', ['title' => 'Log Book']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Log Book Kegiatan</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if (Auth::check() || Auth::guard("dpls")->check())
                                @if ($program->count() > 0)
                                    @if ($program->first()->nama_kegiatan != '')
                                        <form action="{{ Route('logbook.index') }}" method="get">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <select name="q" id="q" class="form-control">
                                                        <option value="">Pilih Rekapan</option>
                                                        <option value="mingguan">Mingguan</option>
                                                        <option value="harian">Harian</option>
                                                    </select>
                                                    @if (!Auth::check())
                                                        <input type="text" hidden value="{{ request()->segment(3) }}"
                                                            name="nim">
                                                    @endif
                                                </div>
                                                <button class="btn btn-warning" name="aksi" value="cetak">cetak <i
                                                        class="fa fa-print"></i></button>
                                            </div>
                                        </form>
                                        <button class="mb-4 btn btn-primary" onclick="return openModal()">Tambah Log
                                            Book</button>
                                    @else
                                        <div class="alert alert-danger text-center">Silahkan Upload Rencana Kegiatan Untuk
                                            Melakukan Pengisian Log Book</div>
                                    @endif
                                @else
                                    <div class="alert alert-danger text-center">Belum mendapatkan Pembagian DPL Dan Pamong
                                    </div>
                                @endif
                            @endif

                            @if ($data->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Uraian Rencana Kegiatan</th>
                                                <th>Jam</th>
                                                <th>Tanggal Pelaksanaan</th>
                                               
                                                @if (Auth::guard('pamongs')->check())
                                                    <th>Persetujuan</th>
                                                @endif
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $loop->index += 1 }}</td>
                                                    <td>{{ $item->rencana_kegiatan }}</td>
                                                    <td>Waktu Mulai : <strong>{{ $item->mulai }}</strong> | Waktu Berakhir
                                                        <strong>{{ $item->berakhir }}</strong></td>
                                                    <td>{{ $item->created_at }}</td>
                                                   
                                                    @if (Auth::guard('pamongs')->check())
                                                        <td>
                                                            <form action="{{ Route('logbook.update', $item->id) }}"
                                                                class="mt-3" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <select name="status" id="" class="form-control">
                                                                    <option value="">Pilih</option>
                                                                    <option value="1">Sesuai</option>
                                                                    <option value="2">Tidak Sesuai</option>
                                                                </select>
                                                                <button class="mt-2 btn btn-dark w-100">simpan</button>
                                                            </form>
                                                        </td>
                                                    @endif
                                                    @if ($item->status == 0)
                                                        <td><span class="text-light badge bg-warning">Dalam
                                                                Peninjauan</span></td>
                                                    @endif
                                                    @if ($item->status == 1)
                                                        <td><span class="text-light badge bg-success">Sesuai</span></td>
                                                    @endif
                                                    @if ($item->status == 2)
                                                        <td><span class="text-light badge bg-danger">Tidak Sesuai</span>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ Route('logbook.show', $item->uuid) }}"
                                                            class="btn btn-success text-light">Detail</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="bg-danger p-4 rounded-3 text-center text-light">Log Book Masih Kosong
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Log Book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ Route('logbook.store') }}" method="post">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <label for="">Rencana Kegiatan</label>
                                <input type="text" value="{{ old('rencana_kegiatan') }}" name="rencana_kegiatan"
                                    placeholder="Masukan Rencana Kegiatan" class="form-control">
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="">Waktu Mulai</label>
                                    <input type="time" name="mulai" class="form-control" id="">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="">Waktu Berakhir</label>
                                    <input type="time" name="berakhir" class="form-control" id="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Kategori Log Book</label>
                                <input type="text" hidden name="kategori" value="harian" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi Kegiatan</label>
                                <textarea required id="deskripsi" name="deskripsi" id="" cols="30" rows="10">{{ old('deskripsi') }}</textarea>
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
