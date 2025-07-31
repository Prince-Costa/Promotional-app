@extends('admin.partials.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

<div class="">
    <div class="card p-3">
        <h3>Edit Client Review</h3>

        <form method="post" action="{{route('client-review.update', $review->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name<span class="fs-5 text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name', $review->name)}}">
            </div>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="url" class="form-label">Client<span class="fs-5 text-danger">*</span></label>
                <select name="client_id" id="client_id" class="form-control">
                    <option value="">Select Client</option>
                    @foreach($clients as $client)
                        <option value="{{$client->id}}" {{ $client->id == $review->client_id ? 'selected' : '' }}>{{$client->name}}</option>
                    @endforeach
                </select>
            </div>
            @error('client_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="review" class="form-label">Review</label>
                <textarea type="text" class="form-control" id="review" name="review">{{old('review', $review->review)}}</textarea>
            </div>
            @error('review')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <input type="number" max="5" min="3" class="form-control" id="rating" name="rating" value="{{old('rating', $review->rating)}}"> <span class="text-muted"> <i class="fa fa-star"></i> Rating out of 5</span>
            </div>
            @error('rating')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="image" class="form-label">Reviewer Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <div class="col-md-4">
                    <img class="img-fluid w-50" src="{{asset('public/storage/'.$review->image)}}" alt="">
                </div>
            </div>

            @error('image')
            <div class="text-danger">
                {{ $message }}</div>
            @enderror

            <div class="w-100 text-end">
                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-check"></i> Update</button>
            </div>
        </form>
    </div>
</div>

@endsection
