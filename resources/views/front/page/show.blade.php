@extends('app')

@section('content')
<style>

    main{
        padding-top: 100px;
    }
</style>
    <div class="container">
        <div class="text-center">
            <img src="{{asset('public/storage/' .$page->image)}}" alt="featured image" class="img-fluid mb-3" style="max-width: 100%; height: auto;">
        </div>
        <div class="mt-5">
            <h3>{{ $page->title }}</h3>
            {!! $page->body !!}
        </div>
    </div>
@endsection
