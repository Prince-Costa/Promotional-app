@extends('admin.partials.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row">

        <div class="col-md-12">
            <div class="card p-3">
                <h3>Portfolio Tag's</h3>

                <table id="portfolioTag" class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th style="width:40%;" scope="col">Title</th>
                        <th scope="col">Details</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($portfolios as $index => $portfolio)
                        <tr class="align-middle">
                            <th style="width: 2%;" scope="row">{{$index + 1}}</th>
                            <td><img src="{{asset('public/storage/'.$portfolio->image)}}" alt="" style="width: 100px; height: 100px;"></td>
                            <td>{{$portfolio->title}}</td>
                            <td>
                                Tag: {{$portfolio->portfolioTag->name}}
                                <br>
                                Client: {{$portfolio->client->name}}
                                <br>
                                Service: {{$portfolio->service->title}}
                            </td>
                            <td>
                                <div class="d-flex">
                                    @can('portfolio.view')
                                    <a class="btn btn-outline-primary px-2 py-1" href="{{route('portfolio.show', $portfolio->id)}}"><i class="fa-solid fa-eye"></i></a>
                                    @endcan

                                    @can('portfolio.update')
                                    <a class="btn btn-outline-info px-2 py-1" href="{{route('portfolio.edit', $portfolio->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    @endcan

                                    @can('portfolio.delete')
                                    <button class="btn btn-outline-danger px-2 py-1" onclick="openDeleteModal(`{{$portfolio->id}}`)"><i class="fa-solid fa-trash"></i></button>
                                    @endcan
                                </div>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Portfolio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Portfolio?
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
