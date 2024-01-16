<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>LOGIN - SISTEM INFORMASI PMS</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('vendor/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('vendor/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/modules/toastify-js/src/toastify.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/components.css') }}">
</head>
<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary" style="margin-top: 30px">
                            <div class="card-header">
                                <div class="row justify-content-center">
                                    <img class="text-center" src="https://alwin-pms.netlify.app/public/images/mbkm.png" width="90" alt=""
                                        srcset="">
                                    <h4 class="ms-4 text-center mt-2">SISTEM INFORMASI <br>PROGRAM MENGAJAR SEKOLAH </h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{Route('auth.store')}}" class="needs-validation"
                                    novalidate="">
                                    @csrf
                                    @method("POST")
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input id="username" name="username" type="username" class="form-control" name="username"
                                            placeholder="Enter username" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your username
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select name="role" id="role" required autofocus class="form-control">
                                            <option value="">Pilih Role</option>
                                            <option value="mahasiswa">Mahasiswa</option>
                                            <option value="dpl">Dosen</option>
                                            <option value="pamong">Pamong</option>
                                            <option value="operator">Operator</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please fill in your role
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="float-right">
                                                <a href="{{Route('forgotPassword.store')}}" class="text-small">
                                                    Forgot Password?
                                                </a>
                                            </div>
                                        </div>
                                        <input id="password" placeholder="Enter Password" type="password"
                                            class="form-control" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                        <p class="mt-2">Sudah Punya Account ? <a href="{{Route('register')}}">Registrasi</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
    <script src="{{ asset('vendor/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/modules/popper.js') }}"></script>
    <script src="{{ asset('vendor/modules/tooltip.js') }}"></script>
    <script src="{{ asset('vendor/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('vendor/modules/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/js/stisla.js') }}"></script>
    <script src="{{ asset('vendor/js/scripts.js') }}"></script>
    <script src="{{ asset('vendor/js/custom.js') }}"></script>
    <script src="{{ asset('vendor/modules/toastify-js/src/toastify.js') }}"></script>
    @if (count($errors) > 0)
        <script>
            var errors = @json($errors->all());
            Toastify({
                text: errors,
                duration: 3000,
                close: true,
                backgroundColor: "#D61355",
            }).showToast();
        </script>
    @enderror
    @if (session()->has('error'))
        <script>
            Toastify({
                text: 'Maaf Anda Harus Login Terlebih Dahulu',
                duration: 3000,
                close: true,
                backgroundColor: "#D61355",
            }).showToast();
        </script>
    @endif
    @if (session()->has('success'))
        <script>
            Toastify({
                text: '{{ session('success') }}',
                duration: 3000,
                close: true,
                backgroundColor: "#20C997",
            }).showToast();
        </script>
    @endif
</body>

</html>
