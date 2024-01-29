<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('vendor/modules/bootstrap/css/bootstrap.min.css') }}">
    <title>LAPORAN</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h2 class="text-center">Laporan Harian</h2>
                <hr>
                <table border="0" class="mb-4">
                    <thead>
                        <tr>
                            <td>Nim</td>
                            <td>: {{ $program->user->nim }}</td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>: {{ $program->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Angkatan</td>
                            <td>: {{ \Carbon\Carbon::parse($program->user->tahun_masuk)->format('Y') }}</td>
                        </tr>
                        <tr>
                            <td>Asal Sekolah</td>
                            <td>: {{ $program->pamongs->asal_sekolah }}</td>
                        </tr>
                    </thead>
                </table>
                <div class="table-responsive">
                    <table border="1" id="table-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Uraian Rencana Kegiatan</th>
                                <th>Deskripsi Kegiatan</th>
                                <th>Jam</th>
                                <th>Tanggal Pelaksanaan</th>
                                <th>Persetujuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mingguan as $item)
                                <tr>
                                    <td>{{ $loop->index += 1 }}</td>
                                    <td>{{ $item->rencana_kegiatan }}</td>
                                    <td>{!! $item->deskripsi !!}</td>
                                    <td>Waktu Mulai : <strong>{{ $item->mulai }}</strong> | Waktu Berakhir
                                        <strong>{{ $item->berakhir }}</strong>
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        @if ($item->status == 0)
                                            <span class="text-light badge bg-warning">Dalam Proses</span>
                                        @endif
                                        @if ($item->status == 1)
                                            <span class="text-light badge bg-success">Sesuai</span>
                                        @endif
                                        @if ($item->status == 2)
                                            <span class="text-light badge bg-success">Tidak Sesuai</span>
                                        @endif
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 30px">
            <div class="col-lg-6 col-6 text-center">
                <p class="fw-bold">
                    Mengetahui
                    <br>Guru Pamong
                    <br><br><br>{{$program->pamongs->name}}
                </p>
            </div>
            <div class="col-lg-6 col-6 text-center">
                <p class="fw-bold">
                    Mengetahui
                    <br>Mahasiswa Peserta MBKM
                    <br><br><br>{{$program->user->name}}
                </p>
            </div>
        </div>
    </div>
</body>

</html>
