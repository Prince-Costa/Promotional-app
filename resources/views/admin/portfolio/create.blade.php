@extends('admin.partials.app')

@section('content')
    <div>
        <h3>Add Protfolio</h3>

        <form method="post" action="{{route('portfolio.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="permissionName" class="form-label">Title<span class="fs-5 text-danger">*</span></label>
                        <input type="text" class="form-control" id="permissionName" name="title" value="{{old('title')}}">
                    </div>
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror


                    <div class="mb-3">
                        <label for="portfolioTag" class="form-label">Protfolio Tag</label>
                        <select id="portfolioTag" name="portfolio_tag_id" class="form-select" aria-label="Default select example">
                            @foreach ($portfolioTags as $portfolioTag)
                                <option value="{{$portfolioTag->id}}">{{$portfolioTag->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    @error('portfolio_tag_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="serviceId" class="form-label">Service</label>
                        <select id="serviceId" name="service_id" class="form-select" aria-label="Default select example">
                            @foreach ($services as $service)
                                <option value="{{$service->id}}">{{$service->title}}</option>
                            @endforeach

                        </select>
                    </div>
                    @error('service_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="clientId" class="form-label">Client</label>
                        <select id="clientId" name="client_id" class="form-select" aria-label="Default select example">
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    @error('client_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="portfoiloBody" class="form-label">Body<span class="fs-5 text-danger">*</span></label>
                        <textarea type="text" class="form-control" id="portfoiloBody" name="body"> </textarea>
                    </div>
                    @error('body')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12 ">
                    <div class="mb-3">
                        <label for="portfoiloImage" class="form-label">Image</label>
                        <input type="file" class="form-control" id="portfoiloImage" name="image">
                    </div>
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="col-md-6">

                </div>

            </div>


            <div class="w-100 text-end">
                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-check"></i> Save</button>
            </div>
        </form>
    </div>
@endsection

@push('js')

<script>
    $('#portfoiloBody').summernote({
        placeholder: '',
        tabsize: 2,
        height: 100
    });
</script>

@endpush
