@extends('admin.partials.app')

@section('content')
<div class="container">
    <h2>Edit Menu Item</h2>

    <form action="{{ route('menu-item.update', $menuItem->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name<span class="fs-5 text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $menuItem->name) }}">
        </div>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="page_url" class="form-label">URL</label>
            <input type="text" class="form-control" id="page_url" name="page_url" value="{{ old('page_url', $menuItem->page_url) }}">
        </div>

        <div class="mb-3">
            <label for="page_selection" class="form-label">Select Page</label>
            <select id="page_selection" class="form-select">
                <option value="">-- Select a page --</option>
                @foreach($pages as $page)
                    <option value="{{ $page->id }}"
                        data-url="{{ route('front-page.show', $page->slug) }}"
                        @if($menuItem->page_url === route('front-page.show', $page->slug)) selected @endif>
                        {{ $page->title }}
                    </option>
                @endforeach
            </select>
        </div>

        @error('page_url')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="type" class="form-label">Menu Type<span class="fs-5 text-danger">*</span></label>
            <select class="form-control" id="type" name="type" onchange="toggleParentSelection()">
                <option value="single" {{ $menuItem->type == 'single' ? 'selected' : '' }}>Single</option>
                <option value="dropdown" {{ $menuItem->type == 'dropdown' ? 'selected' : '' }}>Dropdown</option>
            </select>
        </div>
        @error('type')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3" id="parent_menu" style="display: {{ $menuItem->type == 'single' ? 'block' : 'none' }};">
            <label for="parent_id" class="form-label">Parent Menu</label>
            <select class="form-control" id="parent_id" name="parent_id">
                <option value="">Select Parent</option>
                @foreach($menuItems as $menu)
                    <option value="{{ $menu->id }}" {{ $menuItem->parent_id == $menu->id ? 'selected' : '' }}>
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
            <input type="number" class="form-control" id="position" name="position" value="{{ old('position', $menuItem->position) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Menu</button>
        <a href="{{ route('menu-item.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection

@push('js')
<script>
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
