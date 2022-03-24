@extends('layouts.app')

@section('content')
<div class="row justify-content-center mb-5">
    <div class="col">
        <h1>{{ $post->title}}</h1>
        @if ($post -> image)
        <div class="" style="max-height: 400px; overflow: hidden;">
            <img class="img-fluid" src="{{ asset('storage/'.$post -> image) }}" alt="">
        </div>
        @else
        <img class="img-fluid" src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="">
        @endif
        <article class="my-3 fs-6">
            {!! $post->lb_raw_content !!}
        </article>
    </div>
</div>
@endsection