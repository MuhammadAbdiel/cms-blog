@extends('dashboard.layouts.main')

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
                        <input type="hidden" name="oldThumbnail" value="{{ $template->thumbnail }}">

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

@section('laraberg')
<script>
    Laraberg.init('content', { laravelFilemanager: true })
</script>
@endsection