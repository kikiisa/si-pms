<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('theme/css/bootstrap.min.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme/style.css')}}">
    <title>Universitas Negeri Gorontalo | MBMKM Merdeka Belajar</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark shadow">
        <div class="container">
            <a class="navbar-brand fw-bold text-light" href="#">
                <img class="ms-3" src="{{asset('theme/images/logo.webp')}}" width="60">
                <img class="ms-3" src="{{asset('theme/images/pendidikan.webp')}}" width="40">
                <img class="ms-3" src="{{asset('theme/images/ung.png')}}" width="40">
            </a>
            <button class="navbar-toggler border-0 text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-list"></span>
              </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <ul class="navbar-nav ml-auto"> <!-- Tambahkan kelas ml-auto di sini -->
                    <li class="nav-item">
                        <li class="nav-item">
                            <a class="nav-link text-light fw-bold" aria-current="page" href="#">Beranda</a>
                        </li>
                        <a href="{{Route('auth')}}" class="btn btn-light rounded-5 ms-3 fw-bold shadow">
                            <i class="fa fa-user"></i><span class="ms-2 fw-bold">Masuk Ke Akun</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    {{-- body --}}
    @yield('content')
    {{-- endbody --}}
    <!-- footer -->
    <footer class="bg-dark">
        <div class="container">
            <div class="row p-4">
                <div class="col-lg-6 mb-4">
                    <h1 class="fw-bold text-light">SI-PMS</h1>
                    <p class="text-light">Merupakan aplikasi berbasis web yang bertujuan untuk membantu pengelolaan Kegiatan Program Mengajar di Sekolah dI Prodi Pendidiken Teknologi Informasi Universitas Negeri Gorontalo.</p>
                    <img src="/public/images/mbkm.png" width="100" alt="" srcset="">
                    <img src="/public/images/ung.png" class="ms-3" width="60" alt="" srcset="">
                </div>
                <div class="col-lg-2 text-light">
                    <h6>Social Media</h6>
                    <hr>
                    <p><a class="social" href="#"><i class="fa-brands fa-facebook"></i></a><span
                            class="ms-2">Facebook</span></p>
                    <p><a class="social" href="#"><i class="fa-brands fa-instagram"></i></a><span
                            class="ms-2">Instagram</span></p>
                    <p><a class="social" href="#"><i class="fa-brands fa-twitter"></i></a><span
                            class="ms-2">Twiter</span></p>
                    <p><a class="social" href="#"><i class="fa-brands fa-youtube"></i></a><span
                            class="ms-2">Youtube</span></p>
                </div>
                <div class="col-12 text-light text-center">
                    @copyright Alwin Manapu 2023
                </div>
            </div>
        </div>
    </footer>
    <!-- endfooter -->
    <script src="{{asset('theme/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>