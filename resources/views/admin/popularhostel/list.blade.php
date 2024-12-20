@extends('admin.main')
@push('title')
    <title>Popular Hostels / PG</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Hostels</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Hostels</a></li>
                <li class="breadcrumb-item active">Popular Hostels</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <h5 class="card-title">Popular Hostels / PG</h5>
                            <div>
                                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Add Popular Hostel
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Popular Hostel
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action=" {{ route('admin-store-popular-hostel') }}" method="post">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="col-12">
                                                        <label for="user_id" class="form-label fw-bold">Owner Name <sup
                                                                class="text-danger">*</sup></label>
                                                        <div class="input-group has-validation">
                                                            <span class="input-group-text" id="inputGroupPrepend"><i
                                                                    class="bi bi-person-circle"></i></span>
                                                            <select name="user_id" id="user_id" class="form-control"
                                                                required>
                                                                <option value="">Select Owner</option>
                                                                @foreach ($data['owners'] as $owner)
                                                                    <option value="{{ $owner->id }}">
                                                                        {{ $owner->name . ' | ' . $owner->phone }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="hostel_id" class="form-label fw-bold">Hostel Name <sup
                                                                class="text-danger">*</sup></label>
                                                        <div class="input-group has-validation">
                                                            <span class="input-group-text" id="inputGroupPrepend"><i
                                                                    class="bx bxs-building-house"></i></span>
                                                            <select name="hostel_id" id="hostel_id" class="form-control"
                                                                required></select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Table with stripped rows -->
                        <div class="table-responsive" style="overflow-x: scroll">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Profile Pic</th>
                                        <th>Hostel/PG Details</th>
                                        <th>Other Details</th>
                                        <th>Hostel Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['hostels'] as $key => $hostel)
                                        <tr>
                                            <th>{{ ++$key }}</th>
                                            <td><img src="{{ getImage($hostel->user->id, $hostel->user->image) }}"
                                                    height="80px" width="80px" alt="">
                                            <td>
                                                <span class="d-flex"><span class="fw-bold">Owner Name </span> :
                                                    {{ $hostel->user->name }}</span>
                                                <span class="d-flex"><span class="fw-bold">Hostel Name </span> :
                                                    {{ $hostel->hostel->hostel_name }}</span>
                                                <span class="d-flex"><span class="fw-bold">Address </span> :
                                                    {{ $hostel->hostel->hostel_address }}</span>
                                            </td>
                                            <td>
                                                <span class="d-flex"><span class="fw-bold">City </span> :
                                                    {{ $hostel->hostel->city }}</span>
                                                <span class="d-flex"><span class="fw-bold">Property Type </span> :
                                                    {{ $hostel->hostel->property_type }}</span>
                                                <span class="d-flex"><span class="fw-bold">Gender Type </span> :
                                                    {{ $hostel->hostel->gender_type }}</span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-lite dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        @if ($hostel->status == 'active')
                                                            Active
                                                        @else
                                                            Inactive
                                                        @endif
                                                    </button>
                                                    <ul class="dropdown-menu bg-danger-subtle">
                                                        <li class="">
                                                            <form
                                                                action="{{ route('admin-update-popular-hostel', ['id' => $hostel->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                <input type="hidden" name="status"
                                                                    value="{{ $hostel->status == 'active' ? 'inactive' : 'active' }}">
                                                                <button type="submit" class="dropdown-item">
                                                                    {{ $hostel->status == 'active' ? 'Inactive' : 'Active' }}
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin-show-hostel', ['id' => $hostel->id]) }}">
                                                    <button type="button" class="btn btn-success me-2"><i
                                                            class="bi bi-eye"></i></button>
                                                </a>
                                                <a href="{{ route('admin-edit-hostel', ['id' => $hostel->id]) }}">
                                                    <button type="button" class="btn btn-warning me-2"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                </a>
                                                <a href="{{ route('admin-destroy-popular-hostel', ['id' => $hostel->id]) }}"
                                                    onclick="return confirmDelete()">
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
@endsection

@section('script-section')
    <script>
        $(document).ready(function() {

            // Room
            $('#user_id').on('change', function() {
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
