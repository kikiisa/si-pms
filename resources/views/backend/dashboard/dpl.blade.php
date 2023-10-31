@extends('backend.layout.master', ['title' => 'Dashboard']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-8">
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
