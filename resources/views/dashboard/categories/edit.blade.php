@extends('dashboard.layouts.main')

@section('breadcrumb')
<div class="pagetitle">
    <h1>Categories</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/categories">Categories</a></li>
            <li class="breadcrumb-item active">Edit Category</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Category</h5>

                <form action="/dashboard/categories/{{ $category->slug }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $category->name) }}" id="name" name="name">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="slug" class="form-label">Category Slug</label>
                        <input readonly type="text" class="form-control @error('slug') is-invalid @enderror"
                            value="{{ old('slug', $category->slug) }}" id="slug" name="slug">
                        @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <a href="/dashboard/categories" class="btn btn-danger">Back</a>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');
    
    name.addEventListener('change', function(){
        fetch('/dashboard/categories/checkSlug?name='+name.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    });
</script>
@endsection