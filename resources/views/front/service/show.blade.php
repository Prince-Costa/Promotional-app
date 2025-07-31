@extends('app')

@section('content')
    <style>
        main {
            padding-top: 100px;
        }
    </style>
    <div class="container">
        <!-- ======= Breadcrumbs ======= -->
        <div aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Service</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $service->title }}</li>
            </ol>
        </div>

        <div class="text-center">
            <img src="{{ asset('public/storage/' . $service->feature_image) }}" alt="featured image" class="img-fluid mb-3"
                style="max-width: 100%; height: auto;">
        </div>
        <div class="mt-5">
            <h3 class="border-bottom mb-4">{{ $service->title }}</h3>
            {!! $service->body !!}
        </div>

        <h3 class="my-4 mt-5 border-bottom">Packages</h3>
        @forelse ($packages as $tag => $tagPackages)
            <div class="card my-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-white">{{ $tag }}</h5>
                </div>
                <div class="card-body">


                    <div class="row mx-0 g-4 justify-content-center">
                        @foreach ($tagPackages as $package)
                            <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                                <div class="service-item border rounded shadow-sm">
                                    @php
                                        if ($package->service->title == 'Instagram') {
                                            $icon = 'fab fa-instagram instagram_color';
                                        } elseif ($package->service->title == 'Facebook') {
                                            $icon = 'fab fa-facebook-f facebook_color';
                                        } elseif ($package->service->title == 'LinkedIn') {
                                            $icon = 'fa-brands fa-linkedin linkedin_color';
                                        } elseif ($package->service->title == 'YouTube') {
                                            $icon = 'fa-brands fa-youtube youtube_color';
                                        } elseif ($package->service->title == 'X (Twitter)') {
                                            $icon = 'fa-solid fa-xmark text-info';
                                        } elseif ($package->service->title == 'Trustpilot') {
                                            $icon = 'fas fa-star trustpilot_color';
                                        }
                                    @endphp
                                    <div class="service-img">
                                        <div class="service-icon p-3 text-center">
                                            <i class="{{ $icon }} fa-2x"></i>
                                        </div>
                                    </div>
                                    <div class="service-content px-2">
                                        <div class="service-content-inner">
                                            <p class="text-center mb-2">{{ $package->title }}</p>
                                            <p class="text-center mb-2 text-danger fw-bolder fs-3">${{ $package->price }}</p>
                                            {!! $package->details !!}
                                            {{-- <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Read More</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No packages available for this service.</p>
        @endforelse


        <div class="my-5 p-5 bg-primary">
            <h3 class="text-center my-3 text-light">Other Services</h3>

            <div class="row gy-4">
                @foreach ($services as $service)
                    <!-- Service Item -->
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <a href="{{ route('service.show', $service->id) }}">
                            <div class="service-item card p-3 shadow">
                                <div class="text-center">
                                    <img src="{{ asset('public/storage/' . $service->feature_image) }}" alt="Service Image"
                                        class="img-fluid" style="width:100%; height: 300px;">
                                </div>

                                <div class="mt-3">
                                    <h4 class="title"><a href="{{ route('service.show', $service->id) }}"
                                            class="stretched-link">{{ $service->title }}</a></h4>

                                    <p class="description">
                                        {{ Str::of(strip_tags($service->body))->explode('.')->first() }}....</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- End Service Item -->
                @endforeach

            </div>
        </div>
    </div>
@endsection
