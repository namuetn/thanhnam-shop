@extends('frontend.main_master')

@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"><br>
                    <img src="{{ !empty($user->profile_photo_path) ? url('upload/user_images/' . $user->profile_photo_path) : url('upload/no_image.jpg') }}" 
                        alt="" 
                        class="card-img-top" 
                        style="border-radius: 50%"
                        height="167px"
                        width="167px"
                    >
                    <ul class="list-group list-group-flush"><br>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                        <a href="{{ route('user.change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                    </ul>
                </div>

                <div class="col-md-2">
                    
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center">
                            <span class="text-danger">Hi...</span>
                            <strong>{{ auth()->user()->name }}</strong>
                            Update Your Profile
                        </h3>

                        <div class="card-body">
                            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label class="info-title" for="name">Name<span></span></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="email">Email Address<span></span></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="phone">Phone<span></span></label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}" />
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="info-title" for="profile_photo_path">User Image<span></span></label>
                                    <input type="file" class="form-control" name="profile_photo_path" />
                                    @error('profile_photo_path')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
