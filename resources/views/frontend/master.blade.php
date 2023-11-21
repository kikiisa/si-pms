<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('theme/css/bootstrap.min.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Poppins:ital,wght@0,100;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendor/fontawesome/css/brands.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendor/fontawesome/css/regular.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendor/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/style.css')}}">
    <title>{{$app->title}}</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-blue-gardient">
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
                <ul class="navbar-nav ml-auto">
                    <!-- Tambahkan kelas ml-auto di sini -->
                    <li class="nav-item">
                    <li class="nav-item">
                        <a class="nav-link text-light fw-bold"  aria-current="page" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light fw-bold" id="scrollTentang" href="#tentang">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light fw-bold" id="scrollInformasi" href="#informasi">Informasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light fw-bold" id="scrollInformasi" href="#informasi">Berita</a>
                    </li>
                    @if (Auth::guard('operators')->check() || Auth::guard('dpls')->check() || Auth::guard('pamongs')->check() || Auth::check())
                        <a href="{{route('dashboard')}}" class="btn btn-light rounded-2 ms-3">
                            <span>Dashboard</span><i class="fa fa-arrow-right ms-2"></i>
                        </a>
                    @else
                        <a href="{{route('auth')}}" class="btn btn-light rounded-2 ms-3">
                            <span>Masuk Ke Akun</span><i class="fa fa-arrow-right ms-2"></i>
                        </a>
                    @endif
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
                    <p class="text-light">{{$app->sub_judul}}</p>
                    <img src="{{asset('theme/images/mbkm.png')}}" width="100" alt="" srcset="">
                    <img src="{{asset('theme/images/ung.png')}}" class="ms-3" width="60" alt="" srcset="">
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
                <div class="col-lg-4">
                    <h4 class="text-light">Maps</h4>
                    <div class="card border-0">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63833.58990190094!2d123.00039768218996!3d0.6002566680890935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32792cd61bd05eeb%3A0x7aedffc6676ca051!2sDinas%20Perhubungan%2C%20Pariwisata%2C%20dan%20Kominfo%20Provinsi%20Gorontalo!5e0!3m2!1sen!2sid!4v1699704738996!5m2!1sen!2sid" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <p class="text-center text-light  mt-4">Copyright {{date('Y')}} <span class="text-warning fw-bold">FakultasTeknik Universitas Negeri Gorontalo</span>. All Rights Reserved</p>
            </div>
        </div>
    </footer>
    <!-- endfooter -->
    <script src="{{ asset('theme/vendor/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/fontawesome/js/brands.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/fontawesome/js/regular.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/fontawesome/js/fontawesome.min.js') }}"></script>
    <script src="{{asset('theme/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>