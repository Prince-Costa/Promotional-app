@extends('admin.partials.app')

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card p-3">
                <div class="d-flex justify-content-between">
                    <h3>Messages</h3>
                    <button class="btn btn-danger" onclick="deleteSelected()">Delete</button>
                </div>


                <table id="portfolioTag" class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col"><input id="checkAll" type="checkbox"></th>
                        <th scope="col">#</th>
                        <th style="width:80%;" scope="col">Message</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($messages as $index => $message)
                        <tr class="align-middle">
                            <th><input type="checkbox" name="id[]" value="{{$message->id}}"></th>
                            <th style="width: 2%;" scope="row">{{$index + 1}}</th>

                            <td>
                                <div class="row">
                                    <div class="col-md-2">
                                        <h6>Sender</h6>
                                        <p class="mb-0">Email</p>
                                        <p>Subject</p>
                                    </div>
                                    <div class="col-md-10">
                                        <h5>{{$message->name}}</h5>
                                        <p class="mb-0">{{$message->email}}</p>
                                        <p>{{$message->subject}}</p>

                                        <p>{{$message->message}}</p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="d-flex">
                                    @can('message.delete')
                                    <button class="btn btn-outline-danger px-2 py-1" onclick="openDeleteModal(`{{$message->id}}`)"><i class="fa-solid fa-trash"></i></button>
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Message?
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

        function openDeleteModal(id) {
            let url = `{{ route('message.destroy', [':id']) }}`;
            let actualUrl = url.replace(':id', id);

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


        document.getElementById('checkAll').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('input[name="id[]"]');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });

    function deleteSelected() {
        let selectedIds = [];
        let checkboxes = document.querySelectorAll('input[name="id[]"]:checked');
        checkboxes.forEach((checkbox) => {
            selectedIds.push(checkbox.value);
        });

        if (selectedIds.length > 0) {
            if (confirm('Are you sure you want to delete the selected items?')) {

                $.ajax({
                    url: '/delete-messages',
                    type: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: JSON.stringify({ ids: selectedIds }),
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
        } else {
            alert('Please select at least one item to delete.');
        }
    }


    </script>

@endpush
