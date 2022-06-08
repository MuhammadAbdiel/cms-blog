@extends('dashboard.layouts.main')

@section('style')
<style>
    a#lfm:hover {
        background-color: #DDE0E3 !important;
    }
</style>
@endsection

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
                        {{-- <input type="hidden" name="oldThumbnail" value="{{ $post->thumbnail }}"> --}}

                        {{-- @if ($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" class="img-preview img-fluid mb-3 d-block"
                            width="300">
                        @else
                        <img class="img-preview img-fluid mb-3" width="300">
                        @endif --}}

                        {{-- <iframe src="/laravel-filemanager"
                            style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe> --}}

                        {{-- <input class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail"
                            type="file" id="thumbnail" onchange="previewImage()">
                        @error('thumbnail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror --}}

                        @if ($post->image_thumbnail)
                        <img src="{{ $post->image_thumbnail }}" id="holder" class="d-block"
                            style="margin-bottom: 10px; max-height:300px;">
                        @else
                        <img class="d-block" id="holder" style="margin-bottom: 10px; max-height:300px;">
                        @endif

                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="image_thumbnail" data-preview="holder"
                                    style="background-color: #E9ECEF; border: 1px solid #CED4DA" class="btn">
                                    Choose File
                                </a>
                            </span>
                            <input readonly value="{{ old('image_thumbnail', $post->image_thumbnail) }}"
                                id="image_thumbnail" class="form-control @error('image_thumbnail') is-invalid @enderror"
                                type="text" name="image_thumbnail">
                        </div>
                        @error('image_thumbnail')
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

@section('script')
<script>
    // $('#lfm').filemanager('image');

    let lfm = function(id, type, options) {
        let button = document.getElementById(id);
        
        button.addEventListener('click', function () {
            let route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
            let target_input = document.getElementById(button.getAttribute('data-input'));
            let target_preview = document.getElementById(button.getAttribute('data-preview'));
            
            window.open(route_prefix + '?type=' + type || 'file', 'FileManager', 'width=900,height=600');
            window.SetUrl = function (items) {
                let file_path = items.map(function (item) {
                    return item.url;
                }).join(',');
                
                // set the value of the desired input to image url
                target_input.value = file_path;
                target_input.dispatchEvent(new Event('change'));
                
                // clear previous preview
                target_preview.innerHtml = '';
                
                // set or change the preview image src
                items.forEach(function (item) {
                    const holder = document.querySelector('#holder');
                    holder.setAttribute('src', item.thumb_url);
                    // let img = document.createElement('img')
                    // img.setAttribute('style', 'height: 5rem')
                    // img.setAttribute('src', item.thumb_url)
                    // // img.setAttribute('id', 'holder')
                    target_preview.appendChild(holder);
                });
                
                // trigger change event
                target_preview.dispatchEvent(new Event('change'));
            };
        });
    };

    let route_prefix = "/filemanager";
    lfm('lfm', 'image', {prefix: route_prefix});

    // var route_prefix = "laravel-filemanager";
    // $('#lfm').filemanager('image', {prefix: route_prefix});

    // function imagePreview() {
    //     const holder = document.querySelector('#holder');
    //     const imageThumbnail = document.querySelector('#image-thumbnail');
        
    //     holder.style.display = 'block';
        
    //     const oFReader = new FileReader();
    //     oFReader.readAsDataURL(imageThumbnail.files[0]);
        
    //     oFReader.onload = function (oFREvent) {
    //         holder.src = oFREvent.target.result;
    //     };
    // }
</script>
@endsection

@section('laraberg')
<script>
    Laraberg.init('content', { laravelFilemanager: true })
</script>
@endsection