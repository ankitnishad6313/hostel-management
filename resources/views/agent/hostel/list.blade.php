@extends('agent.main')
@push('title')
    <title>All Hostels / PG</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Hostels</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('agent-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Hostels</li>
                <li class="breadcrumb-item active">All Hostels</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Hostels / PG</h5>

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
                                    @foreach ($hostels as $key => $hostel)
                                        <tr>
                                            <th>{{ ++$key }}</th>
                                            <td><img src="{{ getImage($hostel->user->id, $hostel->user->image) }}" height="80px" width="80px" alt="">
                                            <td>
                                                <span class="d-flex"><span class="fw-bold">Owner Name </span> : {{ $hostel->user->name }}</span>
                                              <span class="d-flex"><span class="fw-bold">Hostel Name </span> : {{ $hostel->hostel_name }}</span>
                                              <span class="d-flex"><span class="fw-bold">Address </span> : {{ $hostel->hostel_address }}</span>
                                            </td>
                                            <td>
                                                <span class="d-flex"><span class="fw-bold">City </span> : {{ $hostel->city }}</span>
                                                <span class="d-flex"><span class="fw-bold">Property Type </span> : {{ $hostel->property_type }}</span>
                                                <span class="d-flex"><span class="fw-bold">Gender Type </span> : {{ $hostel->gender_type }}</span>
                                            </td>
                                            <td>
                                                @if ($hostel->hostel_status == 'active')
                                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                        Active</span>
                                                @else
                                                    <span class="badge bg-danger"><i
                                                            class="bi bi-exclamation-octagon me-1"></i>
                                                        Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('agent-show-hostel', ['id' => $hostel->id]) }}">
                                                    <button type="button" class="btn btn-success me-2"><i
                                                            class="bi bi-eye"></i></button>
                                                </a>
                                                <a href="{{ route('agent-edit-hostel', ['id' => $hostel->id]) }}">
                                                    <button type="button" class="btn btn-warning me-2"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                </a>
                                                <a href="{{ route('agent-destroy-hostel', ['id' => $hostel->id]) }}">
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
