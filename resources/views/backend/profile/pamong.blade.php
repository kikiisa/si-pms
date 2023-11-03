@extends('backend.layout.master', ['title' => 'Profile']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{Route('profile.update',Auth::guard('pamongs')->user()->id)}}" method="post">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input placeholder="Masukan Username" type="text" name="username" value="{{ Auth::guard('pamongs')->user()->username }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input placeholder="Masukan Nama Lengkap" type="text" name="name" value="{{ Auth::guard('pamongs')->user()->name }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input placeholder="Masukan Nama Lengkap" type="email" name="email" value="{{ Auth::guard('pamongs')->user()->email }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Asal Sekolah</label>
                                    <input placeholder="Masukan Nama Lengkap" type="text" name="asal_sekolah" value="{{ Auth::guard('pamongs')->user()->asal_sekolah }}" class="form-control">
                                </div>
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
