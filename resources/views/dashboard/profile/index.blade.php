@extends('dashboard.layouts.main')

@section('style')
<style>
    #imageProfile::before {
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

                @if ($user->imageProfile)
                <img src="{{ asset('storage/' . $user->imageProfile) }}" class="rounded-circle mb-3" alt="Profile"
                    width="100" height="100">
                @else
                <img src="/assets/img/profile.png" class="rounded-circle mb-3" alt="Profile" width="100" height="100">
                @endif

                {{-- <div class="text-center mb-3">

                </div> --}}

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
                        <div class="row mb-3">
                            <label for="imageProfile" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                            <div class="col-md-8 col-lg-9">

                                @if ($user->imageProfile)
                                <input type="hidden" name="oldImage" value="{{ $user->imageProfile }}">
                                <img src="{{ asset('storage/' . $user->imageProfile) }}"
                                    class="rounded-circle img-preview" alt="Profile" width="100" height="100">
                                @else
                                <img src="/assets/img/profile.png" class="rounded-circle img-preview" alt="Profile"
                                    width="100" height="100">
                                @endif

                                <div class="pt-2">
                                    <form action="/dashboard/profile/image" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <input type="file" name="imageProfile" class="form-control mt-2 mb-2"
                                            id="imageProfile" onchange="previewImage()">
                                        <button style="display: none;" type="submit" id="update-button"
                                            class="btn btn-primary btn-sm"><i class="bi bi-upload"></i></button>
                                    </form>
                                    <form id="data-{{ auth()->user()->id }}" action="/dashboard/profile/image/delete"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')

                                        @if ($user->imageProfile)
                                        <button data-id="{{ auth()->user()->id }}" type="submit"
                                            class="delete btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                        @endif

                                    </form>
                                </div>

                            </div>
                        </div>

                        <form action="/dashboard/profile/update" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name', $user->name) }}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" id="username"
                                        value="{{ old('name', $user->username) }}">
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" id="Email"
                                        value="{{ old('name', $user->email) }}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row text-center">
                                <div class="col">
                                    <button name="submit" type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </form>
                        <!-- End Profile Edit Form -->

                    </div>

                    <div class="tab-pane fade pt-3" id="profile-change-password">

                        @if (session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif

                        <!-- Change Password Form -->
                        <form action="/dashboard/profile/password" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Current
                                    Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="current_password" type="password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        id="current_password">
                                    @error('current_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="new_password" type="password"
                                        class="form-control @error('new_password') is-invalid @enderror"
                                        id="new_password">
                                    @error('new_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="renew_password" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                    Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="renew_password" type="password"
                                        class="form-control @error('renew_password') is-invalid @enderror"
                                        id="renew_password">
                                    @error('renew_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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
        const imageProfile = document.querySelector('#imageProfile');
        const updateButton = document.querySelector('#update-button');

        imgPreview.style.display = 'block';
        updateButton.style.display = 'inline-block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(imageProfile.files[0]);

        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        };
    }
</script>
@endsection

@section('script')
<script>
    const deleteButton = document.querySelectorAll('.delete');
        deleteButton.forEach((dBtn) => {
            dBtn.addEventListener('click', function (event) {
                event.preventDefault();
    
                const userId = this.dataset.id;
                Swal.fire({
                    title: 'Are you sure to delete this data?',
                    text: "You will delete data",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const dataId = document.getElementById('data-' + userId);
                                dataId.submit();
                                
                                Swal.fire(
                                    'Deleted!',
                                    'Your data has been deleted.',
                                    'success'
                                )
                            }
                })
            })
        });
</script>
@endsection