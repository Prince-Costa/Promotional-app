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
                <h3>Add Client</h3>

                <form method="post" action="{{route('clients.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name<span class="fs-5 text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                    </div>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="text" class="form-control" id="url" name="url" value="{{old('url')}}">
                    </div>
                    @error('url')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                    </div>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
                    </div>
                    @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea type="text" class="form-control" id="address" name="address" > {{old('address')}} </textarea>
                    </div>
                    @error('address')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="image" class="form-label">Company Logo</label>
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
                            <th scope="col">Logo</th>
                            <th style="width:25%;" scope="col">Name</th>
                            <th scope="col">Details</th>
                            <th scope="col">Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $index => $client)
                            <tr class="align-middle">
                                <th scope="row">{{$index + 1}}</th>
                                <td><img src="{{asset('public/storage/' . $client->image)}}" alt="Client Logo" class="img-fluid" style="max-width: 50px;"></td>
                                <td>
                                    {{$client->name}}
                                    <br>
                                    @if(isset($client->address))
                                        <span><i class="fa-solid fa-location-dot"></i> {{$client->address}}</span>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        @if (isset($client->email))
                                            <p class="mb-0"><i class="fa-solid fa-envelope"></i> {{$client->email}}</p>
                                        @endif

                                        @if(isset($client->phone))
                                            <p class="mb-0"><i class="fa-solid fa-phone"></i> {{$client->phone}}</p>
                                        @endif

                                        @if(isset($client->url))
                                            <p class="mb-0"><i class="fa-solid fa-link"></i> {{$client->url}}</p>
                                        @endif
                                    </div>
                                <td>
                                    <div class="d-flex">
                                        @can('client.update')
                                        <a class="btn btn-outline-info px-2 py-1" href="{{route('clients.edit',$client->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan
                                        @can('client.delete')
                                        <button class="btn btn-outline-danger px-2 py-1" onclick="openDeleteModal(`{{$client->id}}`)"><i class="fa-solid fa-trash"></i></button>
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Client?
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

        function openDeleteModal(clientId) {
            let url = `{{ route('clients.destroy', [':id']) }}`;
            let actualUrl = url.replace(':id', clientId);

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
