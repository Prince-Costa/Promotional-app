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
            </ol>
        </div>


        <!-- Feature Start -->
        <div class="container-fluid feature bg-light py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Services</h4>
                    <h1 class="display-4 mb-4">Provide you a Better Future</h1>
                    <p class="mb-0">
                        <strong>We offer professional social media and reputation promotion services across Facebook,
                            Instagram, LinkedIn, YouTube, X (Twitter), and Trustpilot to help you grow your online
                            presence.</strong>
                        From real-looking likes, followers, views, comments, and shares to targeted reviews and profile
                        boosting, our solutions are safe, effective, and designed to build trust, engagement, and visibility
                        for your brand.
                    </p>
                </div>
                <div class="row mx-0 g-4">
                    @foreach ($services as $service)
                        <div class="col-md-6 col-lg-6 col-xl-2 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="feature-item p-4 pt-0">
                                @php
                                    if ($service->title == 'Instagram') {
                                        $icon = 'fab fa-instagram';
                                    } elseif ($service->title == 'Facebook') {
                                        $icon = 'fab fa-facebook-f';
                                    } elseif ($service->title == 'LinkedIn') {
                                        $icon = 'fa-brands fa-linkedin';
                                    } elseif ($service->title == 'YouTube') {
                                        $icon = 'fa-brands fa-youtube';
                                    } elseif ($service->title == 'X (Twitter)') {
                                        $icon = 'fa-solid fa-xmark';
                                    } elseif ($service->title == 'Trustpilot') {
                                        $icon = 'fas fa-star';
                                    }
                                @endphp
                                <div class="feature-icon p-4 mb-4">
                                    <i class="{{ $icon }} fa-3x"></i>
                                </div>
                                <h5 class="mb-4">{{ $service->title }}</h5>
                                <a class="btn btn-primary rounded-pill py-2 px-4"
                                    href="{{ route('service.show', $service->id) }}">Packages</a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- Feature End -->
    </div>
@endsection
