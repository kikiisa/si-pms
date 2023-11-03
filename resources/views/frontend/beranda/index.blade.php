@extends('frontend.master')
@section('content')
    <!-- hero -->
    <section class="hero-bg shadow rounded-bottom-4 shadow">
        <div class="container">
            <div class="row d-flex justify-content-start">
                <div class="col-lg-6">
                    <h1 class="fw-bolder text-light mt-4">{{$app->judul}}</h1>
                    <p class="text-light">{{$app->sub_judul}}</p>
                    <button onclick="return movePageRegis()" class="btn btn-light custom-button fw-bold shadow mb-3"><span class="ms-2">Daftar
                            Sekarang</span></button>
                </div>

                <div class="col-lg-6">
                    <img src="{{asset('theme/images/bg.png')}}" class="responsive-img" alt="" srcset="">
                </div>
            </div>
        </div>
    </section>
    <!-- end hero -->

    <!-- statistik -->
    <section class="py-4 rounded-4" id="statistik">
        <div class="container mt-4">
            <div class="row justify-content-center text-center mb-4">
                <h4 class="fw-bold fs-1 text-center">Statistik</h4>
                <div class="col-lg-2 col-4 mt-4">

                    <div class="bg-blue text-light p-4 rounded-4 shadow">
                        <h1 class="fw-bold">{{$total_mahasiswa}}</h1>
                        <p>MAHASISWA</p>
                    </div>
                </div>
                <div class="col-lg-2 col-4 mt-4">
                    <div class="bg-blue text-light p-4 rounded-4 shadow">
                        <h1 class="fw-bold">{{$dpl}}</h1>
                        <p>DPL</p>
                    </div>

                </div>
                <div class="col-lg-2 col-4 mt-4">
                    <div class="bg-blue text-light p-4 rounded-4 shadow">
                        <h1 class="fw-bold">{{$pamongs}}</h1>
                        <p>PAMONG</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-4">
        <div class="container mt-4">
            <div class="row justify-content-center text-start mb-4">
                <h1 class="text-center fw-bold">Papan Informasi</h1>
                <div class="col-lg-12 mt-4">
                    <div class="card border-0">
                        <div class="card-header bg-blue">

                        </div>
                        <div class="card-body">
                            <div class="table-responsive w-100">
                                @if($post->count() < 0))
                                    <div class="p-4 bg-danger rounded-4 text-white text-center fw-bold">Belum Ada Informasi</div>
                                @else
                                    <form  method="get">
                                        <div class="input-group mb-3">
                                            <button class="btn btn-dark input-group-text" id="basic-addon1"><i class="fa fa-search"></i></button>
                                            <input name="post" type="text" class="form-control" placeholder="Search" aria-label="search" aria-describedby="basic-addon1">
                                        </div>  
                                    </form>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Judul Informasi</th>
                                                <th>Waktu</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($post as $item)
                                                <tr>
                                                    <td>{{$loop->index+=1}}</td>
                                                    <td>{{$item->title}}</td>
                                                    <td>{{$item->created_at->diffForHumans()}}</td>
                                                    <td><a href="{{Route('post.detail',$item->slug)}}" class="btn btn-dark">Detail</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$post->links()}}
                                @endempty
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-4">
        <div class="container mt-4">
            <div class="row justify-content-center text-start mb-4">
                <h1 class="text-center fw-bold">Tentang Kami</h1>
                <div class="col-lg-12 mt-3">
                    <div class="card border-0">
                        <div class="card-header bg-blue">

                        </div>
                        <div class="card-body">
                            <h2 class="fw-bold text-center">{{$app->title}}</h2>
                            <div class="content" style="text-align: justify">
                                {!! $app->deskripsi_full !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const movePageRegis = () => 
        {
            document.location.href = '/registrasi'
        }
    </script>
    <!-- endstatistik -->
@endsection