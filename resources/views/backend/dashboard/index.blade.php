@extends('backend.layout.master', ['title' => 'Dashboard']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        @if (Auth::check())
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <button class="btn btn-primary"><i class="fa fa-download"></i> SK REKTOR</button>
                                <button class="btn btn-success"><i class="fa fa-download"></i> SURAT PERNYATAAN</button>
                                <button class="btn btn-outline-dark"><i class="fa fa-download"></i> PEDOMAN PMS</button>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        @isset(Auth::user()->profile)
                            <div class="card">
                                <img src="{{ asset(Auth::user()->profile) }}" class="card-img-top" alt="" srcset="">
                            </div>
                        @else
                            <div class="card">
                                <img src="{{ asset('vendor/img/avatar/avatar-1.png') }}"alt="" class="card-img-top" srcset="">
                                
                            </div>     
                        @endisset
                       
                    </div>
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nim</label>
                                    <input type="text" class="form-control bg-transparent" value="{{ Auth::user()->nim }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control bg-transparent" value="{{ Auth::user()->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Email </label>
                                    <input type="text" class="form-control bg-transparent" value="{{ Auth::user()->email }}" disabled>
                                </div>
                                <div class="form-group">
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="">Nomor Telepon </label>
                                        <input type="text" class="form-control bg-transparent" value="{{ Auth::user()->phone }}" disabled>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="">Angkatan</label>
                                        <input type="text" class="form-control bg-transparent" value="{{ \Carbon\Carbon::parse(Auth::user()->tahun_masuk)->format('Y') }}" disabled>
                                    </div>
                                </div>
                               
                            </div>
                        </div>        
                    </div>
                  
                </div>    
            </div>
        @endif
    </section>
@endsection
