@extends('backend.layout.master', ['title' => 'Detail Program Kegiatan']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Detail Program Kegiatan</h1>
        </div>
        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    @if($data->image != "")
                        <div class="card rounded-circle">
                            <img src="{{ asset('vendor/img/avatar/avatar-1.png') }}"alt="" class="card-img-top" srcset="">

                        </div>
                    @else
                        <div class="card rounded-circle">
                            <img src="{{ asset($data->profile) }}" class="card-img-top" alt=""
                            srcset="">
                        </div>
                    @endisset
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nim</label>
                                <input type="text" class="form-control bg-transparent" value="{{ $data->nim }}"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" class="form-control bg-transparent" value="{{ $data->name }}"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Email </label>
                                <input type="text" class="form-control bg-transparent" value="{{ $data->email }}"
                                    disabled>
                            </div>
                            <div class="form-group">

                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="">Nomor Telepon </label>
                                    <input type="text" class="form-control bg-transparent" value="{{ $data->phone }}"
                                        disabled>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="">Angkatan</label>
                                    <input type="text" class="form-control bg-transparent"
                                        value="{{ \Carbon\Carbon::parse($data->tahun_masuk)->format('Y') }}" disabled>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @isset($program)
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Rencana Kegiatan Mahasiswa </h4>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>Nama Rencana Kegiatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @if ($program->nama_kegiatan == '')
                                                    <td>
                                                        <span class="badge bg-danger text-light">Belum Menambahkan Rencana
                                                            Kegiatan</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        {{ $program->nama_kegiatan }}
                                                    </td>
                                                @endif


                                                <td>
                                                    @if ($program->status == 0)
                                                        <div class="badge bg-danger text-white">Belum Di Verifikasi Pamong</div>
                                                    @else
                                                        <a href="javascript:void()" onclick="return laporanAkhir()"
                                                            class="btn btn-primary">Lihat Laporan Akhir</a>
                                                        <a href="javascript:void()" onclick="return laporanUmum()"
                                                            class="btn btn-outline-primary">Lihat Laporan Umum</a>
                                                    @endif
                                                    <a href="javascript:void()" onclick="return showCatatan()"
                                                        class="btn btn-success">Lihat Catatan</a>
                                                    <a href="javascript:void()" onclick="return openPDFRencanaKegiatan()"
                                                        class="btn btn-success">Lihat File Rencana Kegiatan</a>
                                                    @if (Auth::guard('dpls')->check())
                                                        @if (Auth::guard('dpls')->user()->roles == 'mk')
                                                            <button onclick="return tambahCatatan()"
                                                                class="btn btn-success">Tambah Catatan</button>
                                                        @endif
                                                    @endif

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if (Auth::guard('operators')->check())
                                @isset($program)
                                    <button class="mb-4 btn btn-primary" onclick="return openModalEdit()">Ubah Pamong |
                                        DPL</button>
                                @else
                                    <button class="mb-4 btn btn-primary" onclick="return openModal()">Tambah Pamong |
                                        DPL</button>
                                @endisset
                            @endif
                            <h4>Pamong Sekolah dan DPL </h4>
                            @isset($program)
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>Pamong</th>
                                                <th>Dosen</th>
                                                <th>Waktu Mulai</th>
                                                <th>Waktu Berakhir</th>
                                                <th>Durasi Hari</th>
                                                <th>Sisa Waktu</th>
                                                <th>Status Program Mahasiswa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $service = app('App\Services\DurasiService');
                                            @endphp
                                            <tr>
                                                <td>{{ $program->pamongs->name }}</td>
                                                <td>{{ $program->dpls->name }}</td>
                                                <td>{{ $program->waktu_mulai }}</td>
                                                <td>{{ $program->waktu_berakhir }}</td>
                                                <td>{{ $service->totalHari($program->waktu_mulai, $program->waktu_berakhir) }}
                                                    Hari</td>
                                                <td>{{ $service->totalHari(\Carbon\Carbon::today(), $program->waktu_berakhir) }}
                                                    Hari</td>
                                                <td>
                                                    @if (Auth::guard('pamongs')->check())
                                                        <form action="{{Route('rencana_kegiatan.status', $program->id)}}" method="post">
                                                            @csrf
                                                            @method("PUT")
                                                            @if ($program->status == 0)
                                                                <button class="btn btn-danger" name="status" value="1"
                                                                     onclick="return confirm('Apakah anda yakin ingin menyetujui laporan akhir dan umum')">Belum
                                                                    Di Setujui</button>
                                                            @else
                                                                <button class="btn btn-success" value="0"
                                                                    name="status" onclick="return confirm('Apakah anda yakin ingin mengubah status ini ?')">Di
                                                                    Setujui</button>
                                                            @endif
                                                        </form>
                                                    @else
                                                        @if ($program->status == 0)
                                                            <button class="btn btn-danger">Belum
                                                                Di Setujui</button>
                                                        @else
                                                            <button class="btn btn-success">Di
                                                                Setujui</button>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-danger">Maaf Mahasiswa Belum Mendapat Pembagian PAMONG DAN DPL </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pilih DPL Dan Pamong</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ Route('upload_pembagian') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <input type="text" name="user_id" hidden value="{{ $data->id }}">
                                <label for="">Pilih Guru Pamong | Sekolah</label>
                                <select name="pamong_id" id="" class="form-control">
                                    <option value="">Pilih Pamong | Sekolah</option>
                                    @foreach ($pamong as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }} | {{ $p->asal_sekolah }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Pilih Dosen DPL</label>
                                <select name="dpl_id" id="" class="form-control">
                                    <option value="">Pilih Dosen DPL</option>
                                    @foreach ($dpl as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Waktu Mulai</label>
                                <input type="date" name="waktu_mulai" class="form-control" id="">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Waktu Berakhir</label>
                                <input type="date" name="waktu_berakhir" class="form-control" id="">
                                </select>
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
        @isset($program)
            <div class="modal fade" id="catatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Catatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ Route('catatan', $program->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <textarea name="catatan" id="deskripsi" cols="30" rows="10">{{ $program->catatan }}</textarea>
                                <button class="btn btn-primary mt-3">simpan</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
        <div class="modal fade" id="pdfrencanakegiatan" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lihat File Rencana Kegiatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @isset($program->rencana_kegiatan)
                            <iframe src="{{ asset($program->rencana_kegiatan) }}" width="100%" height="600px"></iframe>
                        @else
                            <div class="alert alert-danger">Belum Mengupload File Rencana Kegiatan</div>
                        @endisset
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @isset($program)
            <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah DPL Dan Pamong</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ Route('upload_pembagian.update', $program->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <input type="text" name="user_id" hidden value="{{ $data->id }}">
                                    <label for="">Pilih Guru Pamong | Sekolah</label>
                                    <select name="pamong_id" id="" class="form-control">
                                        <option value="">Pilih Pamong | Sekolah</option>
                                        @foreach ($pamong as $p)
                                            <option {{ $p->id == $program->pamongs->id ? 'selected' : '' }}
                                                value="{{ $p->id }}">{{ $p->name }} | {{ $p->asal_sekolah }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Pilih Dosen DPL</label>
                                    <select name="dpl_id" id="" class="form-control">
                                        <option value="">Pilih Dosen DPL</option>
                                        @foreach ($dpl as $d)
                                            <option {{ $d->id == $program->dpls->id ? 'selected' : '' }}
                                                value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Waktu Mulai</label>
                                    <input type="date" value="{{ $program->waktu_mulai }}" name="waktu_mulai"
                                        class="form-control" id="">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Waktu Berakhir</label>
                                    <input type="date" value="{{ $program->waktu_berakhir }}" name="waktu_berakhir"
                                        class="form-control" id="">
                                    </select>
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
            <div class="modal fade" id="laporan_akhir" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Laporan Akhir</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @isset($program->laporan_akhir)
                                <iframe src="{{ asset($program->laporan_akhir) }}" width="100%" height="600px"></iframe>
                            @else
                                <div class="alert alert-danger fw-bold">Anda Belum Mengupload Laporan Akhir</div>
                            @endisset
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="laporan_umum" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Laporan Umum</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @isset($program->laporan_umum)
                                <iframe src="{{ asset($program->laporan_umum) }}" width="100%" height="600px"></iframe>
                            @else
                                <div class="alert alert-danger fw-bold">Anda Belum Mengupload Laporan Umum</div>
                            @endisset
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="show_catatan" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Lihat Catatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @isset($program->catatan)
                                {!! $program->catatan !!}
                            @else
                                <div class="alert alert-danger fw-bold">Belum Ada Catatan Dari Dosen MK</div>
                            @endisset
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </section>
    <script>
        const openModal = () => {
            $('#add').appendTo("body").modal('show');
        }
        const openModalEdit = () => {
            $('#edit').appendTo("body").modal('show');
        }
        const openPDFRencanaKegiatan = () => {
            $('#pdfrencanakegiatan').appendTo("body").modal('show');
        }
        const tambahCatatan = () => {
            $('#catatan').appendTo("body").modal('show');
        }
        const laporanAkhir = () => {
            $('#laporan_akhir').appendTo("body").modal('show');
        }
        const laporanUmum = () => {
            $('#laporan_umum').appendTo("body").modal('show');
        }
        const showCatatan = () => {
            $('#show_catatan').appendTo("body").modal('show');
        }
    </script>
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
