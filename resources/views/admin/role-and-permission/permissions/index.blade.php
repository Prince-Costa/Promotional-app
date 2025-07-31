@extends('admin.partials.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
   <div class="row">
       @can('permission.create')
       <div class="col-md-6">
           <div class="card p-3">
               <h3>Add Permission</h3>

               <form method="post" action="{{route('permissions.store')}}">
                   @csrf
                   <div class="mb-3">
                       <label for="permissionName" class="form-label">Permission Name<span class="fs-5 text-danger">*</span></label>
                       <input type="text" class="form-control" id="permissionName" name="name">
                   </div>
                   @error('name')
                   <div class="text-danger">{{ $message }}</div>
                   @enderror

                    <div class="w-100 text-end">
                        <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-check"></i> Save</button>
                    </div>
               </form>
           </div>
       </div>
       @endcan
       <div class="col-md-6">
            <div class="card p-3">
                <h3>Permissions</h3>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $index => $permission)
                    <tr>
                        <th scope="row">{{$index + 1}}</th>
                        <td>{{$permission->name}}</td>
                        <td>
                            <div class="d-flex">
                                @can('permission.update')
                                <button class="btn btn-outline-info px-2 py-1" onclick="openEditModal(`{{$permission->id}}`)"><i class="fa-solid fa-pen-to-square"></i></button>
                                @endcan
                                @can('permission.delete')
                                <button class="btn btn-outline-danger px-2 py-1" onclick="openDeleteModal(`{{$permission->id}}`)"><i class="fa-solid fa-trash"></i></button>
                                @endcan
                            </div>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
       </div>
   </div>


    <div id="editModal" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <label for="modalPermissionName" class="form-label">Permission Name<span class="fs-5 text-danger">*</span></label>
                            <input type="text" class="form-control" id="modalPermissionName" name="name">
                            <input type="hidden" class="form-control" id="modalPermissionId" name="permissionId">
                        </div>

                        <div class="w-100 text-end">

                        </div>
                </div>
                <div class="modal-footer">
                    <button onclick="updatePermission()" class="btn btn-outline-primary"><i class="fa-solid fa-check"></i> Save Changes</button>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this permission?
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

        function openEditModal(permissionId){
            let url = `{{route('permissions.edit', [':id'])}}`;
            let actualUrl = url.replace(':id', permissionId);

            $.ajax({
                url: actualUrl,
                type: 'GET',
                success: function(response) {
                    if(response.status === 'success'){
                        editModal.show();

                        $('#modalPermissionName').val(response.permission.name);
                        $('#modalPermissionId').val(permissionId);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }


        function updatePermission() {
            let permissionId = $('#modalPermissionId').val();
            let name = $('#modalPermissionName').val();

            // Create the URL using the route helper
            let url = `{{ route('permissions.update', [':id']) }}`.replace(':id', permissionId);

            $.ajax({
                url: url,
                type: 'PUT',
                data: {
                    name: name,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }



        function openDeleteModal(permissionId) {
            let url = `{{ route('permissions.destroy', [':id']) }}`;
            let actualUrl = url.replace(':id', permissionId);

            let deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();

            $('#confirmDeleteButton').off('click').on('click', function() {
                $.ajax({
                    url: actualUrl,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        }


    </script>

@endpush
