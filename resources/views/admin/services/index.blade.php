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
                <h3>Service's</h3>
                <div class="table-responsive">
                    <table id="serviceTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Body</th>
                            <th scope="col">Image</th>
                            <th scope="col">Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $index => $service)
                            <tr class="align-middle">
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$service->title}}</td>
                                <td>{{ Str::of(strip_tags($service->body))->explode('.')->first() }}....</td>
                                <td>
                                    @if($service->feature_image)
                                        <img src="{{ asset('public/storage/'.$service->feature_image) }}" alt="Service Image" width="100">
                                    @endif
                                <td>
                                    <div class="d-flex">
                                        @can('service.view')
                                        <a href="{{route('services.show', $service->id)}}" class="btn btn-outline-primary px-2 py-1"><i class="fa-solid fa-eye"></i></a>
                                        @endcan
                                        @can('service.update')
                                        <a href="{{route('services.edit', $service->id)}}" class="btn btn-outline-info px-2 py-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan
                                        @can('service.delete')
                                        <button class="btn btn-outline-danger px-2 py-1" onclick="openDeleteModal(`{{$service->id}}`)"><i class="fa-solid fa-trash"></i></button>
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Service?
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
        function openDeleteModal(serviceId) {
            let url = `{{ route('services.destroy', [':id']) }}`;
            let actualUrl = url.replace(':id', serviceId);

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

        $(document).ready(function() {
            $('#serviceTable').DataTable();
        });

    </script>

@endpush
