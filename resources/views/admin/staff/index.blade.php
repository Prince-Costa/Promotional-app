@extends('admin.partials.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row mx-0">
        @can('staff.create')
        <div class="col-md-4">
            <div class="card p-3">
                <h3>Add Staff</h3>

                <form method="post" action="{{route('staffs.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name<span class="fs-5 text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                    </div>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" class="form-control" id="designation" name="designation" value="{{old('designation')}}">
                    </div>
                    @error('designation')
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
                        <label for="image" class="form-label">Image</label>
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
                <h3>Staffs</h3>
                <div class="table-responsive">
                    <table id="clientTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th style="width:25%;" scope="col">Name <br> Designation</th>
                            <th scope="col">Details</th>
                            <th scope="col">Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($staffs as $index => $staff)
                            <tr class="align-middle">
                                <th scope="row">{{$index + 1}}</th>
                                <td><img src="{{asset('public/storage/' . $staff->image)}}" alt="Client Logo" class="img-fluid" style="max-width: 50px;"></td>
                                <td>
                                    {{$staff->name}}
                                    <br>
                                    @if(isset($staff->designation))
                                    <span><i class="fa-solid fa-star"></i> {{$staff->designation}}</span>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        @if(isset($staff->email))
                                        <p class="mb-0"><i class="fa-solid fa-envelope"></i> {{$staff->email}}</p>
                                        @endif

                                        @if(isset($staff->phone))
                                        <p class="mb-0"><i class="fa-solid fa-phone"></i> {{$staff->phone}}</p>
                                        @endif

                                        @if(isset($staff->address))
                                        <p class="mb-0"><i class="fa-solid fa-location-dot"></i> {{$staff->address}}</p>
                                        @endif
                                    </div>
                                <td>
                                    <div class="d-flex">
                                        @can('staff.update')
                                        <a class="btn btn-outline-info px-2 py-1" href="{{route('staffs.edit',$staff->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan
                                        @can('staff.delete')
                                        <button class="btn btn-outline-danger px-2 py-1" onclick="openDeleteModal(`{{$staff->id}}`)"><i class="fa-solid fa-trash"></i></button>
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Staff?
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

        function openDeleteModal(staffId) {
            let url = `{{ route('staffs.destroy', [':id']) }}`;
            let actualUrl = url.replace(':id', staffId);

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
