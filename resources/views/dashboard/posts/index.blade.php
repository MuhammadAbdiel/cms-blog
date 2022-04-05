@extends('dashboard.layouts.main')

@section('breadcrumb')
<div class="pagetitle">
    <h1>Posts</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/home">Home</a></li>
            <li class="breadcrumb-item active">Posts</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Posts</h5>

                <a class="btn btn-primary" href="/dashboard/posts/create"><i class="bi bi-cursor-fill"></i> Select
                    Template</a>
                <hr>

                <div class="row justify-content-center">

                    @foreach ($posts as $post)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>

                                @if ($post->thumbnail)
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" class="card-img-top mb-3">
                                @else
                                <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}"
                                    class="card-img-top mb-3">
                                @endif

                                <p class="card-text">{!! $post->excerpt !!}</p>
                                <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info">Show</a>
                                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning">Edit</a>
                                <form class="d-inline-block" id="data-{{ $post->slug }}"
                                    action="/dashboard/posts/{{ $post->slug }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-name="{{ $post->name }}" data-slug="{{ $post->slug }}"
                                        class="badge bg-danger border-0 delete">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="d-flex justify-content-end">
                    {{ $posts->links() }}
                </div>

                <!-- Table with stripped rows -->
                {{-- <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Title</th>
                            <th scope="col">Updated</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->updated_at }}</td>
                            <td>
                                <a href="/dashboard/posts/{{ $post->slug }}" class="btn btn-info mb-1"><i
                                        class="bi bi-eye-fill"></i> Show</a><br>
                                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning mb-1"><i
                                        class="bi bi-pencil-square"></i>
                                    Edit</a>
                                <form id="data-{{ $post->slug }}" action="/dashboard/posts/{{ $post->slug }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-title="{{ $post->title }}" data-slug="{{ $post->slug }}"
                                        class="btn btn-danger delete"><i class="bi bi-trash"></i>
                                        Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table> --}}
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

            const postSlug = this.dataset.slug;
            const postTitle = this.dataset.title;
            Swal.fire({
                title: 'Are you sure to delete this data?',
                text: "You will delete data with title: " + postTitle,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const dataSlug = document.getElementById('data-' + postSlug);
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