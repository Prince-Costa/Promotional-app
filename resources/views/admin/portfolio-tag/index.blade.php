@extends('admin.partials.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row">
        @can('portfolio.create')
        <div class="col-md-6">
            <div class="card p-3">
                <h3>Add Portfolio Tag</h3>

                <form method="post" action="{{route('portfolio_tags.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="tagName" class="form-label">Tag Name<span class="fs-5 text-danger">*</span>(use single word or use - or _ junction)</label>
                        <input type="text" class="form-control" id="tagName" name="name">
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
                <h3>Portfolio Tag's</h3>

                <table id="portfolioTag" class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $index => $tag)
                        <tr>
                            <th scope="row">{{$index + 1}}</th>
                            <td>{{$tag->name}}</td>
                            <td>
                                <div class="d-flex">
                                    @can('portfolio.update')
                                    <button class="btn btn-outline-info px-2 py-1" onclick="openEditModal(`{{$tag->id}}`)"><i class="fa-solid fa-pen-to-square"></i></button>
                                    @endcan

                                    @can('portfolio.delete')
                                    <button class="btn btn-outline-danger px-2 py-1" onclick="openDeleteModal(`{{$tag->id}}`)"><i class="fa-solid fa-trash"></i></button>
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
                    <h5 class="modal-title">Edit Portfolio Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="portfolioTagName" class="form-label">Portfolio Tag Name<span class="fs-5 text-danger">*</span>(use single word or use - or _ junction)</label>
                        <input type="text" class="form-control" id="portfolioTagName" name="name">
                        <input type="hidden" class="form-control" id="portfolioTagId" name="portfolioTagId">
                    </div>

                    <div class="w-100 text-end">

                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="updateportfolioTag()" class="btn btn-outline-primary"><i class="fa-solid fa-check"></i> Save Changes</button>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Portfolio Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Portfolio Tag?
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
        $(document).ready(function() {
            $('#portfolioTag').DataTable();
        });


        let editModal = new bootstrap.Modal(document.getElementById('editModal'));

        function openEditModal(portfolioTagId){
            let url = `{{route('portfolio_tags.edit', [':id'])}}`;
            let actualUrl = url.replace(':id', portfolioTagId);

            $.ajax({
                url: actualUrl,
                type: 'GET',
                success: function(response) {
                    if(response.status === 'success'){
                        editModal.show();

                        $('#portfolioTagName').val(response.portfolioTag.name);
                        $('#portfolioTagId').val(portfolioTagId);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }


        function updateportfolioTag() {
            let portfolioTagId = $('#portfolioTagId').val();
            let name = $('#portfolioTagName').val();

            // Create the URL using the route helper
            let url = `{{ route('portfolio_tags.update', [':id']) }}`.replace(':id', portfolioTagId);

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



        function openDeleteModal(portfolioTagId) {
            let url = `{{ route('portfolio_tags.destroy', [':id']) }}`;
            let actualUrl = url.replace(':id', portfolioTagId);

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
