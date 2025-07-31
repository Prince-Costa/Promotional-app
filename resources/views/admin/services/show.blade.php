@extends('admin.partials.app')

@section('content')

<div class="text-center">
    <img src="{{asset('public/storage/' .$service->feature_image)}}" alt="">
</div>
<div class="mt-5">
    <h3>{{ $service->title }}</h3>
    {!! $service->body !!}
</div>

@endsection

