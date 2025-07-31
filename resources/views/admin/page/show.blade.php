@extends('admin.partials.app')

@section('content')
    <div>
        <div class="d-flex justify-content-between">
            <h3>{{$page->title}}</h3>
            @can('frontcms.update')
                <a class="btn btn-outline-info" href="{{route('page.edit',$page->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
            @endcan
        </div>

        <p>Slug: {{$page->slug}}</p>
    </div>

    <div>
        <img class="img-fluid w-100" src="{{asset('public/storage/'.$page->image)}}" alt="{{$page->title}} iomage">
    </div>

    <div>
        <p>{!! $page->body !!}</p>
    </div>
@endsection
