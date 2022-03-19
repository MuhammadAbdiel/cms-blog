@extends('dashboard.layouts.main')

@section('breadcrumb')
<div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Home</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
        <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">

                    <div class="card-body">
                        <h5 class="card-title">Posts</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-journal-album"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $posts }}</h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Sales Card -->

            <!-- Sales Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card">

                    <div class="card-body">
                        <h5 class="card-title">Templates</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-intersect"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $templates }}</h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card revenue-card">

                    <div class="card-body">
                        <h5 class="card-title">Categories</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-grid-1x2"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $categories }}</h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-3 col-xl-12">

                <div class="card info-card customers-card">

                    <div class="card-body">
                        <h5 class="card-title">Authors</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $authors }}</h6>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- End Customers Card -->

        </div>
    </div>
    <!-- End Left side columns -->

</div>
@endsection