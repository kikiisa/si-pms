@extends('backend.layout.master', ['title' => 'Dashboard']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="mt-4 fa fa-user fa-2x text-light"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Mahasiswa PMS</h4>
                            </div>
                            <div class="card-body">
                                {{ $program }} Mahasiswa
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">

                    <div class="card">
                        <img src="{{ asset('vendor/img/avatar/avatar-1.png') }}"alt="" class="card-img-top" srcset="">

                    </div>

                </div>
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" class="form-control bg-transparent"
                                    value="{{ Auth::guard('dpls')->user()->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Email </label>
                                <input type="text" class="form-control bg-transparent"
                                    value="{{ Auth::guard('dpls')->user()->email }}" disabled>
                            </div>
                            <div class="form-group">

                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label for="">Jabatan</label>
                                    <input type="text" class="form-control bg-transparent"
                                        value="{{ Auth::guard('dpls')->user()->roles == "mk" ? "Dosen Mata Kuliah" : "Dosem Pembimbing Lapangan" }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
