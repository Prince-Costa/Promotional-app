@extends('admin.partials.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div>
        <h5>Edit Client</h5>
        <form action="{{route('clients.update', $client->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="">
                <div class="card p-3">

                    <div class="mb-3">
                        <label for="editName" class="form-label">Name<span class="fs-5 text-danger">*</span></label>
                        <input type="text" class="form-control" id="editName" name="name" value="{{$client->name}}">
                    </div>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="editURL" class="form-label">URL</label>
                        <input type="text" class="form-control" id="editURL" name="url" value="{{$client->url}}">
                    </div>

                    @error('url')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" value="{{$client->email}}">
                    </div>

                    @error('url')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="editPhone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="editPhone" name="phone" value="{{$client->phone}}">
                    </div>

                    @error('url')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="editAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="editAddress" name="address" value="{{$client->address}}">
                    </div>

                    @error('url')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="row">
                        <div class="col-md-6">
                            <label for="editImage" class="form-label">Company Logo</label>
                            <input type="file" class="form-control" id="editImage" name="image">
                        </div>

                        @error('url')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-md-6">
                            <img src="{{asset('public/storage/'. $client->image)}}" alt="Client Logo" class="img-fluid" style="max-width: 100px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-start mt-3">
                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-check"></i>
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    @endsection
