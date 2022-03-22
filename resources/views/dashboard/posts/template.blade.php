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
                <h5 class="card-title">Templates</h5>

                <a class="btn btn-primary" href="/dashboard/templates/create"><i class="bi bi-plus-square"></i> Add New
                    Template</a>
                <hr>

                <div class="row justify-content-center">

                    @foreach ($templates as $template)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $template->name }}</h5>
                                <p class="card-text"></p>
                                <a href="/dashboard/templates/{{ $template->id }}" class="badge bg-info">Show</a>
                                <a href="#" class="badge bg-warning">Edit</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>


            </div>
        </div>

    </div>
</div>
@endsection