@extends('dashboard.layouts.main')

@section('breadcrumb')
<div class="pagetitle">
    <h1>Templates</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/home">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/templates">Templates</a></li>
            <li class="breadcrumb-item active">Add New Templates</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add New Template</h5>

                <form action="/dashboard/templates" method="POST" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label for="name" class="form-label">Template Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="col-12">
                        <textarea id="content" name="content" hidden></textarea>
                    </div>
                    <div class="text-center">
                        <a href="/dashboard/templates" class="btn btn-danger">Back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection

@section('laraberg')
<script>
    Laraberg.init('content')
</script>
@endsection