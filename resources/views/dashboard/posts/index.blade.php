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

@section('style')
<style>
    i.my-handle {
        cursor: grab;
    }

    i.my-handle:active {
        cursor: grabbing;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Posts</h5>

                @if (!auth()->user()->is_admin)
                <a class="btn btn-primary" href="/dashboard/posts/create"><i class="bi bi-cursor-fill"></i> Select
                    Template</a>
                @endif

                <hr>

                <div class="row justify-content-center" id="post">

                    @foreach ($posts as $post)
                    <div id="col-{{ $loop->iteration }}" class="col-md-4">
                        <div id="card-{{ $loop->iteration }}" class="card">
                            <img src="" class="card-img-top">
                            <div class="card-body">

                                <div class="row justify-content-between align-items-center">
                                    <div class="col-10">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                    </div>
                                    <div class="col" style="text-align: right;">
                                        <i class="bi bi-arrows-move my-handle"></i>
                                    </div>
                                </div>

                                {{-- @if ($post->thumbnail)
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" class="card-img-top mb-3">
                                @else
                                <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}"
                                    class="card-img-top mb-3">
                                @endif --}}

                                @if ($post->image_thumbnail)
                                <img src="{{ $post->image_thumbnail }}" class="card-img-top mb-3">
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