@extends('backend.layout.master', ['title' => 'Master Dosen']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Daftar Dosen</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <button class="mb-4 btn btn-primary" onclick="return openModal()">Tambah Dosen</button>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>Roles</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{$loop->index+=1}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->email}}</td>
                                                <td class="text-uppercase"><span class="badge bg-info fw-bold text-light">{{$item->roles}}</span></td>
                                                <td>
                                                    <form action="{{Route('dosen.destroy',$item->id)}}" method="post">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button class="btn btn-danger" onclick="return confirm('apakah anda ingin menghapus ? data ini konsekuensi nya sangat besar')">Hapus</button>
                                                        <a href="{{Route('dosen.edit',$item->uuid)}}" class="btn btn-warning">Edit</a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Dosen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{Route('dosen.store')}}"  method="post">
                            @csrf
                            @method("POST")
                            <div class="form-group">
                                <label for="nip" id="nip">NIP</label>
                                <input name="uuid" type="text" id="nip" value="{{old('nip')}}" placeholder="NIP" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username" id="username">Username</label>
                                <input name="username" type="text" id="username" value="{{old('username')}}" placeholder="Username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="name" id="name">Nama Lengkap</label>
                                <input type="text" id="name" name="name" value="{{old('name')}}" placeholder="Nama Lengkap" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" value="{{old('email')}}" name="email" placeholder="Email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="roles" id="roles" class="form-control">
                                    <option value="">Pilih Kategori Dosen</option>
                                    <option value="mk">Dosen Mata Kuliah</option>
                                    <option value="dpl">Dosen Pembimbing Lapangan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">password</label>
                                <input type="password" name="password" placeholder="Password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="confirm">Konfirmasi</label>
                                <input type="password" name="confirm" placeholder="Konfirmasi Password" id="confirm" class="form-control">
                            </div>
                            <button class="btn btn-primary">simpan</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
