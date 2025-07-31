@extends('admin.partials.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row mx-0">
        @can('client.create')
        <div class="col-md-4">
            <div class="card p-3">
                <h3>Add Client Review</h3>

                <form method="post" action="{{route('client-review.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name<span class="fs-5 text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                    </div>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="url" class="form-label">Client<span class="fs-5 text-danger">*</span></label>
                        <select name="client_id" id="client_id" class="form-control">
                            <option value="">Select Client</option>
                            @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('client_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror


                    <div class="mb-3">
                        <label for="review" class="form-label">Review</label>
                        <textarea type="text" class="form-control" id="review" name="review">{{old('review')}}</textarea>
                    </div>
                    @error('review')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <input type="number" max="5" min="3" class="form-control" id="rating" name="rating" value="{{old('rating', 5)}}"> <span class="text-muted"> <i class="fa fa-star"></i> Rating out of 5</span>
                    </div>
                    @error('rating')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror


                    <div class="mb-3">
                        <label for="image" class="form-label">Reviewer Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    @error('image')
                    <div class="text-danger">
                        {{ $message }}</div>
                    @enderror

                    <div class="w-100 text-end">
                        <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
        @endcan
        <div class="col-md-8">
            <div class="card p-3">
                <h3>Clients</h3>
                <div class="table-responsive">
                    <table id="clientTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th style="width:25%;" scope="col">Name</th>
                            <th scope="col">Review</th>
                            <th scope="col">Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reviews as $index => $review)
                            <tr class="align-middle">
                                <th scope="row">{{$index + 1}}</th>
                                <td><img src="{{asset('public/storage/' . $review->image)}}" alt="Client Logo" class="img-fluid" style="max-width: 50px;"></td>
                                <td>
                                    {{$review->name}}
                                    <br>
                                    @if(isset($review->client_id))
                                        <span><i class="fa-solid fa-location-dot"></i> {{$review->client->name}}</span>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <span><i class="fa-solid fa-star"></i> {{$review->rating}}</span>
                                        <p>{{$review->review}}</p>
                                    </div>
                                <td>
                                    <div class="d-flex">
                                        @can('client.update')
                                        <a class="btn btn-outline-info px-2 py-1" href="{{route('client-review.edit',$review->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan
                                        @can('client.delete')
                                        <button class="btn btn-outline-danger px-2 py-1" onclick="openDeleteModal(`{{$review->id}}`)"><i class="fa-solid fa-trash"></i></button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Review?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmDeleteButton" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection


 @push('js')
    <script>

        $(document).ready(function () {
            $('#clientTable').DataTable();
        });

        function openDeleteModal(reviewId) {
            let url = `{{ route('client-review.destroy', [':id']) }}`;
            let actualUrl = url.replace(':id', reviewId);

            let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();

            $('#confirmDeleteButton').off('click').on('click', function () {
                $.ajax({
                    url: actualUrl,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            location.reload();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        }


    </script>

@endpush
