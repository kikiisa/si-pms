@extends('frontend.master')
@section('content')
    <section class="py-4 rounded-4" id="news">
        <div class="container mt-4">
            <div class="row justify-content-center text-center mb-4">
                <div class="col-lg-8" style="text-align: justify;">
                    <div class="card border-0">
                        <div class="card-img-top">
                            <img src="{{ asset($data->image)}}" class="card-img-top" alt="{{$data->title}}" srcset="">
                        </div>
                        <div class="card-body">
                            <h1 class="fw-bolder text-dark text-start">{{$data->title}}</h1>
                            <p class="text-muted"><i class="fa fa-clock"></i><span class="ms-2">{{$data->created_at->diffForHumans()}}</span></p>
                            {!! $data->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const movePageRegis = () => {
            document.location.href = '/registrasi'
        }
    </script>
    <!-- endstatistik -->
@endsection
