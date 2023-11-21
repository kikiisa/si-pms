<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>REGISTRASI - SISTEM INFORMASI PMS</title>

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
                <div class="row justify-content-center">
                    <div
                        class="col-lg-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="text-center">REGISTRASI MAHASISWA</h4>
                                <hr>
                            </div>
                            <div class="card-body">
                                <form  method="POST" action="{{Route('register.store')}}">
                                    @csrf
                                    @method("POST")
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="npwp">Nim</label>
                                            <input type="text" name="nim" id="nim" class="form-control mt-2 npwp"
                                                placeholder="Nim" value="{{ old('nim') }}">
                                            
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control mt-2 npwp"
                                                placeholder="Username" value="{{ old('username') }}">
                                            
                                        </div>
                                    
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="nama">Nama Mahasiswa</label>
                                            <input type="text" name="name" id="nama" class="form-control mt-2 nama"
                                                placeholder="Nama Mahasiswa" value="{{ old('name') }}">
                                           
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" class="form-control mt-2 email"
                                                placeholder="Email" value="{{old('email')}}">
                                               
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="wa">Nomor Whatsapp</label>
                                            <input type="text" name="phone" id="wa" placeholder="Nomor Whatsapp"
                                                class="form-control mt-2 wa" value="{{old('phone')}}">
                                           
                                         </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="join">Tahun Masuk</label>
                                            <input type="date" name="tahun_masuk" class="form-control" id="join">
                                            
                                         </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">password</label>
                                        <input type="password" name="password" id="password" class="form-control mt-2 password"
                                            placeholder="password" value="">
                                            
                                    </div>
                                    <div class="form-group">
                                        <label for="konfirmasi">konfirmasi</label>
                                        <input type="konfirmasi" name="konfirmasi" id="konfirmasi" class="form-control mt-2 konfirmasi"
                                            placeholder="Konfirmasi Password" value="{{ old('konfirmasi') }}">
                                            
                                    </div>
                                  
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="term_condition" value="1" class="custom-control-input acc"
                                                id="agree">
                                            <label class="custom-control-label" for="agree"> Dengan ini saya bertanggung jawab penuh atas data diatas dan bersedia
                                                menerima
                                                konsekuensi jika ditemukan ketidaksesuaian data</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" onclick="return confirm('apakah anda yakin dengan data diatas ? jika yakin maka selanjutnya mengupload document legalitas')" class="btn btn-primary btn-lg btn-block">
                                            simpan 
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; SI-PMS @php
                                echo date('Y');
                            @endphp
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
    <script src="{{ asset('vendor/js/axios.js') }}"></script>
    <script src="{{ asset('vendor/modules/toastify-js/src/toastify.js') }}"></script>
    @if (count($errors) > 0)
        <script>
            var errors = @json($errors->all());
            Toastify({
                text: errors,
                duration: 5000,
                close: true,
                backgroundColor: "#D61355",
            }).showToast();
        </script>
    @enderror
    @if (session()->has('error'))
        <script>
            Toastify({
                text: 'Terjadi Kesalahan',
                duration: 5000,
                close: true,
                backgroundColor: "#D61355",
            }).showToast();
        </script>
    @endif
    @if (session()->has('success'))
        <script>
            Toastify({
                text: 'Registrasi Berhasil',
                duration: 5000,
                close: true,
                backgroundColor: "#20C997",
            }).showToast();
        </script>
    @endif
</body>

</html>
