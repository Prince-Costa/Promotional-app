@extends('admin.partials.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row mx-0">
        @can('service.update')
        <div class="col-md-12">
            <div class="card p-3">
                <h3>Edit Service</h3>

                <form method="post" action="{{ route('services.update', $service->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Specify the HTTP method -->

                    <div class="mb-3">
                        <label for="name" class="form-label">Title<span class="fs-5 text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $service->title) }}">
                    </div>
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="body" class="form-label">Body<span class="fs-5 text-danger">*</span></label>
                        <textarea class="form-control" id="body" name="body">{{ old('body', $service->body) }}</textarea>
                    </div>
                    @error('body')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="feature_image" class="form-label">Feature Image</label>
                        <input type="file" class="form-control" id="feature_image" name="feature_image">
                        @if($service->feature_image)
                            <div class="mt-2">
                                <img src="{{ asset('public/storage/'.$service->feature_image) }}" alt="Service Image" width="100">
                            </div>
                        @endif
                    </div>
                    @error('feature_image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="w-100 text-end">
                        <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-check"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endcan
    </div>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#body').summernote({
            height: 300,                 // Set editor height
            minHeight: null,             // Set minimum height
            maxHeight: null,             // Set maximum height
            focus: true                  // Set focus to editable area after initialization
        });
    });
</script>
@endpush
