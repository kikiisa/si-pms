<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('vendor/modules/bootstrap/css/bootstrap.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('vendor/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/modules/weather-icon/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/modules/weather-icon/css/weather-icons-wind.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/modules/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('vendor/leaflet/leaflet.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('vendor/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/modules/summernote/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/modules/toastify-js/src/toastify.css')}}">
    <!-- CSS Libraries -->
   
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/components.css') }}">
    <script src="{{ asset('vendor/js/jquery-3.6.0.min.js')}}"></script>
</head>
<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('backend.layout.header')
            <div class="main-sidebar sidebar-style-2">
                @include('backend.layout.sidebar')
            </div>
            <!-- Main Content -->
            <div class="main-content">
               @yield('content')
            </div>
           @include('backend.layout.footer')
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('vendor/modules/jquery.min.js')}}"></script>
    <script src="{{ asset('vendor/modules/popper.js')}}"></script>
    <script src="{{ asset('vendor/modules/tooltip.js')}}"></script>
    <script src="{{ asset('vendor/modules/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('vendor/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{ asset('vendor/modules/moment.min.js')}}"></script>
    <script src="{{ asset('vendor/js/stisla.js')}}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('vendor/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
    <script src="{{ asset('vendor/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
    <script src="{{ asset('vendor/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{ asset('vendor/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
    <script src="{{ asset('vendor/modules/datatables/datatables.min.js')}}"></script>
    {{-- <script src="{{ asset('vendor/modules/upload-preview/js/jquery.uploadPreview.min.js')}}"></script> --}}
    <script src="{{ asset('vendor/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('vendor/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    <script src="{{ asset('vendor/modules/summernote/summernote-bs4.js')}}"></script>
    <script src="{{ asset('vendor/modules/summernote/summernote.min.js')}}"></script>
    <script src="{{ asset('vendor/modules/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{ asset('vendor/js/scripts.js')}}"></script>
    <script src="{{ asset('vendor/js/custom.js')}}"></script>
    <script>
       $(document).ready(function() {
            $('#deskripsi').summernote({
                    height: 200,
            });          
        });
    </script>
    {{-- <script src="{{ asset('vendor/js/page/modules-chartjs.js')}}"></script> --}}
</body>

</html>