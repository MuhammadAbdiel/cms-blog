@extends('dashboard.layouts.main')

@section('breadcrumb')
<div class="pagetitle">
    <h1>Templates</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/home">Home</a></li>
            <li class="breadcrumb-item active">Templates</li>
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

                                @if ($template->thumbnail)
                                <img src="{{ asset('storage/' . $template->thumbnail) }}" class="card-img-top mb-3">
                                @else
                                <img src="https://source.unsplash.com/500x400?template" class="card-img-top mb-3">
                                @endif

                                <p class="card-text"></p>
                                <a href="/dashboard/templates/{{ $template->id }}" class="badge bg-info">Show</a>
                                <a href="/dashboard/templates/{{ $template->id }}/edit"
                                    class="badge bg-warning">Edit</a>
                                <form class="d-inline-block" id="data-{{ $template->id }}"
                                    action="/dashboard/templates/{{ $template->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" data-name="{{ $template->name }}"
                                        data-id="{{ $template->id }}"
                                        class="badge bg-danger border-0 delete">Delete</button>
                                </form>
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

@section('script')
<script>
    const deleteButton = document.querySelectorAll('.delete');
        deleteButton.forEach((dBtn) => {
            dBtn.addEventListener('click', function (event) {
                event.preventDefault();
    
                const templateId = this.dataset.id;
                const templateName = this.dataset.name;
                Swal.fire({
                    title: 'Are you sure to delete this data?',
                    text: "You will delete data with name: " + templateName,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const dataId = document.getElementById('data-' + templateId);
                                dataId.submit();
                                
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
@endsection