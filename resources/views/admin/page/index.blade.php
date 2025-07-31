@extends('admin.partials.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row mx-0">
        <div class="col-md-12">
            <div class="card p-3">
                <h3>Page's</h3>
                <div class="table-responsive">
                    <table id="clientTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th style="width:25%;" scope="col">Title</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $index => $page)
                            <tr class="align-middle">
                                <th scope="row">{{$index + 1}}</th>
                                <th scope="row"><img src="{{asset('public/storage/'.$page->image)}}" alt="Page feature image" style="height: 50px; width:auto;"></th>
                                <td>
                                    <span class="text-success">{{$page->title}}</span>
                                </td>
                                <td>
                                    {{$page->slug}}
                                </td>

                                <td>
                                    <div class="d-flex">
                                        @can('frontcms.update')
                                        <a class="btn btn-outline-primary px-2 py-1" href="{{route('page.show',$page->slug)}}"><i class="fa-regular fa-eye"></i></a>
                                        @endcan
                                        @can('frontcms.update')
                                        <a class="btn btn-outline-info px-2 py-1" href="{{route('page.edit',$page->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan
                                        @can('frontcms.delete')
                                        <button class="btn btn-outline-danger px-2 py-1" onclick="openDeleteModal(`{{$page->id}}`)"><i class="fa-solid fa-trash"></i></button>
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Page</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Page?
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

        function openDeleteModal(pageId) {
            let url = `{{ route('page.destroy', [':id']) }}`;
            let actualUrl = url.replace(':id', pageId);

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
