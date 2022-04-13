@extends('dashboard.layouts.main')

@section('style')
<style>
    #profileImage::before {
        content: "";
    }
</style>
@endsection

@section('breadcrumb')
<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/home">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-4">

        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                @if ($user->profileImage)
                <img src="{{ asset('storage/' . $user->profileImage) }}" class="rounded-circle mb-3" alt="Profile"
                    width="100" height="100">
                @else
                <img src="/assets/img/profile.png" class="rounded-circle mb-3" alt="Profile" width="100" height="100">
                @endif

                <h2 class="text-center">{{ $user->name }}</h2>
                <div class="social-links mt-2">
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab"
                            data-bs-target="#profile-overview">Overview</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                            Profile</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                            Password</button>
                    </li>

                </ul>
                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        <h5 class="card-title">About</h5>
                        <p class="small fst-italic">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem,
                            quaerat debitis cum nihil cumque minima, provident temporibus tempora odio ratione quos. Est
                            quam quibusdam repudiandae non voluptatum deserunt ipsum quasi?</p>

                        <h5 class="card-title">Profile Details</h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Full Name</div>
                            <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Username</div>
                            <div class="col-lg-9 col-md-8">{{ $user->username }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Role</div>
                            <div class="col-lg-9 col-md-8">

                                @if ($user->is_admin == 1)
                                <span class="badge bg-success">
                                    Admin
                                </span>
                                @else
                                <span class="badge bg-info">
                                    User
                                </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                        <!-- Profile Edit Form -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                <div class="col-md-8 col-lg-9 text-center">

                                    <div class="d-flex justify-content-center">

                                        @if ($user->profileImage)
                                        <input type="hidden" name="oldImage" value="{{ $user->profileImage }}">
                                        <img src="{{ asset('storage/' . $user->profileImage) }}" class="rounded-circle"
                                            alt="Profile" width="100" height="100">
                                        @else
                                        <img src="/assets/img/profile.png" class="rounded-circle img-preview"
                                            alt="Profile" width="100" height="100">
                                        @endif

                                    </div>

                                    <div class="pt-2">
                                        <form action="/dashboard/profile/image/{{ auth()->user()->id }}" method="POST"
                                            enctype="multipart/form-data" class="d-inline-block">
                                            @csrf
                                            @method('PUT')
                                            <input type="file" name="profileImage" class="form-control mt-2 mb-2"
                                                id="profileImage" onchange="previewImage()">
                                            <button type="submit" class="btn btn-primary btn-sm"><i
                                                    class="bi bi-upload"></i></button>
                                        </form>
                                        {{-- <form class="d-inline-block" id="delete-photo" action="" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form> --}}
                                        <a onclick="event.preventDefault();
                                                    document.getElementById('delete-photo').submit();"
                                            class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="name" type="text" class="form-control" id="name"
                                        value="{{ old('name', $user->name) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="username" type="text" class="form-control" id="username"
                                        value="{{ old('name', $user->username) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="email" type="email" class="form-control" id="Email"
                                        value="{{ old('name', $user->email) }}">
                                </div>
                            </div>

                            <div class="text-center">
                                <button name="submit" type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                        <!-- End Profile Edit Form -->

                    </div>

                    <div class="tab-pane fade pt-3" id="profile-change-password">
                        <!-- Change Password Form -->
                        <form>

                            <div class="row mb-3">
                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                    Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password" type="password" class="form-control" id="currentPassword">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="newpassword" type="password" class="form-control" id="newPassword">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                    Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>
                        <!-- End Change Password Form -->

                    </div>

                </div>
                <!-- End Bordered Tabs -->

            </div>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const imgPreview = document.querySelector('.img-preview');
        const profileImage = document.querySelector('#profileImage');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(profileImage.files[0]);

        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        };
    }
</script>
@endsection