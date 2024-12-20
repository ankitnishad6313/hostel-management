@extends('owner.main')
@push('title')
    <title>View Student</title>
@endpush
@section('main-section')
    <div class="pagetitle position-relative">
        <h1>Student</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('owner-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item active">Student Details</li>
            </ol>
        </nav>

        <div class="position-absolute top-0 end-0">
            <a href="{{ route('owner-edit-student', ['id' => $data->user->id]) }}" class="btn btn-sm btn-outline-dark">Edit
                Student</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $data->user->name }}</h5>
                        <!-- Default Tabs -->
                        <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100 active" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile-justified" type="button" role="tab"
                                    aria-controls="profile" aria-selected="false">Student Profile</button>
                            </li>

                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="booking-tab" data-bs-toggle="tab"
                                    data-bs-target="#booking-justified" type="button" role="tab"
                                    aria-controls="booking" aria-selected="false">Booking Details</button>
                            </li>

                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="documents-tab" data-bs-toggle="tab"
                                    data-bs-target="#documents-justified" type="button" role="tab"
                                    aria-controls="documents" aria-selected="false">Documents</button>
                            </li>

                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="documents-tab" data-bs-toggle="tab"
                                    data-bs-target="#payment-justified" type="button" role="tab"
                                    aria-controls="payment" aria-selected="false">Payment History</button>
                            </li>

                        </ul>
                        <!-- Tabs -->
                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                            <!-- Profile -->
                            <div class="tab-pane fade show active" id="profile-justified" role="tabpanel"
                                aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <section class="section profile">
                                            <div class="card">
                                                <div
                                                    class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                                    <img src="{{ getImage($data->user->id, $data->user->image) }}"
                                                        alt="Profile" class="rounded-circle">
                                                    <h3>{{ $data->user->name }}</h3>
                                                    <div class="social-links mt-2">
                                                        <a href="{{ $data->user->twitter }}" target="_blank"
                                                            class="twitter"><i class="bi bi-twitter"></i></a>
                                                        <a href="{{ $data->user->facebook }}" target="_blank"
                                                            class="facebook"><i class="bi bi-facebook"></i></a>
                                                        <a href="{{ $data->user->instagram }}" target="_blank"
                                                            class="instagram"><i class="bi bi-instagram"></i></a>
                                                        <a href="{{ $data->user->linkedin }}" target="_blank"
                                                            class="linkedin"><i class="bi bi-linkedin"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>

                                    <div class="col-xl-8">

                                        <div class="card">
                                            <div class="card-body pt-3">
                                                <!-- Bordered Tabs -->
                                                <ul class="nav nav-tabs nav-tabs-bordered">

                                                    <li class="nav-item">
                                                        <button class="nav-link active" data-bs-toggle="tab"
                                                            data-bs-target="#profile-overview">Overview</button>
                                                    </li>

                                                </ul>
                                                <div class="tab-content pt-2">

                                                    <div class="tab-pane fade show active profile-overview"
                                                        id="profile-overview">
                                                        <h5 class="card-title">About</h5>
                                                        <p class="small fst-italic">{{ $data->user->about }}</p>

                                                        <h5 class="card-title">Profile Details</h5>

                                                        <div class="row mb-2">
                                                            <div class="col-12 col-lg-4">
                                                                <span class="d-block fw-bold">Name</span>
                                                                {{ $data->user->name }}
                                                            </div>
                                                            <div class="col-12 col-lg-4">
                                                                <span class="d-block fw-bold">Father Name</span>
                                                                {{ $data->user->father_name }}
                                                            </div>
                                                            <div class="col-12 col-lg-4">
                                                                <span class="d-block fw-bold">Mother Name</span>
                                                                {{ $data->user->mother_name }}
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-4 fw-bold label">Date of Birth
                                                            </div>
                                                            <div class="col-lg-9 col-md-8">
                                                                {{ getDob($data->user->dob, 'd-M-Y') }}</div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-4 fw-bold label">Gender</div>
                                                            <div class="col-lg-9 col-md-8">
                                                                {{ $data->user->gender }}</div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-4 fw-bold label">Country</div>
                                                            <div class="col-lg-9 col-md-8">
                                                                {{ $data->user->country }}</div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-4 fw-bold label">Address</div>
                                                            <div class="col-lg-9 col-md-8">
                                                                {{ $data->user->address }}</div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-4 fw-bold label">Phone</div>
                                                            <div class="col-lg-9 col-md-8"><a
                                                                    href="tel:+91{{ $data->user->phone }} ">{{ $data->user->phone }}</a>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-4 fw-bold label">Email</div>
                                                            <div class="col-lg-9 col-md-8"><a
                                                                    href="mailto:{{ $data->user->email }}" >{{ $data->user->email }}</a>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div><!-- End Bordered Tabs -->

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- End Profile -->

                            <!-- Bookings -->
                            <div class="tab-pane fade" id="booking-justified" role="tabpanel"
                                aria-labelledby="booking-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Booking History</h5>
                                        <div class="table-responsive">
                                            <!-- Table with stripped rows -->
                                            <table class="table datatable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Hostel Name</th>
                                                        <th scope="col">Room Name</th>
                                                        <th scope="col">Floor</th>
                                                        <th scope="col">Bed Name</th>
                                                        <th scope="col">Check In Date</th>
                                                        <th scope="col">Check Out Date</th>
                                                        <th scope="col">Booking Status</th>
                                                        <th scope="col">Boarding Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($booking as $sr => $item)
                                                        <tr>
                                                            <th scope="row">{{ ++$sr }}</th>
                                                            <td>{{ $item->hostel->hostel_name }}</td>
                                                            <td>{{ $item->room->room_name }}</td>
                                                            <td>{{ $item->room->floor }}</td>
                                                            <td>{{ $item->bed->bed_name }}</td>
                                                            <td>{{ getFormatedDate($item->check_in_date, 'd-M-Y') }}</td>
                                                            <td>{{ getFormatedDate($item->check_out_date, 'd-M-Y') }}</td>
                                                            <td>
                                                                @if ($item->booking_status == 'booked')
                                                                    <span class="badge bg-success">
                                                                        <i class="bi bi-check-circle me-1"></i>
                                                                        Booked
                                                                    </span>
                                                                @elseif ($item->booking_status == 'pending')
                                                                    <span class="badge bg-warning">
                                                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                                                        Pending
                                                                    </span>
                                                                @else
                                                                    <span class="badge bg-danger"><i
                                                                            class="bi bi-exclamation-octagon me-1"></i>
                                                                        Cancel
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($item->boarding_status == 'onboarding')
                                                                    <span class="badge bg-success">
                                                                        <i class="bi bi-check-circle me-1"></i>
                                                                        Onboarding
                                                                    </span>
                                                                @elseif ($item->boarding_status == 'pending')
                                                                    <span class="badge bg-warning">
                                                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                                                        Pending
                                                                    </span>
                                                                @elseif ($item->boarding_status == 'checked_out')
                                                                    <span class="badge bg-danger"><i
                                                                            class="bi bi-exclamation-octagon me-1"></i>
                                                                        Checked Out
                                                                    </span>
                                                                @else
                                                                    <span class="badge bg-danger"><i
                                                                            class="bi bi-exclamation-octagon me-1"></i>
                                                                        Cancel
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <!-- End Table with stripped rows -->
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- End Bookings -->

                            <!-- Documents -->
                            <div class="tab-pane fade" id="documents-justified" role="tabpanel"
                                aria-labelledby="documents-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <h2>Document Details</h2>

                                        <div class="row g-3">
                                            <h3 class="text-center">Aadhar No. {{ $data->user->aadhar_no }}</h3>
                                            <div class="col-12 col-lg-6"><img src="{{ $data->user->aadhar_front }}"
                                                    alt="" class="img-fluid h-100 w-100 document-img"></div>
                                            <div class="col-12 col-lg-6"><img src="{{ $data->user->aadhar_back }}"
                                                    alt="" class="img-fluid h-100 w-100 document-img"></div>
                                        </div>
                                    </div> <!-- End Hostel -->
                                </div><!-- End Tabs -->
                            </div> <!-- End Documents -->

                            <!-- Payments -->
                            <div class="tab-pane fade" id="payment-justified" role="tabpanel"
                                aria-labelledby="payment-tab">
                                <div class="col-12">
                                    <div class="card recent-sales overflow-auto">

                                        <div class="card-body">
                                            <h5 class="card-title">Payment History</h5>

                                            <table class="table table-stripped datatable ">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Hostel Name</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Due Amount</th>
                                                        <th scope="col">Payment Mode</th>
                                                        <th scope="col">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($payments as $key => $item)
                                                        <tr>
                                                            <td>{{ ++$key }}</td>
                                                            <td>{{ $item->hostel_name }}</td>
                                                            <td>{{ $item->amount }}</td>
                                                            <td>{{ $item->due_amount }}</td>
                                                            <td>{{ $item->payment_mode }}</td>
                                                            <td>{{ getFormatedDate($item->created_at, 'd-F-Y g:i A') }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                </div>
                            </div><!-- End Payments -->

                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
