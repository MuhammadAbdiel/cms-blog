@extends('layouts.app')

@section('content')
<h1 class="text-center">{{ $heading }}</h1>

<div class="row justify-content-center mb-3 mt-5">
    <div class="col-md-6">
        <form action="/">

            @if (request()->has('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
            @endif

            @if (request()->has('author'))
            <input type="hidden" name="author" value="{{ request('author') }}">
            @endif

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search" name="search"
                    value="{{ request('search') }}">
                <button class="btn btn-dark" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>

<div class="card mb-5">
    <div class="position-absolute px-3 py-2 text-white" style="background-color: rgba(0, 0, 0, 0.7)"><a
            class="text-decoration-none text-white" href="/?category={{ $posts[0]->category->slug }}">
            {{ $posts[0]->category->name }}</a></div>

    @if ($posts[0]->thumbnail)
    <img src="{{ asset('storage/' . $posts[0]->thumbnail) }}" class="card-img-top" height="400" width="1200">
    @else
    <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="card-img-top">
    @endif

    <div class="card-body text-center">
        <h5 class="card-title">{{ $posts[0]->title }}</h5>
        <small>
            By. <a href="/?author={{ $posts[0]->author->username }}" class="text-decoration-none">{{
                $posts[0]->author->name }}</a>
            <span class="text-muted">{{
                $posts[0]->created_at->diffForHumans() }}</span>
        </small>
        <p class="card-text">{{ $posts[0]->excerpt }}</p>
        <a href="/{{ $posts[0]->slug }}" class="btn btn-dark">Read more</a>
    </div>
</div>

<div class="row justify-content-center">

    @foreach ($posts->skip(1) as $post)
    <div class="col-xl-3 col-lg-4 col-md-6 mb-3">
        <div class="card">
            <div class="position-absolute px-3 py-2 text-white" style="background-color: rgba(0, 0, 0, 0.7)"><a
                    class="text-decoration-none text-white" href="/?category={{ $post->category->slug }}">
                    {{ $post->category->name }}</a></div>
            <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="card-img-top">
            <div class="card-body text-center">
                <h5 class="card-title">{{ $post->title }}</h5>
                <small>
                    By. <a href="/?author={{ $post->author->username }}" class="text-decoration-none">{{
                        $post->author->name
                        }}</a> <span class="text-muted">{{ $post->created_at->diffForHumans() }}</span>
                </small>
                <p class="card-text">{{ $post->excerpt }}</p>
                <a href="/{{ $post->slug }}" class="btn btn-dark">Read more</a>
            </div>
        </div>
    </div>
    @endforeach

</div>

<div class="d-flex justify-content-end">
    {{ $posts->links() }}
</div>
@endsection