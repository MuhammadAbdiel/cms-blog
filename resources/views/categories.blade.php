@extends('layouts.app')

@section('content')
<h1 class="text-center">Post Categories</h1>

<div class="row justify-content-center mt-5">

    @foreach ($categories as $category)
    <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
        <a href="/?category={{ $category->slug }}">
            <div class="card bg-dark text-white">
                <img src="https://source.unsplash.com/500x500?{{ $category->name }}" class="card-img">
                <div class="card-img-overlay d-flex align-items-center p-0">
                    <h5 class="card-title text-center flex-fill p-3 fs-4" style="background-color: rgba(0, 0, 0, 0.7)">
                        {{ $category->name }}</h5>
                </div>
            </div>
        </a>
    </div>
    @endforeach

</div>
@endsection