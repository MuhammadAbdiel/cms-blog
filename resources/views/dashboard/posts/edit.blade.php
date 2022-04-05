@extends('dashboard.layouts.main')

@section('breadcrumb')
<div class="pagetitle">
    <h1>Posts</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/posts">Posts</a></li>
            <li class="breadcrumb-item active">Edit Post</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Post</h5>

                <form action="/dashboard/posts/{{ $post->slug }}" method="POST" enctype="multipart/form-data"
                    class="row g-3">
                    @csrf
                    @method('PUT')
                    {{-- <input type="hidden" name="slug" value="{{ $post->slug }}"> --}}
                    <div class="col-12">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $post->title) }}" id="title" name="title">
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="slug" class="form-label">Slug</label>
                        <input readonly type="text" class="form-control @error('slug') is-invalid @enderror"
                            value="{{ old('slug', $post->slug) }}" id="slug" name="slug">
                        @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" name="category_id" id="category_id">

                            @foreach ($categories as $category)
                            @if (old('category_id', $post->category_id) == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                            @endforeach

                        </select>
                    </div>
                    <div class="col-12">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        <input type="hidden" name="oldThumbnail" value="{{ $post->thumbnail }}">

                        @if ($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" class="img-preview img-fluid mb-3 d-block"
                            width="300">
                        @else
                        <img class="img-preview img-fluid mb-3" width="300">
                        @endif

                        <input class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail"
                            type="file" id="thumbnail" onchange="previewImage()">
                        @error('thumbnail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        @error('content')
                        <div class="alert alert-danger alert-dismissible fade show mt2" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @enderror
                        <textarea id="content" name="content"
                            hidden>{{ old('content', $post->lb_raw_content) }}</textarea>
                    </div>
                    <div class="text-center">
                        <a href="/dashboard/posts" class="btn btn-danger">Back</a>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');
    
    title.addEventListener('change', function(){
        fetch('/dashboard/posts/checkSlug?title='+title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });

    function previewImage() {
        const imgPreview = document.querySelector('.img-preview');
        const thumbnail = document.querySelector('#thumbnail');
        
        imgPreview.style.display = 'block';
        
        const oFReader = new FileReader();
        oFReader.readAsDataURL(thumbnail.files[0]);
        
        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        };
    }
</script>
@endsection

@section('laraberg')
<script>
    Laraberg.init('content', { laravelFilemanager: true })
</script>
@endsection