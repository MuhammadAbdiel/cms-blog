@extends('dashboard.layouts.main')

@section('breadcrumb')
<div class="pagetitle">
    <h1>Posts</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/posts">Posts</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/select">Select Template</a></li>
            <li class="breadcrumb-item active">Add New Posts</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add New Post</h5>

                {{-- <form class="row g-3">
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="inputNanme4">
                    </div>
                    <div class="col-12">
                        <textarea id="[id_here]" name="[name_here]" hidden></textarea>
                    </div>
                    <div class="text-center">
                        <a href="/dashboard/posts" class="btn btn-danger">Back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form> --}}

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection