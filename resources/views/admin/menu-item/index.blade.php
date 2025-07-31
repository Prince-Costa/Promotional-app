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
                <h3>Add Menu</h3>

                <form action="{{ route('menu-item.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name<span class="fs-5 text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="page_url" class="form-label">URL<span class="fs-5 text-danger">*</span></label>
                        <input type="text" class="form-control" id="page_url" name="page_url" value="{{ old('page_url') }}">
                    </div>

                    <div class="mb-3">
                        <label for="page_selection" class="form-label">Select Page</label>
                        <select id="page_selection" class="form-select">
                            <option value="">-- Select a page --</option>
                            @foreach($pages as $page)
                                <option value="{{ $page->id }}" data-url="{{ route('front-page.show', $page->slug) }}">{{ $page->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('page_url')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror


                    @error('page_url')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="type" class="form-label">Menu Type<span class="fs-5 text-danger">*</span></label>
                        <select class="form-select" id="type" name="type">
                            <option value="single" {{ old('type') == 'single' ? 'selected' : '' }}>Single</option>
                            <option value="dropdown" {{ old('type') == 'dropdown' ? 'selected' : '' }}>Dropdown</option>
                        </select>
                    </div>
                    @error('type')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3" id="parentMenuDiv">
                        <label for="parent_id" class="form-label">Parent Menu (For Dropdown Only)</label>
                        <select class="form-select" id="parent_id" name="parent_id">
                            <option value="">None</option>
                            @foreach($parenMenu as $menu)
                                <option value="{{ $menu->id }}" {{ old('parent_id') == $menu->id ? 'selected' : '' }}>
                                    {{ $menu->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('parent_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="number" class="form-control" id="position" name="position" value="{{ old('position', 0) }}">
                    </div>
                    @error('position')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Save Menu</button>
                </form>
            </div>
        </div>
        @endcan
        <div class="col-md-8">
            <div class="card p-3">
                <h3>Menus</h3>
                <div class="table-responsive">
                    <table id="clientTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Details</th>
                            {{-- <th>Type</th>
                            <th>URL</th> --}}
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($menuItems as $index => $menu)
                            @if(!$menu->parent_id) <!-- Show only parent menus -->
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $menu->name }}</strong>
                                    <br>
                                    Type: {{ ucfirst($menu->type) }}
                                    <br>
                                    Position: {{ $menu->position }}
                                    <br>
                                    URL: {{ $menu->page_url }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        @can('client.update')
                                        <a class="btn btn-outline-info px-2 py-1" href="{{route('menu-item.edit',$menu->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan
                                        @can('client.delete')
                                        <button class="btn btn-outline-danger px-2 py-1" onclick="openDeleteModal(`{{$menu->id}}`)"><i class="fa-solid fa-trash"></i></button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>

                            <!-- Child menus -->
                            @foreach($menu->children as $index => $child)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>
                                    <strong>Parent: {{ $child->parent->name }}</strong>
                                    <br>
                                    &nbsp;&nbsp;&nbsp;→ {{ $child->name }}
                                    <br>
                                    {{ ucfirst($child->type) }}
                                    <br>
                                    Position: {{ $child->position }}
                                    <br>
                                    URL: {{ $child->page_url }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        @can('client.update')
                                        <a class="btn btn-outline-info px-2 py-1" href="{{route('menu-item.edit',$child->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                        @endcan
                                        @can('client.delete')
                                        <button class="btn btn-outline-danger px-2 py-1" onclick="openDeleteModal(`{{$child->id}}`)"><i class="fa-solid fa-trash"></i></button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Menu Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this Menu Item?
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

        function openDeleteModal(menuId) {
            let url = `{{ route('menu-item.destroy', [':id']) }}`;
            let actualUrl = url.replace(':id', menuId);

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


        document.getElementById('page_selection').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var pageUrl = selectedOption.getAttribute('data-url');

            if (pageUrl) {
                document.getElementById('page_url').value = pageUrl;
            } else {
                document.getElementById('page_url').value = ''; // Clear if no page is selected
            }
        });


    </script>

@endpush

