@extends('admin.main')
@push('title')
    <title>All Packages</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Packages</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Package</a></li>
                <li class="breadcrumb-item active">All Packages</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Packages</h5>
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Packages</th>
                                        <th scope="col">Content</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Validity</th>
                                        <th scope="col">Assign</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $key => $item)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ $item->package }}</td>
                                            <td>{!! $item->content !!}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->validity . " Days" }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary assign-package"
                                                    data-bs-toggle="modal" data-bs-target="#assignModal"
                                                    data-id="{{ $item->id }}" data-package="{{ $item->package }}">
                                                    Assign Package
                                                </button>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin-show-package', ['id' => $item->id]) }}">
                                                    <button type="button" class="btn btn-success mx-2"><i
                                                            class="bi bi-eye"></i></button>
                                                </a>
                                                <a href="{{ route('admin-edit-package', ['id' => $item->id]) }}">
                                                    <button type="button" class="btn btn-warning mx-2"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                </a>
                                                <a href="{{ route('admin-destroy-package', ['id' => $item->id]) }}" onclick="return confirmDelete()">
                                                    <button type="button" class="btn btn-danger mx-2"><i
                                                            class="bi bi-trash"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="modal" id="assignModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin-assign-package') }}" method="post" id="assign-form">
                        @csrf
                        <div class="row px-5">
                            <div class="col-12 mb-3">
                                <label for="package_id" class="col-sm-2 col-form-label fw-bold">Package<sup
                                        class="text-danger fw-bold">*</sup></label>
                                <input type="text" name="package" id="package" class="form-control" @required(true)
                                    @readonly(true)>
                                <input type="hidden" name="package_id" id="package_id" class="form-control"
                                    @required(true) @readonly(true)>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="user_id" class="form-label fw-bold">Owner Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person-circle"></i></span>
                                    <select name="user_id" id="owner_id" class="form-select">
                                        <option value="">Select Owner</option>
                                        @foreach ($owners as $owner)
                                            <option value="{{ $owner->id }}">{{ $owner->name . ' | ' . $owner->phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="hostel_id" class="form-label fw-bold">Hostel Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bx bxs-building-house"></i></span>
                                    <select name="hostel_id" id="hostel_id" class="form-select" required>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-4 mx-auto mb-3 text-center">
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-section')
    <script>
        $(document).ready(function() {
            $(".assign-package").click(function() {
                $("#assign-form:input").val('');
                $('#assign-form select').val('');
                $('#hostel_id').html('');
                var id = $(this).data('id');
                var package = $(this).data('package');

                $('#package_id').val(id);
                $('#package').val(package);
            });

            $('#owner_id').on('change', function() {
                var user_id = this.value;
                $('#hostel_id').html('');
                $.ajax({
                    url: '{{ route('get_hostel') }}?id=' + user_id,
                    type: 'get',
                    success: function(res) {
                        if (res.length > 0) {
                            $('#hostel_id').html(
                                '<option value="" selected>Select Hostel</option>');
                            $.each(res, function(key, value) {
                                $('#hostel_id').append('<option value="' + value
                                    .id + '">' + value.hostel_name + " | " + value
                                    .gender_type + " Hostel" + '</option>');
                            });
                        } else {
                            $('#hostel_id').html(
                                '<option value="" selected>No Hostel Found of this Owner</option>'
                            );
                        }
                    },

                    error: function(res) {
                        console.error('Error fetching Room data.');
                    }
                });
            });

        });
    </script>
@endsection
