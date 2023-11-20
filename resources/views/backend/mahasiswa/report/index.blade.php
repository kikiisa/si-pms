@extends('backend.layout.master', ['title' => 'Log Book']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Laporan Akhir Dan Umum</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                        @if($data->count() > 0)
                            @if ($data->first()->status == 0)
                                <div class="p-4 bg-danger text-center text-light">Maaf Program Kegiatan Anda Belum Di Setujui Oleh Pamong</div>     
                            @else
                                <form action="{{Route('tambahLaporan')}}" method="post" enctype="multipart/form-data">
                                    @php
                                        $sisa_hari = $service->totalHari(\Carbon\Carbon::today(), $data->first()->waktu_berakhir);
                                    @endphp
                                    @csrf
                                    @method("POST")
                                    @if ($sisa_hari < 0 || $sisa_hari == 0)
                                        <div class="form-group">
                                            <label for="laporan">Upload Laporan Akhir Individu</label>
                                            <input type="file" name="laporan_akhir" id="laporan" class="form-control-file">
                                        </div>
                                        <div class="form-group">
                                            <label for="laporan">Upload Laporan Umum</label>
                                            <input type="file" name="laporan_umum" id="laporan" class="form-control-file">
                                        </div>
                                        <button class="btn btn-primary">upload</button>
                                    @else
                                        <div class="bg-danger p-4 rounded-4 text-center text-light">Sisa hari : {{ $sisa_hari < 0 ? '0' : $sisa_hari }} Hari</div></div>
                                    @endif
                                </form>
                            @endif
                        @else
                            <div class="p-4 bg-danger text-center text-light">Maaf Belum Mendapatlan Pamong Dan DPL</div>    
                        @endempty
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

