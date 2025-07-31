@extends('admin.partials.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @can('user_profile.view')
        <div class="card p-3">
            <div class="">
                <div>
                    <h3>Profile</h3>
                </div>
                <div class="card p-3">
                    <h3 class="text-center mb-3">Basic Info</h3>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center mb-3">
                                @if($user->image == '')
                                <img class="img-fluid" src="https://www.svgrepo.com/show/384670/account-avatar-profile-user.svg" alt="">
                                @else
                                <img class="img-fluid w-50" src="{{asset('public/storage/'.$user->image)}}" alt="">
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p>Name</p>
                                    <p>Role</p>
                                    <p>E-mail</p>
                                    <p>Phone</p>
                                    <p>Address</p>
                                </div>
                                <div class="col-8">
                                    <p>: {{$user->name}}</p>
                                    @php
                                    $roleName = \Spatie\Permission\Models\Role::where('id',$user->role_id)->pluck('name')->first();
                                    @endphp
                                    <p>: {{$roleName}}</p>
                                    <p>: {{$user->email}}</p>
                                    <p>: {{$user->phone}}</p>
                                    <p>: {{$user->address}}</p>
                                </div>
                            </div>
                        </div>
                        @can('user_profile.update')
                            <div class="col-md-8">
                                <div class="card p-3">
                                    <h6 class="text-center">Update Info</h6>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{route('profile.update',$user->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="inputName" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="inputName" name="name" value="{{$user->name}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputEmail" class="form-label">E-mail</label>
                                            <input type="email" class="form-control" id="inputEmail" name="email" value="{{$user->email}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputPhone" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="inputPhone" name="phone" value="{{$user->phone}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputAddress" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="inputAddress" name="address" value="{{$user->address}}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="inputImage" class="form-label">Image</label>
                                            <input type="file" class="form-control" id="inputImage" name="image">
                                        </div>

                                        <div class="mb-3">
                                            <label for="inputPassword" class="form-label">New Password</label>
                                            <input type="password" autocomplete="off" class="form-control" name="password" id="inputPassword">
                                        </div>
                                        <button class="btn btn-outline-success">Save</button>
                                    </form>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>

        </div>
    @endcan

@endsection


