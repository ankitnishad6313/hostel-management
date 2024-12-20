@extends('owner.main')
@push('title')
    <title>Student History</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Students</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('owner-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Students</li>
                <li class="breadcrumb-item active">Student History</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Students</h5>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive" style="overflow-x: scroll">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Student Details</th>
                                        <th scope="col">Other Details</th>
                                        <th scope="col">Booking Details</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $key => $student)
                                        <tr style="height: 100px;">
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>
                                                <img src="{{ getImage($student->user_id, $student->user->image) }}"
                                                    height="80px" width="80px" alt="">
                                            </td>
                                            <td>
                                                <span class="d-flex">Name : {{ $student->user->name }}</span>
                                                <span class="d-flex">Mother Name : {{ $student->user->mother_name }}</span>
                                                <span class="d-flex">Father Name : {{ $student->user->father_name }}</span>
                                                <span class="d-flex">Gender : {{ $student->user->gender }}</span>
                                            </td>
                                            <td>
                                                <span class="d-flex">Email : <a
                                                        href="mailto:{{ $student->user->email }}">{{ $student->user->email }}</a></span>
                                                <span class="d-flex">Phone : <a
                                                        href="tel:+91{{ $student->user->phone }}">{{ $student->user->phone }}</a></span>
                                                <span class="d-flex">Address : {{ $student->user->address }}</span>
                                            </td>
                                            <td>
                                                <span class="d-flex">Hostel:
                                                    {{ $student->hostel->hostel_name}}</span>
                                                <span class="d-flex">Room:
                                                    {{ $student->room->room_name }}</span>
                                                <span class="d-flex">Due Rent :
                                                    {{ $student->due_payment }}</span>
                                            </td>

                                            <td>
                                                <span class="d-flex">Check In:
                                                    {{ getFormatedDate($student->check_in_date, 'd-M-Y') }}</span>
                                                <span class="d-flex">Check Out:
                                                    {{ getFormatedDate($student->check_out_date, 'd-M-Y') }}</span>
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
