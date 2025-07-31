@extends('admin.partials.app')

@section('content')
    <div>
        <h3>{{$portfolio->title}}</h3>
        <p>Tag: {{$portfolio->portfolioTag->name}}</p>
        <p>Client: {{$portfolio->client->name}}</p>
        <p>Service: {{$portfolio->service->title}}</p>
    </div>

    <div>
        <img class="img-fluid w-100" src="{{asset('public/storage/'.$portfolio->image)}}" alt="{{$portfolio->title}} iomage">
    </div>

    <div>
        <p>{!! $portfolio->body !!}</p>
    </div>
@endsection


