@extends('frontend.master')
@section('content')
    <!-- hero -->
    <section class="hero-bg shadow rounded-bottom-4 shadow">
        <div class="container">
            <div class="row d-flex justify-content-start">
                <div class="col-lg-8">
                    <h1 class="fw-bolder text-light mt-4">Ambil Kendali Masa Depanmu</h1>
                    <p class="text-light">Kampus Merdeka adalah cara terbaik berkuliah.
                        Dapatkan kemerdekaan untuk membentuk masa depan yang
                        sesuai dengan aspirasi kariermu.</p>
                </div>
                <div class="col-lg-6">
                    <button onclick="return movePageRegis()" class="btn btn-primary custom-button fw-bold shadow mb-3"><span
                            class="ms-2">Daftar Sekarang</span></button>
                </div>

            </div>
        </div>
    </section>
    <!-- end hero -->

    <!-- statistik -->
    <section class="py-4" id="statistik">
        <div class="container mt-4">
            <div class="row justify-content-center text-center mb-4">
                <h4 class="fw-bold fs-1 text-center">Statistik</h4>
                <div class="col-lg-2 mt-4">
                    <h1>{{$total_mahasiswa}}</h1>
                    <p class="text-muted">MAHASISWA</p>
                </div>
                <div class="col-lg-2 mt-4">
                    <h1>{{$dpl}}</h1>
                    <p class="text-muted">DPL</p>
                </div>
                <div class="col-lg-2 mt-4">
                    <h1>{{$pamongs}}</h1>
                    <p class="text-muted">PAMONG</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-4">
        <div class="container mt-4">
            <div class="row justify-content-center text-start mb-4">
                <div class="col-lg-6 col-12">
                    <h1 class="fw-bold">Kampus Merdeka</h1>
                    Mengajar di Sekolah merupakan salah satu bentuk BKP MB-KM yang
membuka kesempatan kepada mahasiswa untuk belajar secara langsung dari dunia nyata dengan mempraktikkan belajar melalui pengalaman (experiential learning).
                    </p>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="card bg-transparent border-0">
                        <img src="https://kampusmerdeka.kemdikbud.go.id/static/media/library.84ee2daf.webp"
                            class="rounded-4" alt="" srcset="">
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