@extends('admin.main')
@push('title')
    <title>Beds</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Beds</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Beds</a></li>
                <li class="breadcrumb-item active">Edit Beds</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body form-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Edit Bed Details Below</h5>
                            <p class="text-center small">To update a Bed in Room</p>
                        </div>

                        <form action="{{ route('admin-update-bed', ['id' => $bed->id]) }}" method="POST"
                            enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                            @csrf

                            <div class="col-12 col-lg-6 mx-auto">
                                <label for="bed_name" class="form-label fw-bold">Bed Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <input type="text" name="bed_name" value="{{ $bed->bed_name }}" class="form-control"
                                        id="bed_name" placeholder="Enter Bed Name" required>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-50 text-center" type="submit">Update Bed</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
