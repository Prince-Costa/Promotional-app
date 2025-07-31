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
                <h3>Package's</h3>
                <div class="table-responsive">
                    <table id="clientTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th style="width:25%;" scope="col">Package</th>
                            <th class="text-center" scope="col">Details</th>
                            <th scope="col">Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($packages as $index => $package)
                            <tr class="align-middle">
                                <th scope="row">{{$index + 1}}</th>
                                <td>
                                    <strong>Title: </strong><span class="text-success">{{$package->title}}</span>
                                    <br>
                                    <strong>Price: </strong><span class="text-danger">${{$package->price}}</span>
                                    <br>
                                    <strong>Service: </strong><span class="text-info">{{$package->service->title}}</span><br>
                                    <strong>Tag: </strong><span class="text-info">{{$package->tag}}</span>
                                </td>
                                <td>
                                    {!! $package->details !!}

                                </td>

                                <td>
                                    <div class="d-flex">
                                        @can('package.update')
                                        <a class="btn btn-outline-info px-2 py-1" href="{{route('packages.edit',$package->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan
                                        @can('package.delete')
                                        <button class="btn btn-outline-danger px-2 py-1" onclick="openDeleteModal(`{{$package->id}}`)"><i class="fa-solid fa-trash"></i></button>
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Package?
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

        function openDeleteModal(packageId) {
            let url = `{{ route('packages.destroy', [':id']) }}`;
            let actualUrl = url.replace(':id', packageId);

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
