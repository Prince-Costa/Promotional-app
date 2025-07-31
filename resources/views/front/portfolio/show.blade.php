@extends('app')

@section('content')
<style>

    main{
        padding-top: 100px;
    }
</style>
    <div class="container">
    <!-- ======= Breadcrumbs ======= -->
        <div aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Portfolio</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$portfolio->title}}</li>
            </ol>
        </div>

        <div class="text-center">
            <img src="{{asset('public/storage/' .$portfolio->image)}}" alt="featured image" class="img-fluid mb-3" style="max-width: 100%; height: auto;">
        </div>
        <div class="mt-5">
            <h3>{{ $portfolio->title }}</h3>
            {!! $portfolio->body !!}
        </div>

        <div class="my-5 p-5 bg-secondary">
            <h3 class="text-center my-3 text-light">Other Portfolios</h3>

              <div class="row gy-4">
                  @foreach($portfolios as $portfolio)
                <!-- Service Item -->
                  <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{route('portfolio.show', $portfolio->id)}}">
                        <div class="service-item card p-3 shadow">
                            <div class="text-center">
                                <img src="{{asset('public/storage/'.$portfolio->image)}}" alt="Service Image" class="img-fluid" style="width:100%; height: 300px;">
                            </div>

                            <div class="mt-3">
                                <h4 class="title"><a href="{{route('front-portfolio.show', $portfolio->id)}}" class="stretched-link">{{$portfolio->title}}</a></h4>

                                <p class="description">{{ Str::of(strip_tags($portfolio->body))->explode('.')->first() }}....</p>
                            </div>
                        </div>
                    </a>
                  </div>

                  <!-- End Service Item -->
                  @endforeach

              </div>
          </div>
    </div>
@endsection
