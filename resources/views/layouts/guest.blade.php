@php
$settings = \App\Models\Setting::find(1);
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$settings->site_name}}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('public/storage/' . $settings->logo_path) }}" type="image/x-icon"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .CoverBackground {
            /* background-image: url('{{ asset('public/assets/img/cover.png') }}'); */
            height: 100vh;
            background-repeat: no-repeat;
            background-size: 100%;
        }

        .logo_style {
            height: 50px;
            width: 50px;
        }

        @media screen and (max-width: 768px) {
            .CoverBackground {
                background-size: 355%;
                background-position: center;
            }
        }

        @media screen and (max-width: 425px) {
            .site-title {
                font-size: 16px;
            }
        }

    </style>
</head>
<body class="CoverBackground"  style="height: 100vh;">
    <div class="overlay">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Logo Section -->
        <a class="text-decoration-none" href="{{url('/')}}">
            <div class="d-flex align-items-center d-block">
                <div class="">
                    <img class="logo_style w-100" src="{{ asset('public/storage/' . $settings->logo_path) }}" alt="site logo">
                </div>

                <h5 class="text-center text-dark ps-2 mb-0 site-title">{{$settings->site_name}}</h5>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon fs-6"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mt-md-0 mt-3">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>

                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('bio.create') }}">Add Bio</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('front-events.index') }}">Events</a>
                        </li>

                        @if (Route::has('register'))
                            @if( !request()->is('vehicles*'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('vehicles.create') }}">Get Parking</a>
                                </li>
                            @endif
                        @endif --}}
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>

        {{ $slot }}
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
