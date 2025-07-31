@extends('admin.partials.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row mx-0">
        @can('user.create')
        <div class="col-md-3">
            <div class="card p-3">
                <h3>Add User</h3>

                <form method="post" action="{{route('users.store')}}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name<span class="fs-5 text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                    </div>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone<span class="fs-5 text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
                    </div>
                    @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror


                    <div class="mb-3">
                        <label for="email" class="form-label">Email<span class="fs-5 text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                    </div>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror


                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Role<span class="fs-5 text-danger">*</span></label>
                        <select class="form-select" aria-label="" name="role_id">
                            <option value="" selected>Open this select menu</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('role_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="w-100 text-end">
                        <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-check"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endcan
        <div class="col-md-9">
            <div class="card p-3">
                <h3>Users</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $index => $user)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td><img src="{{asset('public/storage/'.$user->image)}}" alt="image" style="height: 50px; width:100%;"></td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->role_name}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->address}}</td>
                                <td>
                                    <div class="d-flex">
                                        @can('user.update')
                                        <button class="btn btn-outline-info px-2 py-1" onclick="openEditModal(`{{$user->id}}`)"><i class="fa-solid fa-pen-to-square"></i></button>
                                        @endcan
                                        @can('user.delete')
                                        <button class="btn btn-outline-danger px-2 py-1" onclick="openDeleteModal(`{{$user->id}}`)"><i class="fa-solid fa-trash"></i></button>
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


    <div id="editModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="card p-3">
                        <!-- Error Messages -->
                        <div id="modalErrorMessages" class="alert alert-danger d-none"></div>
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name<span class="fs-5 text-danger">*</span></label>
                            <input type="text" class="form-control" id="editName" name="name" value="{{old('name')}}">
                        </div>

                        <div class="mb-3">
                            <label for="editPhone" class="form-label">Phone<span class="fs-5 text-danger">*</span></label>
                            <input type="text" class="form-control" id="editPhone" name="phone" value="{{old('phone')}}">
                        </div>


                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email<span class="fs-5 text-danger">*</span></label>
                            <input type="email" class="form-control" id="editEmail" name="email" value="{{old('email')}}">
                        </div>

                        <div class="mb-3">
                            <label for="editAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="editAddress" name="address" value="{{old('address')}}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Role<span class="fs-5 text-danger">*</span></label>
                            <select class="form-select" aria-label="" name="role_id" id="editRoleId">
                                <option value="" selected>Open this select menu</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="user_id" id="editUserId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="updateUser()" class="btn btn-outline-primary"><i class="fa-solid fa-check"></i>
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
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
        let editModal = new bootstrap.Modal(document.getElementById('editModal'));

        function openEditModal(userId) {
            let url = `{{route('users.edit', [':id'])}}`;
            let actualUrl = url.replace(':id', userId);
            // Remove old errors
            $('#modalErrorMessages').empty().addClass('d-none');

            $.ajax({
                url: actualUrl,
                type: 'GET',
                success: function (response) {
                    if (response.status === 'success') {
                        editModal.show();
                        $('#editName').val(response.user.name);
                        $('#editPhone').val(response.user.phone);
                        $('#editEmail').val(response.user.email);
                        $('#editAddress').val(response.user.address);
                        $('#editRoleId').val(response.user.role_id);
                        $('#editUserId').val(userId);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }


        function updateUser() {
            let name = $('#editName').val();
            let phone = $('#editPhone').val();
            let email = $('#editEmail').val();
            let address = $('#editAddress').val();
            let roleId = $('#editRoleId').val();
            let userId = $('#editUserId').val();

            // Create the URL using the route helper
            let url = `{{ route('users.update', [':id']) }}`.replace(':id', userId);

            $.ajax({
                url: url,
                type: 'PUT',
                data: {
                    name: name,
                    phone: phone,
                    email: email,
                    address: address,
                    role_id: roleId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.status === 'success') {
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    // Display validation errors in the modal if the request fails
                    let errors = xhr.responseJSON.errors;

                    // Clear previous error messages
                    $('#modalErrorMessages').empty().removeClass('d-none');

                    // Loop through the errors and append them to the error div
                    $.each(errors, function(field, messages) {
                        $.each(messages, function(index, message) {
                            $('#modalErrorMessages').append('<div>' + message + '</div>');
                        });
                    });
                }
            });
        }


        function openDeleteModal(userId) {
            let url = `{{ route('users.destroy', [':id']) }}`;
            let actualUrl = url.replace(':id', userId);

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
