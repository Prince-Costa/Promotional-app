@php
    $settings = \App\Models\Setting::find(1);
    $userAvatar = Auth::user()->image;
@endphp

<!-- Navbar -->
<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="{{route('admin.dashboard')}}">
            <img src="{{ asset('public/storage/' . $settings->logo_path) }}" height="25" alt="" loading="lazy" />
            <h6 class="mb-0">{{$settings->site_name}}</h6>
        </a>

{{--        <!-- Right links -->--}}
        <ul class="navbar-nav ms-auto d-flex flex-row">
{{--            <!-- Notification dropdown -->--}}
{{--            <li class="nav-item dropdown">--}}
{{--                <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"--}}
{{--                   role="button" data-mdb-dropdown-init aria-expanded="false">--}}
{{--                    <i class="fas fa-bell"></i>--}}
{{--                    <span class="badge rounded-pill badge-notification bg-danger">1</span>--}}
{{--                </a>--}}
{{--                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">--}}
{{--                    <li><a class="dropdown-item" href="#">Some news</a></li>--}}
{{--                    <li><a class="dropdown-item" href="#">Another news</a></li>--}}
{{--                    <li>--}}
{{--                        <a class="dropdown-item" href="#">Something else</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}


            <!-- Avatar -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                   id="navbarDropdownMenuLink" role="button" data-mdb-dropdown-init aria-expanded="false">
                    @if($userAvatar)
                        <img src="{{ asset('public/storage/' . $userAvatar) }}" class="rounded-circle" height="22" alt="" loading="lazy" />
                    @else
                        <img src="{{asset('public/user.png')}}" class="rounded-circle" height="22" alt="" loading="lazy" />
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="{{route('profile.index')}}">My profile</a></li>
                    <li><form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
