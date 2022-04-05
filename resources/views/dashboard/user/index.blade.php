@extends('dashboard.layouts.main')

@section('breadcrumb')
<div class="pagetitle">
    <h1>Users</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/home">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Users</h5>

                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Posts</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                        <tr>

                            @php
                            $post = $user->posts()->count();
                            @endphp

                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td align="center">

                                @if ($user->is_admin == 1)
                                <span class="badge bg-success rounded-pill">Admin</span>
                                @else
                                <span class="badge bg-info rounded-pill">User</span>
                                @endif

                            </td>
                            <td align="center"><span class="badge bg-primary rounded-pill">{{ $post }}</span></td>
                            <td>

                                @if ($user->is_admin == 0)
                                <form class="d-inline-block" id="data-{{ $user->username }}"
                                    action="/dashboard/users/{{ $user->username }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-name="{{ $user->name }}"
                                        data-username="{{ $user->username }}" class="btn btn-danger delete"><i
                                            class="bi bi-trash"></i>
                                        Delete</button>
                                </form>
                                @endif

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <!-- End Table with stripped rows -->

            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
<script>
    const deleteButton = document.querySelectorAll('.delete');
    deleteButton.forEach((dBtn) => {
        dBtn.addEventListener('click', function (event) {
            event.preventDefault();

            const userUsername = this.dataset.username;
            const userName = this.dataset.name;
            Swal.fire({
                title: 'Are you sure to delete this data?',
                text: "You will delete data with name: " + userName,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const dataSlug = document.getElementById('data-' + userUsername);
                            dataSlug.submit();
                            
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