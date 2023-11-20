@extends('backend.layout.master', ['title' => 'Edit Berita']);
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Berita</h1>
        </div>
        <div class="section-body">
            <div class="row">
                
                <div class="col-lg-12">
                    <div class="card">
                        <img src="{{ asset($data->image) }}" alt="" srcset="" class="card-img-top">
                        <div class="card-body">
                            <form action="{{ Route('berita.update', $data->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Judul Berita</label>
                                    <input type="text" value="{{ $data->title }}" placeholder="Judul Berita"
                                        name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Content</label>
                                    <textarea name="content" id="deskripsi">{{ $data->content }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Cover</label>
                                    <input type="file" name="image" id="image" class="form-control-file">
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
        const openModal = () => {
            $('#add').appendTo("body").modal('show');
        }
    </script>
@endsection
