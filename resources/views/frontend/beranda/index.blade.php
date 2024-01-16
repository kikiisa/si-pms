@extends('frontend.master')
@section('content')
    <!-- hero -->
    <style>
        .click{
            cursor: pointer;
        }
    </style>
    <section class="mt-4">
        <div class="container">
            <div class="row d-flex justify-content-start">
                @if ($berita->count() > 0)
                    <section class="slider container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 rounded-4">
                               
                                <div class="card border-0">
                                    <div id="carouselExampleDark" class="carousel carousel-dark slide">
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#carouselExampleDark"
                                                data-bs-slide-to="0" class="active" aria-current="true"
                                                aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#carouselExampleDark"
                                                data-bs-slide-to="1" aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#carouselExampleDark"
                                                data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        </div>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active click" onclick="location.href='{{ route('berita.detail', $berita[0]->slug) }}'" data-bs-interval="10000">
                                                <img src="{{ asset($berita[0]->image) }}"
                                                    class="d-block w-100">

                                            </div>
                                            @foreach ($berita as $sl)
                                                <div class="carousel-item click" onclick="location.href='{{ route('berita.detail', $sl->slug) }}'"">
                                                    <img src="{{ asset($sl->image) }}"
                                                        class="d-block w-100">

                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleDark" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                @else
                    <section class="slider container mb-4">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-7 col-12">
                                <div class="bg-danger p-4 rounded-4 text-light fw-bold text-center">
                                    Maaf Data Post Terbaru Belum Tersedia
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </section>
    <!-- end hero -->
    {{-- postingan --}}
    <section class="py-4">
        <div class="container mt-4">
            <div class="row justify-content-center text-start mb-4">
                <h1 class="text-center fw-bold mb-4">Berita</h1>
                @if ($berita->count() > 0)
                    @foreach ($berita as $news)
                        <div class="col-lg-4">
                            <div class="card border-0">
                                <img src="{{ asset($news->image) }}" class="card-img-top" alt="{{ $news->title }}"
                                    srcset="">
                                <div class="card-body">
                                    <p class="fw-bold fs-5">{{ $news->title }}</p>
                                    <p class="text-muted">
                                        {{ \Carbon\Carbon::parse($news->created_at)->format('l / d / Y') }}
                                    </p>
                                    <a href="{{ Route('berita.detail', $news->slug) }}" class="btn btn-primary mt-2">Lihat
                                        Berita</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $berita->links() }}
                @else
                    <div class="col-lg-4">
                        <div class="bg-danger p-4 rounded-4 text-white text-center">
                            Tidak ada berita tersedia
                        </div>
                    </div>
                @endif
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
                                            <div class="p-4 bg-danger rounded-4 text-white text-center fw-bold">Belum Ada
                                                Informasi
                                            </div>
                                        @else
                                            <form method="get">
                                                <div class="input-group mb-3">
                                                    <button class="btn btn-dark input-group-text" id="basic-addon1"><i
                                                            class="fa fa-search"></i></button>
                                                    <input name="post" type="text" class="form-control"
                                                        placeholder="Search" aria-label="search"
                                                        aria-describedby="basic-addon1">
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
                                        <td><a href="{{ asset($pengaturan->petunjuk) }}" class="btn btn-primary"><i
                                                    class="fa fa-download"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>SK Rektor tentang Panitia, DPL, Kepsek dan Guru Pamong PMS </td>
                                        <td><a href="{{ asset($pengaturan->sk_rektor) }}" class="btn btn-primary"><i
                                                    class="fa fa-download"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Format Rancangan Kegiatan</td>
                                        <td><a href="{{ asset($pengaturan->format_rancangan) }}"
                                                class="btn btn-primary"><i class="fa fa-download"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Format Laporan Akhir Program PMS</td>
                                        <td><a href="{{ asset($pengaturan->format_laporan_akhir) }}"
                                                class="btn btn-primary"><i class="fa fa-download"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Format Laporan Mata Kuliah</td>
                                        <td><a href="{{ asset($pengaturan->format_laporan_mata_kuliah) }}"
                                                class="btn btn-primary"><i class="fa fa-download"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Surat Pernyataan</td>
                                        <td><a href="{{ asset($pengaturan->surat_pernyataan) }}"
                                                class="btn btn-primary"><i class="fa fa-download"></i></a></td>
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
<script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
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
