@extends('dashboard.layouts.main')

@section('breadcrumb')
<div class="pagetitle">
    <h1>Posts</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/posts">Posts</a></li>
            <li class="breadcrumb-item active">Select Template</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Select Templates</h5>
                <hr>

                <div class="row justify-content-center">

                    @foreach ($templates as $template)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $template->name }}</h5>

                                @if ($template->thumbnail)
                                <img src="{{ asset('storage/' . $template->thumbnail) }}" class="card-img-top mb-3">
                                @else
                                <img src="https://source.unsplash.com/500x400?template" class="card-img-top mb-3">
                                @endif

                                <p class="card-text"></p>
                                <a href="/dashboard/templates/{{ $template->id }}" class="badge bg-info">Show</a>
                                <form action="/dashboard/posts" method="post" class="d-inline-block">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $template->id }}">

                                    @if ($template->thumbnail)
                                    <input type="hidden" name="thumbnail" value="{{ $template->thumbnail }}">
                                    @endif

                                    <input type="hidden" name="content" value="{{ $template->lb_raw_content }}">
                                    <button type="submit" class="badge bg-success border-0">Select Template</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="text-center">
                    <a href="/dashboard/posts" class="btn btn-danger">Back</a>
                </div>


            </div>
        </div>

    </div>
</div>
@endsection