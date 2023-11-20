@extends('frontend.master')
@section('content')
    <!-- hero -->
    <section class="hero-bg shadow rounded-bottom-4 shadow">
        <div class="container">
            <div class="row d-flex justify-content-start">
                <div class="col-lg-6">
                    <h1 class="fw-bolder text-light mt-4">{{ $app->judul }}</h1>
                    <p class="text-light">{{ $app->sub_judul }}</p>
                    <button onclick="return movePageRegis()" class="btn btn-light custom-button fw-bold shadow mb-3"><span
                            class="ms-2">Daftar
                            Sekarang</span></button>
                </div>

                <div class="col-lg-6">
                    <img src="{{ asset('theme/images/bg.png') }}" class="responsive-img" alt="" srcset="">
                </div>
            </div>
        </div>
    </section>
    <!-- end hero -->
    {{-- postingan --}}
    <section class="py-4">
        <div class="container mt-4">
            <div class="row justify-content-start text-start mb-4">
                <h1 class="text-center fw-bold mb-4">Berita Terbaru</h1>
                @foreach ($berita as $news)
                    <div class="col-lg-4">
                        <div class="card border-0">
                            <img src="{{ asset($news->image) }}" class="card-img-top" alt="{{ $news->title }}"
                                srcset="">
                            <div class="card-body">
                                <p class="fw-bold fs-5">{{ $news->title }}</p>
                                <p class="text-muted">{{ \Carbon\Carbon::parse($news->created_at)->format('l / d / Y') }}
                                </p>
                                <a href="{{ Route('berita.detail', $news->slug) }}" class="btn btn-primary mt-2">Lihat
                                    Berita</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $berita->links() }}
            </div>
        </div>
    </section>
    {{-- endpostingan --}}
    <!-- statistik -->
    <section class="py-4 rounded-4" id="statistik">
        <div class="container mt-4">
            <div class="row justify-content-center text-center mb-4">
                <h4 class="fw-bold fs-1 text-center">Statistik</h4>
                <div class="col-lg-2 col-4 mt-4">

                    <div class="bg-blue text-light p-4 rounded-4 shadow">
                        <h1 class="fw-bold">{{ $total_mahasiswa }}</h1>
                        <p>MAHASISWA</p>
                    </div>
                </div>
                <div class="col-lg-2 col-4 mt-4">
                    <div class="bg-blue text-light p-4 rounded-4 shadow">
                        <h1 class="fw-bold">{{ $dpl }}</h1>
                        <p>DPL</p>
                    </div>

                </div>
                <div class="col-lg-2 col-4 mt-4">
                    <div class="bg-blue text-light p-4 rounded-4 shadow">
                        <h1 class="fw-bold">{{ $pamongs }}</h1>
                        <p>PAMONG</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-4" id="informasi">
        <div class="container mt-4">
            <h1 class="text-center fw-bold">Papan Informasi</h1>
            <div class="row justify-content-center text-start mb-4">
                <div class="col-lg-12 mt-4">
                    <div class="card border-0">
                        <div class="card-header bg-blue">

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h3 class="fw-bold">Informasi</h3>
                                    <hr>
                                    <div class="table-responsive w-100">
                                        @if ($post->count() < 0))
                                            <div class="p-4 bg-danger rounded-4 text-white text-center fw-bold">Belum Ada Informasi
                                            </div>
                                        @else
                                            <form method="get">
                                                <div class="input-group mb-3">
                                                    <button class="btn btn-dark input-group-text" id="basic-addon1"><i
                                                            class="fa fa-search"></i></button>
                                                    <input name="post" type="text" class="form-control" placeholder="Search"
                                                        aria-label="search" aria-describedby="basic-addon1">
                                                </div>
                                            </form>
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Judul Informasi</th>
        
                                                        <th>Detail</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($post as $item)
                                                        <tr>
                                                            <td>{{ $loop->index += 1 }}</td>
                                                            <td>{{ $item->title }}</td>
        
                                                            <td><a href="{{ Route('post.detail', $item->slug) }}"
                                                                    class="btn btn-dark">Detail</a></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{ $post->links() }}
                                        @endempty
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h3 class="fw-bold">Download File</h3>
                                    <hr>
                                    <table class="table">
                                        <tr>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>Petunjuk Teknis Pelaksanaan Kegiatan PMS MBKM</td>
                                            <td><a href="{{asset($pengaturan->petunjuk)}}" class="btn btn-primary"><i class="fa fa-download"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>SK Rektor tentang Panitia, DPL, Kepsek dan Guru Pamong PMS </td>
                                            <td><a href="{{asset($pengaturan->sk_rektor)}}" class="btn btn-primary"><i class="fa fa-download"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Format Rancangan Kegiatan</td>
                                            <td><a href="{{asset($pengaturan->format_rancangan)}}" class="btn btn-primary"><i class="fa fa-download"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Format Laporan Akhir Program PMS</td>
                                            <td><a href="{{asset($pengaturan->format_laporan_akhir)}}" class="btn btn-primary"><i class="fa fa-download"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Format Laporan Mata Kuliah</td>
                                            <td><a href="{{asset($pengaturan->format_laporan_mata_kuliah)}}" class="btn btn-primary"><i class="fa fa-download"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>Surat Pernyataan</td>
                                            <td><a href="{{asset($pengaturan->surat_pernyataan)}}" class="btn btn-primary"><i class="fa fa-download"></i></a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-4" id="tentang">
    <div class="container mt-4">
        <div class="row justify-content-center text-start mb-4">
            <h1 class="text-center fw-bold">Tentang Kami</h1>
            <div class="col-lg-12 mt-3">
                <div class="card border-0">
                    <div class="card-header bg-blue">

                    </div>
                    <div class="card-body">
                        <h2 class="fw-bold text-center">{{ $app->title }}</h2>
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
    const movePageRegis = () => {
        document.location.href = '/registrasi'
    }

    const scrollInformasi = document.querySelector("#scrollInformasi");
    const scrollTentang = document.querySelector("#scrollTentang");

    scrollInformasi.addEventListener("click", function(event) {
        event.preventDefault(); // Mencegah tindakan default dari tautan

        // Ambil elemen div target
        var targetDiv = document.getElementById("informasi");

        // Gulirkan ke posisi div target menggunakan smooth scroll behavior
        targetDiv.scrollIntoView({
            behavior: "smooth"
        });
    });

    scrollTentang.addEventListener("click", function(event) {
        event.preventDefault(); // Mencegah tindakan default dari tautan

        // Ambil elemen div target
        var targetDiv = document.getElementById("tentang");

        // Gulirkan ke posisi div target menggunakan smooth scroll behavior
        targetDiv.scrollIntoView({
            behavior: "smooth"
        });
    });
</script>
<!-- endstatistik -->
@endsection
