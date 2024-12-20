@extends('owner.main')
@push('title')
    <title>All Hostels / PG</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Students</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('owner-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Students</li>
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
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hostel/PG Details</th>
                                        <th>Cancelled</th>
                                        <th>Pending</th>
                                        <th>On Boarding</th>
                                        <th>Checked Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sno = 1;
                                    @endphp
                                    @foreach ($bookingsGrouped as $hostelId => $statuses)
                                        <tr>
                                            <td>{{ $sno++ }}</td>
                                            <td>{{ getHostelName($hostelId) }}</td>
                                            <td>
                                                <a href="{{ route('owner-cancelled-booking', ['id' => $hostelId]) }}" type="button" class="btn btn-danger">
                                                    {{ $statuses->get('cancel', 0) }} <i class="bi bi-arrow-right-square"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('owner-pending-booking', ['id' => $hostelId]) }}" type="button" class="btn btn-warning text-light">
                                                    {{ $statuses->get('pending', 0) }} <i class="bi bi-arrow-right-square"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('owner-student-list', ['id' => $hostelId]) }}" type="button" class="btn btn-success">
                                                    {{ $statuses->get('onboarding', 0) }} <i class="bi bi-arrow-right-square"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('owner-history-student', ['id' => $hostelId]) }}" type="button" class="btn btn-danger">
                                                    {{ $statuses->get('checked_out', 0) }} <i class="bi bi-arrow-right-square"></i>
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