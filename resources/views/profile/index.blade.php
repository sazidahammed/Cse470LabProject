@extends('layouts.starlight')
@section('profile')
    active
@endsection
@section('title')
    Profile
@endsection
@section('content')
@include('layouts.nav')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('/home') }}">Dashboard</a>

    </nav>
    <div class="sl-pagebody">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Name</h3>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ url('/profile/popupmodal/editname') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name='name' class="form-control" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="form-group">
                                    <button class='btn btn-primary' type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Password</h3>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('pass_success'))
                                <div class="alert alert-success">
                                    {{ session('pass_success') }}
                                </div>
                            @endif

                            <form action="{{ url('/profile/popupmodal/editpassword') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Old Password</label>
                                    <input type="password" name='old_password' class="form-control">
                                    @if (session('wrong_password'))
                                    <div class="alert alert-danger">
                                        {{ session('wrong_password') }}
                                    </div>
                                    @endif
                                    @error('old_password')
                                        <strong class='text-danger'>{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">New Password</label>
                                    <input type="password" name='password' class="form-control">
                                    @error('password')
                                        <strong class='text-danger'>{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name='password_confirmation' class="form-control">
                                    @error('password')
                                        <strong class='text-danger'>{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button class='btn btn-primary' type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Update photo</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/profile/popupmodal/photochange') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <p>Your Photo</p>
                                    <img class="w-25" src="{{ asset('uploads/profile') }}/{{ Auth::user()->profile_pic }}" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="">Photo Upload</label>
                                    <input type="file" name='profile_pic' class="form-control" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                                    <img class="w-25" id="pic" />

                                </div>
                                @error('profile_pic')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <button class='btn btn-primary' type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->

@endsection
