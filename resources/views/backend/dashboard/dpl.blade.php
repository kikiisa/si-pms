@extends('backend.layout.master', ['title' => 'Dashboard']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="section-body">
            <div class="row">
                @if (Auth::guard('dpls')->user()->roles == 'mk')
                <div class="col-lg-6">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="mt-4 fa fa-user fa-2x text-light"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Jumlah Mahasiswa PMS</h4>
                            </div>
                            <div class="card-body">
                               {{$program}} Mahasiswa
                            </div>
                        </div>
                    </div>
                </div>  
                @endif
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Selamat Datang, <strong>{{Auth::guard('dpls')->user()->name}}</strong></h5>
                            <hr>
                            <h6>Jabatan : <strong>Dosen <span class="text-uppercase">{{Auth::guard('dpls')->user()->roles}}</span></strong></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
