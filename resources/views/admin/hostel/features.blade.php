@extends('admin.main')
@push('title')
    <title>Add Features</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Hostels</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Hostels</a></li>
                <li class="breadcrumb-item active">Add Features</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body form-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Enter Features Details Below</h5>
                        </div>

                        <form action="{{ route('admin-store-feature') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="feature" class="form-label fw-bold">Feature <sup
                                            class="text-danger">*</sup></label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="feature" value="{{ old('feature') }}"
                                            class="form-control" id="feature" placeholder="Hostel Feature" required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="feature" class="form-label fw-bold">Serial No.<sup
                                            class="text-danger">*</sup></label>
                                    <div class="input-group has-validation">
                                        <input type="number" name="serial" class="form-control" id="serial"
                                            value="{{ old('serial') }}" placeholder="Serial No." required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-50 text-center" type="submit">Add Feature</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Hostels / PG Features</h5>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive" style="overflow-x: scroll">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Features</th>
                                        <th>Serial No.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($features as $key => $feature)
                                        <tr>
                                            <th>{{ ++$key }}</th>
                                            <th>{{ $feature->features }}</th>
                                            <th>{{ $feature->serial }}</th>
                                            <td>
                                                <button type="button" class="btn btn-warning me-2 edit-features"
                                                    data-id="{{ $feature->id }}" data-features="{{ $feature->features }}"
                                                    data-serial="{{ $feature->serial }}" data-bs-toggle="modal"
                                                    data-bs-target="#featureModal">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <a href="{{ route('admin-destroy-feature', ['id' => $feature->id]) }}">
                                                    <button type="button" class="btn btn-danger me-2"><i
                                                            class="bi bi-trash"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="modal fade" id="featureModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Feature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="features-update-form" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="feature" class="form-label fw-bold">Feature <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <input type="text" name="edit_feature" class="form-control" id="edit-feature"
                                        placeholder="Hostel Feature" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="feature" class="form-label fw-bold">Serial No.<sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <input type="number" name="edit_serial" class="form-control" id="edit-serial"
                                        placeholder="Serial No." required>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center">
                            <button class="btn btn-primary w-50 text-center" type="submit">Update Feature</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- End Update Feature Modal-->
@endsection

@section('script-section')
    <script>
        $(document).ready(function() {
            $(".edit-features").click(function() {
                console.log("click");
                var id = $(this).data('id');
                var features = $(this).data('features');
                var serial = $(this).data('serial');

                var url = "{{ route('admin-update-feature', ['id' => ':id']) }}";
                var action = url.replace(':id', id);

                $("#features-update-form").attr('action', action);

                $('#edit-feature').val(features);
                $('#edit-serial').val(serial);
            });
        });
    </script>
@endsection
