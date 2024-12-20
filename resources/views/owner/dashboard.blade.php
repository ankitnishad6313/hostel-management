@extends('owner.main')
@push('title')
    <title>Owner Dashboard</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('owner-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Hostels Card -->
                    <div class="col-lg-4 col-sm-12">
                        <div class="card info-card sales-card">

                            {{-- <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div> --}}
                            <a href="{{ route('owner-list-hostel') }}">
                                <div class="card-body">
                                    <h5 class="card-title">Hostels </h5> {{-- <span>| Today</span> --}}

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-buildings-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $data['hostels'] }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div><!-- End Hostels Card -->

                    <!-- Students Card -->
                    <div class="col-lg-4 col-sm-12">
                        <div class="card info-card revenue-card">

                            {{-- <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div> --}}
                            <a href="{{ route('owner-list-student') }}">
                                <div class="card-body">
                                    <h5 class="card-title">Students </h5> {{-- <span>| This Month</span> --}}

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $data['students']->count() }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div><!-- End Students Card -->

                    <!-- Enquiries -->
                    <div class="col-lg-4 col-sm-12">

                        <div class="card info-card customers-card">

                            <a href="{{ route('owner-list-enquiry') }}">
                                <div class="card-body">
                                    <h5 class="card-title">Enquiries </h5> {{-- <span>| This Year</span> --}}

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-chat-left-text-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $data['enquiries_count'] }}</h6>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>

                    </div><!-- End Enquiries Card -->

                    <!-- Recent Bookings -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">Recent Bookings</h5>

                                <div class="table-responsive">
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Booking Details</th>
                                                <th scope="col">Status</th>
                                                {{-- <th scope="col">Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['recent_bookings'] as $key => $student)
                                                <tr style="height: 100px;">
                                                    <th scope="row">{{ ++$key }}</th>
                                                    <td>{{ $student->user->name }}</td>
                                                    <td>
                                                        <span class="d-flex">{{ $student->hostel->hostel_name }}</span>
                                                        <span class="d-flex">Check In Date: {{ getFormatedDate($student->check_in_date, 'd-F-Y')  }}</span>
                                                        <span class="d-flex">Check Out Date: {{ getFormatedDate($student->check_out_date, 'd-F-Y') }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($student->booking_status == 'booked')
                                                            <h5 class="badge bg-success">Booked</h5>
                                                        @elseif($student->booking_status == 'cancel')
                                                            <h5 class="badge bg-danger">Cancel</h5>
                                                        @else
                                                            <h5 class="badge bg-warning">Pending</h5>
                                                        @endif
                                                    </td>
                                                    {{-- <td>
                                                        <a
                                                            href="{{ route('owner-show-student', ['id' => $student->user->id]) }}">
                                                            <button type="button" class="btn btn-success me-2"><i
                                                                    class="bi bi-eye"></i></button>
                                                        </a>
                                                        <a
                                                            href="{{ route('owner-edit-student', ['id' => $student->user->id]) }}">
                                                            <button type="button" class="btn btn-warning me-2"><i
                                                                    class="bi bi-pencil-square"></i></button>
                                                        </a>
                                                        <a
                                                            href="{{ route('owner-destroy-student', ['id' => $student->user->id]) }}">
                                                            <button type="button" class="btn btn-danger me-2"><i
                                                                    class="bi bi-trash"></i></button>
                                                        </a>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div><!-- End Recent Bookings -->

                    <!-- Recent Added Hostels -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            {{-- <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div> --}}

                            <div class="card-body pb-0">
                                <h5 class="card-title">Recent Added Hostels</h5> {{-- <span>| Today</span> --}}

                                <table class="table datatable table-borderless">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Hostel/PG</th>
                                            <th>Owner Name</th>
                                            <th>Added On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['recent_hostels'] as $key => $hostel)
                                            <tr>
                                                <th>{{ ++$key }}</th>
                                                <td>{{ $hostel->hostel_name }}</td>
                                                <td>{{ $hostel->user->name }}</td>
                                                <td>{{ getFormatedDate($hostel->created_at, 'd-M-Y') }}</td>
                                                <td>
                                                    <a href="{{ route('owner-show-hostel', ['id' => $hostel->id]) }}">
                                                        <button type="button" class="btn btn-success me-2"><i
                                                                class="bi bi-eye"></i></button>
                                                    </a>
                                                    <a href="{{ route('owner-edit-hostel', ['id' => $hostel->id]) }}">
                                                        <button type="button" class="btn btn-warning me-2"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </a>
                                                    <a href="{{ route('owner-destroy-hostel', ['id' => $hostel->id]) }}">
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
                    </div><!-- End Recent Added Hostels -->
                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Notification -->
                <div class="card">

                    <div class="card-body pb-0">
                        <h5 class="card-title">Notifications </h5>

                        <div class="news">

                            @forelse ($data['notifications'] as $notification)
                                <div class="post-item clearfix">
                                    <img src="{{ getImage($notification->user->id, $notification->user->image) }}"
                                        style="height: 50px; width:50px; object-fit:fit" alt="">
                                    <h4>
                                        <a
                                            href="{{ route('owner-show-student', ['id' => $notification->user_id]) }}">{{ $notification->user->name }}</a>
                                    </h4>
                                    <p>"<b>Reminder:</b> Check-out date expired on
                                        {{ getFormatedDate($notification->check_out_date, 'd-M-Y') }}. Action required on
                                        overdue bookings."</p>
                                </div>
                            @empty
                                <p>No Notification Found in last 7 days.</p>
                            @endforelse

                            <div>
                                {{ $data['notifications']->links() }}
                            </div>

                        </div><!-- End sidebar Enquiries -->

                    </div>
                </div><!-- End Notification -->

                <!-- Enquiries -->
                <div class="card">

                    <div class="card-body pb-0">
                        <h5 class="card-title">Enquiries </h5>

                        <div class="news">

                            @forelse ($data['enquiries'] as $enquiry)
                                <div class="post-item clearfix">
                                    <img src="{{ getImage($enquiry->user->id, $enquiry->user->image) }}"
                                        style="height: 50px; width:50px; object-fit:fit" alt="">
                                    <h4><a
                                            href="{{ route('owner-show-enquiry', ['id' => $enquiry->hostel_id]) }}">{{ $enquiry->name }}</a>
                                    </h4>
                                    <p>{{ substr($enquiry->description, 0, 30) }}</p>
                                </div>
                            @empty
                            <p>No Enuiries Found in last 7 days.</p>
                            @endforelse
                        </div><!-- End sidebar Enquiries -->
                        @if ($data['enquiries']->lastPage() > 1)
                            <ul class="pagination">
                                <li class="{{ $data['enquiries']->currentPage() == 1 ? 'disabled' : '' }}">
                                    <a href="{{ $data['enquiries']->url(1) }}" class="btn btn-secondary m-1">Previous</a>
                                </li>
                                @for ($i = max(1, $data['enquiries']->currentPage() - 2); $i <= min($data['enquiries']->lastPage(), $data['enquiries']->currentPage() + 2); $i++)
                                    <li class="{{ $data['enquiries']->currentPage() == $i ? 'active' : '' }}">
                                        <a href="{{ $data['enquiries']->url($i) }}" class="btn btn-secondary m-1">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li
                                    class="{{ $data['enquiries']->currentPage() == $data['enquiries']->lastPage() ? 'disabled' : '' }}">
                                    <a
                                        href="{{ $data['enquiries']->url($data['enquiries']->currentPage() + 1) }}" class="btn btn-secondary m-1">Next</a>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div><!-- End Enquiries -->

            </div><!-- End Right side columns -->

        </div>
    </section>
@endsection
