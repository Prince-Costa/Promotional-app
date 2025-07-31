@php
    $settings = \App\Models\Setting::find(1);
@endphp

@extends('admin.partials.app')

@section('content')
   <h1 class="text-center">Welcome To Admin Dashboard</h1>

   <div class="text-center">
        <img class="img-fluid w-75" src="{{ asset('public/storage/' . $settings->logo_path) }}" alt="Site Logo">
   </div>

@endsection

@push('js')
    <script>
        
    </script>
@endpush
