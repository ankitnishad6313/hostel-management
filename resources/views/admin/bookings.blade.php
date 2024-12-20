@extends('admin.main')
@push('title')
    <title>Bookings</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Bookings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Students</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <!-- Recent Bookings -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">

                    <div class="card-body">
                        <h5 class="card-title">Bookings</h5>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Hostel</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Booking Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $key => $student)
                                    <tr style="height: 100px;">
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>{{ $student->user->name }}</td>
                                        <td>{{ $student->hostel->hostel_name }}</td>
                                        <td>
                                            @if ($student->booking_status == 'booked')
                                                <h5 class="badge bg-success">Booked</h5>
                                            @elseif($student->booking_status == 'cancel')
                                                <h5 class="badge bg-danger">Cancel</h5>
                                            @else
                                                <h5 class="badge bg-warning">Pending</h5>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($student->boarding_status == 'onboarding')
                                                <h5 class="badge bg-success">On Bboarding</h5>
                                            @elseif($student->boarding_status == 'checked_out')
                                                <h5 class="badge bg-danger">Checked Out</h5>
                                            @else
                                                <h5 class="badge bg-warning">Pending</h5>
                                            @endif
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('admin-show-student', ['id' => $student->user->id]) }}">
                                                <button type="button" class="btn btn-success me-2"><i
                                                        class="bi bi-eye"></i></button>
                                            </a>
                                            <a
                                                href="{{ route('admin-edit-student', ['id' => $student->user->id]) }}">
                                                <button type="button" class="btn btn-warning me-2"><i
                                                        class="bi bi-pencil-square"></i></button>
                                            </a>
                                            <a
                                                href="{{ route('admin-destroy-student', ['id' => $student->user->id]) }}">
                                                <button type="button" class="btn btn-danger me-2"><i
                                                        class="bi bi-trash"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Recent Bookings -->
        </div>
    </section>

@endsection
