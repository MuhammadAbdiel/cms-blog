@extends('layouts.app')

@section('single-post')

@if ($post->lb_raw_content)
{!! $post->lb_raw_content !!}
@else
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h1>{{ $post->title}}</h1>
            <article class="my-3 fs-6">
                {!! $post->body !!}
            </article>
        </div>
    </div>
</div>
@endif

@endsection