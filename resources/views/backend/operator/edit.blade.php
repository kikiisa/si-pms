@extends('backend.layout.master', ['title' => 'Master Operator']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Operator</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{Route('operator.update',$data->id)}}"  method="post">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label for="username" id="username">Username</label>
                                    <input name="username" type="text" id="username" value="{{$data->username}}" placeholder="Username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="name" id="name">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" value="{{$data->name}}" placeholder="Nama Lengkap" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" value="{{$data->email}}" name="email" placeholder="Email" id="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="new" placeholder="Password" id="password" class="form-control">
                                    <small class="text-info">Kosongkan Jika Tidak Ingin Di Update</small>
                                </div>
                                <div class="form-group">
                                    <label for="confirm">Konfirmasi</label>
                                    <input type="password" name="confirm" placeholder="Konfirmasi Password" id="confirm" class="form-control">
                                </div>
                                <button class="btn btn-primary">simpan</button>
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
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const themeOptions = document.body.classList.contains("theme-dark") ? {
                skin: "oxide-dark",
                content_css: "dark",
            } : {
                skin: "oxide",
                content_css: "default",
            }

            tinymce.init({
                selector: "#deskripsi",
                ...themeOptions
            })
            tinymce.init({
                selector: "#dark",
                toolbar: "undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code",
                plugins: "code",
                ...themeOptions,
            })
        })
    </script>
    <script>
        const openModal = () => {
            $('#add').appendTo("body").modal('show');
        }
    </script>
@endsection
