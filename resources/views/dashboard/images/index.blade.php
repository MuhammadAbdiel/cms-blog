@extends('dashboard.layouts.main')

@section('breadcrumb')
<div class="pagetitle">
    <h1>Images</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/home">Home</a></li>
            <li class="breadcrumb-item active">Images</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Images</h5>



            </div>
        </div>

    </div>
</div>
@endsection

{{-- @section('script')
<script>
    const deleteButton = document.querySelectorAll('.delete');
    deleteButton.forEach((dBtn) => {
        dBtn.addEventListener('click', function (event) {
            event.preventDefault();

            const categorySlug = this.dataset.slug;
            const categoryName = this.dataset.name;
            Swal.fire({
                title: 'Are you sure to delete this data?',
                text: "You will delete data with name: " + categoryName,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const dataSlug = document.getElementById('data-' + categorySlug);
                            dataSlug.submit();
                            
                            Swal.fire(
                                'Deleted!',
                                'Your data has been deleted.',
                                'success'
                            )
                        }
            })
        })
    });
</script>
@endsection --}}