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
                <h3>Add Permission to {{$role->name}}</h3>

                <form method="post" action="{{route('roles.update_permissions', $role->id)}}">
                   @csrf
                   @method('PUT')
                    <input type="hidden" name="role_id" value="{{$role->id}}">
                    <div class="row mt-5">
                        @foreach($permissions as $permission)
                            <div class="col-3 mb-3">
                                <label>
                                    <input type="checkbox"
                                           name="permissions[]"
                                           value="{{$permission->name}}"
                                           {{in_array($permission->id, $rolePermissions) ? 'checked' : ''}}
                                    >
                                    {{$permission->name}}
                                </label>
                            </div>
                        @endforeach
                    </div>


                    <div class="w-100 text-end">
                        <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-check"></i> Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection


