@extends('admin.partials.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row mx-0">
        @can('frontcms.update')
        <div class="col-md-12">
            <div class="card p-3">
                <h3>Edit Page</h3>

                <form method="post" action="{{ route('page.update', $page->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Title<span class="fs-5 text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $page->title) }}">
                    </div>
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug<span class="fs-5 text-danger">*</span></label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $page->slug) }}">
                    </div>
                    @error('slug')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="body" class="form-label">Body<span class="fs-5 text-danger">*</span></label>
                        <textarea type="text" class="form-control" id="body" name="body">{{ old('body', $page->body) }}</textarea>
                    </div>
                    @error('body')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="image" class="form-label">Feature Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            @error('image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <img class="img-fluid w-50" src="{{asset('public/storage/'.$page->image)}}" alt="{{$page->title}} image">
                        </div>
                    </div>


                    <div class="w-100 text-end">
                        <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-check"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
        @endcan
@endsection

@push('js')
    <script>
        $('#body').summernote({
            placeholder: 'Page body content...',
            tabsize: 2,
            height: 300
        });
    </script>
@endpush
