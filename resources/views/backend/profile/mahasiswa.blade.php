@extends('backend.layout.master', ['title' => 'Profile']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
        </div>
        @if (Auth::check())
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-3">
                        <form action="{{Route('profile.image',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            @isset(Auth::user()->profile)
                                <div class="card">
                                    <img src="{{ asset(Auth::user()->profile)}}" class="card-img-top"
                                        alt="" srcset="">
                                </div>
                            @else
                                <div class="card">
                                    <img src="{{ asset('vendor/img/avatar/avatar-1.png') }}"alt="" class="card-img-top"
                                        srcset="">
                                </div>
                            @endisset
                            <input type="file" name="profile" class="form-control-file">
                            <button class="btn btn-primary mt-3 w-100">update</button>
                        </form>
                        
                    </div>
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{Route('profile.update',Auth::user()->id)}}" method="post">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group">
                                        <label for="">Nim</label>
                                        <input type="text" class="form-control bg-transparent"
                                            value="{{ Auth::user()->nim }}" name="nim">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Pengguna</label>
                                        <input type="text" class="form-control bg-transparent"
                                            value="{{ Auth::user()->username }}" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nama Lengkap</label>
                                        <input type="text" class="form-control bg-transparent"
                                            value="{{ Auth::user()->name }}" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email </label>
                                        <input type="text" class="form-control bg-transparent"
                                            value="{{ Auth::user()->email }}" name="email">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="">Nomor Telepon </label>
                                            <input type="text" class="form-control bg-transparent"
                                                value="{{ Auth::user()->phone }}" name="phone">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="">Angkatan</label>
                                            <input type="date" name="tahun_masuk" class="form-control bg-transparent"
                                                value="{{Auth::user()->tahun_masuk}}"
                                            >
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="">Password Baru</label>
                                        <input class="form-control" type="password" name="new"
                                            placeholder="Masukan Password Baru">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password Konfirmasi</label>
                                        <input class="form-control" type="password" name="confirm"
                                            placeholder="Masukan Password Baru">
                                        <small class="text-info mt-2">Kosongkan Jika Tidak Ingin Di Ubah</small>
                                    </div>
                                    <button class="btn btn-primary w-25">simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
    <script src="{{ asset('vendor/modules/toastify/src/toastify.js') }}"></script>
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
    @if (session()->has('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                backgroundColor: "#19C37D",
            }).showToast();
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                close: true,
                backgroundColor: "#D61355",
            }).showToast();
        </script>
    @endif
@endsection
