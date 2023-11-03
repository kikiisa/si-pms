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
                                <button class="btn btn-primary" onclick="return sk_rektor()"><i class="fa fa-download"></i> SK REKTOR</button>
                                <a href="{{asset($data->surat_pernyataan)}}" class="btn btn-success"><i class="fa fa-download"></i> SURAT PERNYATAAN</a>
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
        <div class="modal fade" id="sk_rektor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">SK REKTOR</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @isset($data->sk_rektor)
                        <iframe src="{{asset($data->sk_rektor)}}" width="100%" height="600px"></iframe>
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
    </section>
    <script>
          const sk_rektor    = () => {
            $('#sk_rektor').appendTo("body").modal('show');
        }
    </script>
@endsection
