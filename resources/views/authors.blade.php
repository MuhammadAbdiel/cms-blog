@extends('layouts.app')

@section('content')
<h1 class="text-center">Post Author</h1>
<ol class="list-group list-group-numbered mt-5">

    @foreach ($authors as $author)

    @php
    $post = $author->posts()->count();
    @endphp

    <li class="list-group-item d-flex justify-content-between align-items-start">
        <div class="ms-2 me-auto">
            <div class="fw-bold">{{ $author->name }}</div>
            {{ $author->username }}
        </div>
        <span class="badge bg-primary rounded-pill">{{ $post }}</span>
    </li>
    @endforeach

</ol>
@endsection