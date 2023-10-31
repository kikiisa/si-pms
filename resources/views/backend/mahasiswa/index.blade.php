@extends('backend.layout.master', ['title' => 'Master Mahasiswa']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Mahasiswa MBKM</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>Nomor Telephone</th>
                                            <th>Angkatan</th>
                                            <th>Status akun</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->index += 1 }}</td>
                                                <td>{{ $item->name == '' ? $item->user->name : $item->name }}</td>
                                                <td>{{ $item->email == '' ? $item->user->email : $item->email }}</td>
                                                <td>{{ $item->phone == '' ? $item->user->phone : $item->phone }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->tahun_masuk)->format('Y') }}
                                                </td>
                                                @if (Auth::guard('pamongs')->check())
                                                    <td>

                                                        @if ($item->user->status == 0)
                                                            <a class="btn btn-danger" name="status">NonAktif</a>
                                                        @else
                                                            <a class="btn btn-success" name="status">Aktif</a>
                                                        @endif

                                                    </td>
                                                @endif
                                                @if (Auth::guard('dpls')->check())
                                                    @if (Auth::guard('dpls')->user()->roles == 'mk')
                                                        <td>

                                                            @if ($item->status == 0)
                                                                <a class="btn btn-danger" name="status">NonAktif</a>
                                                            @else
                                                                <a class="btn btn-success" name="status">Aktif</a>
                                                            @endif

                                                        </td>
                                                    @else
                                                        <td>

                                                            @if ($item->user->status == 0)
                                                                <a class="btn btn-danger" name="status">NonAktif</a>
                                                            @else
                                                                <a class="btn btn-success" name="status">Aktif</a>
                                                            @endif

                                                        </td>
                                                    @endif
                                                @endif
                                                @if (Auth::guard('operators')->check())
                                                    <td>
                                                        <form action="{{ Route('status', $item->id) }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            @if ($item->status == 0)
                                                                <button class="btn btn-danger" value="1"
                                                                    name="status">NonAktif</button>
                                                            @else
                                                                <button class="btn btn-success" value="0"
                                                                    name="status">Aktif</button>
                                                            @endif
                                                        </form>
                                                    </td>
                                                @endif
                                                <td>
                                                    @if (Auth::guard('dpls')->check())
                                                        @if (Auth::guard('dpls')->user()->roles == 'mk')
                                                            <a href="{{ Route('mahasiswa.show', $item->nim) }}"
                                                                class="btn btn-info">Detail Program</a>
                                                                <a href="{{Route('detailLog',$item->nim)}}" class="btn btn-success">Lihat Log Book</a>
                                                                @else
                                                                <a href="{{ Route('mahasiswa.show', $item->user->nim) }}"
                                                                    class="btn btn-info">Detail Program</a>
                                                                    <a href="{{Route('detailLog',$item->user->nim)}}" class="btn btn-success">Lihat Log Book</a>
                                                        @endif
                                                    @endif

                                                    @if (Auth::guard('operators')->check())
                                                        <a href="{{ Route('mahasiswa.show', $item->nim) }}"
                                                            class="btn btn-info">Detail Program</a>
                                                        <a href="{{Route('detailLog',$item->nim)}}" class="btn btn-success">Lihat Log Book</a>
                                                    @endif
                                                    @if (Auth::guard('pamongs')->check())
                                                        <a href="{{ Route('mahasiswa.show', $item->user->nim) }}"
                                                            class="btn btn-info">Detail Program</a>
                                                        <a href="{{Route('detailLog',$item->user->nim)}}" class="btn btn-success">Lihat Log Book</a>
                                                    @endif
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
    <script src="{{ asset('vendor/modules/toastify-js/src/toastify.js') }}"></script>
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
