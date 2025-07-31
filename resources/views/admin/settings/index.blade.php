@extends('admin.partials.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    @can('setting.view')
        <div class="card p-3">
            <div class="">
                <div>
                    <h3>Site Setting</h3>
                </div>
                <div class="card p-3">
                    <h6 class="text-center mb-3">Update Setting</h6>
                    @can('setting.update')

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('update.settings')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            @method('POST')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="inputName" class="form-label">Site Name</label>
                                        <input type="text" class="form-control" id="inputName" name="site_name"
                                               value="{{$settings->site_name}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputEmail" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" id="inputEmail" name="site_email"
                                               value="{{$settings->site_email}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="sitePhone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="sitePhone" name="phone_number"
                                               value="{{$settings->phone_number}}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputAddress" class="form-label">Address</label>
                                        <textarea type="text" class="form-control" id="inputAddress" name="address">{{$settings->address}} </textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputCoverText" class="form-label">Front Cover Text</label>
                                        <textarea type="text" class="form-control" id="inputCoverText" name="front_cover_text">{{$settings->front_cover_text}} </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="twitter_link" class="form-label">Twitter</label>
                                        <input type="text" class="form-control" id="twitter_link" name="twitter_link"
                                               value="{{$settings->twitter_link}}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="fb_link" class="form-label">Facebook</label>
                                        <input type="text" class="form-control" id="fb_link" name="fb_link"
                                               value="{{$settings->fb_link}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="instagram_link" class="form-label">Instagram</label>
                                        <input type="text" class="form-control" id="instagram_link" name="instagram_link"
                                               value="{{$settings->instagram_link}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="linkedin_link" class="form-label">LinkedIn</label>
                                        <input type="text" class="form-control" id="linkedin_link" name="linkedin_link"
                                               value="{{$settings->linkedin_link}}">
                                    </div>

                                    <p class="text-center">Social Media</p>
                                    <div class="d-flex justify-content-between">

                                        <div>
                                            <p>Twitter</p>
                                              <input type="radio" id="twitter" name="is_active_twitter" value="1" {{$settings->is_active_twitter == 1 ? 'checked' : ''}}>
                                              <label for="html">On</label><br>
                                              <input type="radio" id="twitter" name="is_active_twitter" value="0" {{$settings->is_active_twitter == 0 ? 'checked' : ''}}>
                                              <label for="css">Off</label><br>
                                        </div>

                                        <div>
                                            <p>Facebook</p>
                                              <input type="radio" id="facebook" name="is_active_fb" value="1" {{$settings->is_active_fb == 1 ? 'checked' : ''}}>
                                              <label for="html">On</label><br>
                                              <input type="radio" id="facebook" name="is_active_fb" value="0" {{$settings->is_active_fb == 0 ? 'checked' : ''}}>
                                              <label for="css">Off</label><br>
                                        </div>

                                        <div>
                                            <p>Instagram</p>
                                              <input type="radio" id="instagram" name="is_active_linkedin" value="1" {{$settings->is_active_linkedin == 1 ? 'checked' : ''}}>
                                              <label for="html">On</label><br>
                                              <input type="radio" id="instagram" name="is_active_linkedin" value="0" {{$settings->is_active_linkedin == 0 ? 'checked' : ''}}>
                                              <label for="css">Off</label><br>
                                        </div>

                                        <div>
                                            <p>LinkedIn</p>
                                              <input type="radio" id="linkedIn" name="is_active_instagram" value="1" {{$settings->is_active_instagram == 1 ? 'checked' : ''}}>
                                              <label for="html">On</label><br>
                                              <input type="radio" id="linkedIn" name="is_active_instagram" value="0" {{$settings->is_active_instagram == 0 ? 'checked' : ''}}>
                                              <label for="css">Off</label><br>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="banner" class="form-label">Banner</label>
                                        <input type="file" class="form-control" id="banner" name="banner">
                                    </div>

                                    @error('banner')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <img class="img-fluid" src="{{ asset('public/storage/' . $settings->banner) }}" alt=" Banner Image">
                                </div>
                            </div>


                            <div class="border p-3 mb-3">
                                <h5 class="text-center">About Section</h5>

                                <div class="mb-3">
                                    <label for="about_sec_title" class="form-label">About Scetion Title</label>
                                    <input type="text" class="form-control" id="about_sec_title" name="about_sec_title" value="{{$settings->about_sec_title}}">
                                </div>
                                @error('about_sec_title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="about_sec_one" class="form-label">About Scetion One</label>
                                    <textarea type="text" class="form-control" id="about_sec_one" name="about_sec_one"> {{$settings->about_sec_one}} </textarea>
                                </div>
                                @error('about_sec_one')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <div class="mb-3">
                                    <label for="about_sec_two" class="form-label">About Scetion Two</label>
                                    <textarea type="text" class="form-control" id="about_sec_two" name="about_sec_two"> {{$settings->about_sec_two}} </textarea>
                                </div>
                                @error('about_sec_two')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="about_img_one" class="form-label">About Image One</label>
                                                <input type="file" class="form-control" id="about_img_one" name="about_img_one">
                                            </div>

                                            @error('about_img_one')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <img class="img-fluid" src="{{ asset('public/storage/' . $settings->about_img_one) }}" alt="About Image">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="about_img_two" class="form-label">About Image Two</label>
                                                <input type="file" class="form-control" id="about_img_two" name="about_img_two">
                                            </div>

                                            @error('about_img_two')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <img class="img-fluid" src="{{ asset('public/storage/' . $settings->about_img_two) }}" alt="About Image">
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-md-10">
                                    <div class="mb-3">
                                        <label for="logoPath" class="form-label">Logo</label>
                                        <input type="file" class="form-control" id="logoPath" name="logo_path">
                                    </div>

                                    @error('logo_path')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <img class="img-fluid" src="{{ asset('public/storage/' . $settings->logo_path) }}" alt="Logo Image">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10">
                                    <div class="mb-3">
                                        <label for="favIcon" class="form-label">Fav Icon</label>
                                        <input type="file" class="form-control" id="favIcon" name="favicon_path">
                                    </div>

                                    @error('favicon_path')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <img class="img-fluid" src="{{ asset('public/storage/' . $settings->favicon_path) }}" alt="Fav Icon">
                                </div>
                            </div>



                            <button class="btn btn-outline-success">Save</button>
                        </form>
                </div>
            </div>
            @endcan
        </div>
    @endcan

@endsection

@push('js')
    <script>
        $('#about_sec_one').summernote({
            placeholder: 'About Section One',
            tabsize: 2,
            height: 100
        });

        $('#about_sec_two').summernote({
            placeholder: 'About Section Two',
            tabsize: 2,
            height: 100
        });
    </script>
@endpush


