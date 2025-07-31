@extends('admin.partials.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row mx-0">
        @can('package.create')
        <div class="col-md-12">
            <div class="card p-3">
                <h3>Add Package</h3>

                <form method="post" action="{{route('packages.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title<span class="fs-5 text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                    </div>
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price<span class="fs-5 text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="price" name="price" value="{{old('price')}}">
                                  </div>
                            </div>
                            @error('price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Service<span class="fs-5 text-danger">*</span></label>
                                <select class="form-select" aria-label="Default select example" name="service_id">
                                    <option value="" selected>Select</option>
                                    @foreach($services as $service)
                                    <option value="{{$service->id}}">{{$service->title}}</option>
                                    @endforeach
                                  </select>
                            </div>

                            @error('service_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="tag" class="form-label">Tag</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" aria-label="" id="tag" name="tag" value="{{old('tag')}}">
                                </div>
                        </div>
                        @error('tag')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="details" class="form-label">Details</label>
                        <textarea type="text" class="form-control" id="details" name="details"> {{old('details')}} </textarea>
                    </div>
                    @error('details')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror


                    <div class="w-100 text-end">
                        <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
        @endcan
@endsection


 @push('js')
    <script>
        $('#details').summernote({
            placeholder: 'Package Details',
            tabsize: 2,
            height: 300
        });
    </script>

@endpush
