@extends('frontend.master')
@section('content')
    <section class="hero-bg shadow rounded-bottom-4 shadow">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 mb-4">
                    <h1 class="fw-bolder text-center text-light mt-4">Tentang <span class="text-warning"> Kami</span></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="py-4 bg-white">
        <div class="container mt-2">
            <div class="row justify-content-center text-start mb-4">
                <div class="col-lg-8">
                    <h3 class="fw-bolder text-dark text-start mt-4">{{$app->judul}}</h3>
                    <p class="text-muted text-start">{{$app->sub_judul}}</p>
                    <div class="card border-0 bg-transparent">
                        <div class="content mt-3" style="text-align: justify;">
                            {{$app->deskripsi_full}}
                        </div>
                       
                    </div>
                </div>
            </div>
    </section>
    <script>
        const movePageRegis = () => {
            document.location.href = '/registrasi'
        }
    </script>
@endsection
