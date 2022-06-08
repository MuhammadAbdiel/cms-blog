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
    <h1>Templates</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/templates">Templates</a></li>
            <li class="breadcrumb-item active">Edit Template</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Template</h5>

                <form action="/dashboard/templates/{{ $template->id }}" method="POST" class="row g-3"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <label for="name" class="form-label">Template Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $template->name) }}" id="name" name="name">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        {{-- <input type="hidden" name="oldThumbnail" value="{{ $template->thumbnail }}">

                        @if ($template->thumbnail)
                        <img src="{{ asset('storage/' . $template->thumbnail) }}"
                            class="img-preview img-fluid mb-3 d-block" width="300">
                        @else
                        <img class="img-preview img-fluid mb-3" width="300">
                        @endif

                        <input class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail"
                            type="file" id="thumbnail" onchange="previewImage()">
                        @error('thumbnail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror --}}

                        @if ($template->image_thumbnail)
                        <img src="{{ $template->image_thumbnail }}" id="holder" class="d-block"
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
                            <input readonly value="{{ old('image_thumbnail', $template->image_thumbnail) }}"
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
                            hidden>{{ old('content', $template->lb_raw_content) }}</textarea>
                    </div>
                    <div class="text-center">
                        <a href="/dashboard/templates" class="btn btn-danger">Back</a>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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
                    target_preview.appendChild(holder);
                });
                
                // trigger change event
                target_preview.dispatchEvent(new Event('change'));
            };
        });
    };

    let route_prefix = "/filemanager";
    lfm('lfm', 'image', {prefix: route_prefix});
</script>
@endsection

@section('laraberg')
<script>
    Laraberg.init('content', { laravelFilemanager: true })
</script>
@endsection