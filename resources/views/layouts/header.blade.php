@php
    $settings = \App\Models\Setting::find(1);
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $settings->site_name }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('public/storage/' . $settings->favicon_path) }}" type="image/x-icon" />
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{ asset('/public/assets/front/lib/animate/animate.min.css') }}" />
    <link href="{{ asset('/public/assets/front/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/assets/front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="{{ asset('/public/assets/front/css/animate.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('/public/assets/front/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('/public/assets/front/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/assets/front/css/custom_css.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    {{-- <div class="container-fluid topbar px-0 px-lg-4 bg-light py-2 d-none d-lg-block">
            <div class="container">
                <div class="row mx-0 gx-0 align-items-center">
                    <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                        <div class="d-flex flex-wrap">
                            <div class="border-end border-primary pe-3">
                                <a href="#" class="text-muted small"><i class="fas fa-map-marker-alt text-primary me-2"></i>Find A Location</a>
                            </div>
                            <div class="ps-3">
                                <a href="mailto:example@gmail.com" class="text-muted small"><i class="fas fa-envelope text-primary me-2"></i>example@gmail.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center text-lg-end">
                        <div class="d-flex justify-content-end">
                            <div class="d-flex border-end border-primary pe-3">
                                <a class="btn p-0 text-primary me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn p-0 text-primary me-3" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn p-0 text-primary me-3" href="#"><i class="fab fa-instagram"></i></a>
                                <a class="btn p-0 text-primary me-0" href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                            <div class="dropdown ms-3">
                                <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown"><small><i class="fas fa-globe-europe text-primary me-2"></i> English</small></a>
                                <div class="dropdown-menu rounded">
                                    <a href="#" class="dropdown-item">English</a>
                                    <a href="#" class="dropdown-item">Bangla</a>
                                    <a href="#" class="dropdown-item">French</a>
                                    <a href="#" class="dropdown-item">Spanish</a>
                                    <a href="#" class="dropdown-item">Arabic</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="nav-bar px-0 py-lg-0">
        <section class="top_section">
            <header class="p10 bg_blue_white">
                <div class="px-2  row mx-0">
                    <div class="col-md-8">
                        <div class="row mx-0">
                            <div class="col-md-4">
                                <i class="fa-regular fa-clock fs-3 text-primary"></i>
                                <span
                                    class="animate__animated animate__fadeIn animate__slow animate__infinite text-dark">24/7
                                    Live Support</span>
                            </div>
                            @if(isset($settings->site_email))
                            <div class="col-md-4">
                                <i class="fa-regular fa-envelope fs-3 text-primary pe-1"></i>
                                <span class="text-dark">{{$settings->site_email}}</span>
                            </div>
                            @endif
                            
                            @if(isset($settings->phone_number))
                            <div class="col-md-4">
                                <i class="fa-brands fa-whatsapp fs-3 text-primary"></i>
                                <span class="text-dark">{{$settings->phone_number}}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4 class="text-end animate__animated animate__pulse animate__slow animate__infinite mt-1">{{$settings->front_cover_text}}</h4>
                    </div>
                </div>
            </header>
        </section>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a href="#" class="navbar-brand p-0">
                    <img class="img-fluid" src="{{ asset('public/storage/' . $settings->logo_path) }}" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav justify-content-start mx-auto">
                        <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                        <a href="{{ route('service.index') }}" class="nav-item nav-link {{ request()->routeIs('service.index') ? 'active' : '' }}">Services</a>
                        <a href="{{ route('home') }}#AboutUs" class="nav-item nav-link">About Us</a>
                        <a href="{{ route('home') }}#contact" class="nav-item nav-link">Contact Us</a>
                        <a href="{{ route('home') }}#FAQ" class="nav-item nav-link">FAQ(Frequently Asked Question)</a>
                        
                    </div>
                </div>
                @if(isset($settings->phone_number))
                <div class="d-none d-xl-flex flex-shrink-0 ps-4">
                    <a href="#" class="btn btn-light btn-lg-square rounded-circle position-relative wow tada"
                        data-wow-delay=".9s">
                        <i class="fa fa-phone-alt fa-2x"></i>
                        <div class="position-absolute" style="top: 7px; right: 12px;">
                            <span><i class="fa fa-comment-dots text-secondary"></i></span>
                        </div>
                    </a>
                    
                    <div class="d-flex flex-column ms-3">
                        <span>Call to Our Experts</span>
                        <a href="tel:{{$settings->phone_number}}"><span class="text-dark">{{$settings->phone_number}}</span></a>
                    </div>
                </div>
                @endif
            </nav>
        </div>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center bg-primary">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="btn bg-light border nput-group-text p-3"><i
                                class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->
