@extends('backend.layout.master', ['title' => 'Rencana Kegiatan']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Rencana Kegiatan</h1>
        </div>
        <div class="section-body">
            <div class="row">
                @isset($program)
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if ($check->count() == 0)
                                    <form action="{{ Route('rencana-kegiatan.store') }}" enctype="multipart/form-data"
                                        method="post">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <label for="">Nama Kegiatan</label>
                                            <input type="text" name="nama_kegiatan" class="form-control"
                                                placeholder="Masukan Nama Kegiatan">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Upload File Rencana Kegiatan</label>
                                            <input type="file" name="rencana_kegiatan" id=""
                                                class="form-control-file">
                                            <button class="btn btn-primary mt-3 mb-3">submit</button>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{ Route('rencana-kegiatan.update', $program->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="">Nama Kegiatan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $check->first()->nama_kegiatan }}" name="nama_kegiatan"
                                                placeholder="Masukan Nama Kegiatan">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Upload File Rencana Kegiatan</label>
                                            <input type="file" name="file" id="" class="form-control-file">
                                            <small class="text-info">Kosongkan Jika Tidak Ingin Di Update | Tipe File
                                                PDF</small>
                                        </div>
                                        <button class="btn btn-primary mt-3 mb-3">update</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Guru Pamong</th>
                                        <th>Dosen Pembimbing Lapangan</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Berakhir</th>
                                        <th>Total Hari</th>
                                        <th>Sisa Hari</th>
                                        <th>Status Rencana Program </th>
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
                                                <form action="{{ Route('rencana_kegiatan.status', $program->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    @if ($program->status == 0)
                                                        <button class="btn btn-danger" name="status" value="1"
                                                            onclick="return confirm('Apakah anda yakin ingin menyetujui laporan akhir dan umum')">Belum
                                                            Di Setujui</button>
                                                    @else
                                                        <button class="btn btn-success" value="0" name="status"
                                                            onclick="return confirm('Apakah anda yakin ingin mengubah status ini ?')">Di
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
                    </div>
                    @if ($check->count() > 0)
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
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
                                                                <span class="badge bg-danger text-light">Belum Menambahkan
                                                                    Rencana Kegiatan</span>
                                                            </td>
                                                        @else
                                                            <td>
                                                                {{ $program->nama_kegiatan }}
                                                            </td>
                                                        @endif
                                                        <td>
                                                            <a href="javascript:void()" onclick="return laporanAkhir()"
                                                                class="btn btn-primary">Lihat Laporan Akhir</a>
                                                            <a href="javascript:void()" onclick="return laporanUmum()"
                                                                class="btn btn-outline-primary">Lihat Laporan
                                                                Umum</a>
                                                            <a href="javascript:void()" class="btn btn-dark"
                                                                onclick="return showLaporanMk()">Lihat Laporan Mata Kuliah</a>
                                                            <a onclick="return tambahCatatan()" href="javascript:void()"
                                                                class="btn btn-success">Lihat Catatan Dosen MK</a>
                                                            <a onclick="return tambahCatatanDpl()" href="javascript:void()"
                                                                class="btn btn-success">Lihat Catatan DPL</a>
                                                            <a onclick="return tambahCatatanPamong()" href="javascript:void()"
                                                                class="btn btn-success">Lihat Catatan Pamong</a>
                                                            <a href="javascript:void()" onclick="return rencanaKegiatan()"
                                                                class="btn btn-success">Lihat File Rencana
                                                                Kegiatan</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="alert alert-danger">Maaf DPL dan PAMONG Belum Di Input Oleh Admin / Kaprodi, Segera Hubungi
                        Admin / Kaprodi</div>
                @endisset
            </div>
        </div>
        <div class="modal fade" id="catatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <div class="modal fade" id="catatan_pamong" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lihat Catatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @isset($program->catatan_pamong)
                            {!! $program->catatan_pamong !!}
                        @else
                            <div class="alert alert-danger fw-bold">Belum Ada Catatan Dari Guru Pamong</div>
                        @endisset
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="catatan_dpl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lihat Catatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @isset($program->catatan_dpl)
                            {!! $program->catatan_dpl !!}
                        @else
                            <div class="alert alert-danger fw-bold">Belum Ada Catatan Dari Dosen DPL</div>
                        @endisset
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
        <div class="modal fade" id="rencana_kegiatan" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rencana Kegiatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @isset($program->rencana_kegiatan)
                            <iframe src="{{ asset($program->rencana_kegiatan) }}" width="100%" height="600px"></iframe>
                        @else
                            <div class="alert alert-danger fw-bold">Anda Belum Mengupload Rencana Kegiatan</div>
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
        <div class="modal fade" id="show_laporan_mk" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lihat File Laporan MK</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        @isset($program->laporan_mk)
                            <iframe src="{{ asset($program->laporan_mk) }}" width="100%" height="600px"></iframe>
                        @else
                            <div class="alert alert-danger">Belum Mengupload File Laporan Mata Kuliah</div>
                        @endisset
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const tambahCatatan = () => {
            $('#catatan').appendTo("body").modal('show');
        }
        const tambahCatatanDpl = () => {
            $('#catatan_dpl').appendTo("body").modal('show');
        }
        const tambahCatatanPamong = () => {
            $('#catatan_pamong').appendTo("body").modal('show');
        }
        const laporanAkhir = () => {
            $('#laporan_akhir').appendTo("body").modal('show');
        }
        const rencanaKegiatan = () => {
            $('#rencana_kegiatan').appendTo("body").modal('show');
        }
        const laporanUmum = () => {
            $('#laporan_umum').appendTo("body").modal('show');
        }
        const showLaporanMk = () => {
            $('#show_laporan_mk').appendTo("body").modal('show');
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
