@php
    $settings = \App\Models\Setting::find(1);
    $menuItems = \App\Models\MenuItem::whereNull('parent_id')->get();
@endphp

@include('layouts.header')
        @yield('content')
@include('layouts.footer')
