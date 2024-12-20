@extends('admin.main')
@push('title')
    <title>{{ $data['hostel']->hostel_name }}</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Hostels</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Hostels</a></li>
                <li class="breadcrumb-item active">Hostel Details</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="card-title">{{ $data['hostel']->hostel_name }}</h5>
                                <p class="card-text">{{ $data['hostel']->city }}, {{ $data['hostel']->hostel_address }}</p>
                            </div>
    
                            <div class="row row-cols-1 row-cols-sm-auto g-3 mb-4">
                                <div class="d-flex flex-wrap gap-3 justify-content-center">
                                    <a href="{{ route('admin-edit-hostel', ['id' => $data['hostel']->id]) }}"><button
                                            type="button" class="btn btn-outline-success"><i class="bi bi-star me-2"></i> Edit
                                            Hostel</button></a>
                                    <a href="{{ route('admin-create-room', ['id' => $data['hostel']->id]) }}"><button
                                            type="button" class="btn btn-outline-primary"><i class="bi bi-star me-2"></i> Add
                                            Room</button></a>
                                    <a href="{{ route('admin-create-bed', ['id' => $data['hostel']->id]) }}"><button
                                            type="button" class="btn btn-outline-info"><i class="bi bi-star me-2"></i> Add
                                            Bed</button></a>
                                </div>
                            </div>
                        </div>

                        <!-- Default Tabs -->
                        <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100 active" id="hostel-tab" data-bs-toggle="tab"
                                    data-bs-target="#hostel-justified" type="button" role="tab" aria-controls="hostel"
                                    aria-selected="true">Hostel</button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile-justified" type="button" role="tab"
                                    aria-controls="profile" aria-selected="false">Owner Profile</button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="student-tab" data-bs-toggle="tab"
                                    data-bs-target="#student-justified" type="button" role="tab"
                                    aria-controls="student" aria-selected="false">Students</button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="room-tab" data-bs-toggle="tab"
                                    data-bs-target="#room-justified" type="button" role="tab" aria-controls="room"
                                    aria-selected="false">Rooms</button>
                            </li>
                            <li class="nav-item flex-fill" role="presentation">
                                <button class="nav-link w-100" id="bed-tab" data-bs-toggle="tab"
                                    data-bs-target="#bed-justified" type="button" role="tab" aria-controls="bed"
                                    aria-selected="false">Beds</button>
                            </li>
                        </ul>
                        <!-- Tabs -->
                        <div class="tab-content pt-2" id="myTabjustifiedContent">
                            <!-- Hostel -->
                            <div class="tab-pane fade show active" id="hostel-justified" role="tabpanel"
                                aria-labelledby="hostel-tab">
                                @empty(!$data['hostel']->hostel_images)
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Hostel Images</h5>

                                            <!-- Slides with indicators -->
                                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-indicators">

                                                    @foreach ($data['hostel']->hostel_images as $sno => $val)
                                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                                            data-bs-slide-to="{{ $sno }}"
                                                            class="{{ $sno == 0 ? 'active' : '' }}"
                                                            aria-current="{{ $sno == 0 ? 'true' : '' }}"
                                                            aria-label="Slide {{ ++$sno }}"></button>
                                                    @endforeach

                                                </div>
                                                <div class="carousel-inner">

                                                    @foreach ($data['hostel']->hostel_images as $key => $image)
                                                        <div
                                                            class="carousel-item {{ $key == 0 ? 'active' : '' }} position-relative">
                                                            <img src="{{ $image }}" class="d-block w-100 img-fluid"
                                                                height="400px" alt="...">
                                                            <div class="position-absolute top-0 end-0 p-2">
                                                                <form
                                                                    action="{{ route('admin-delete-hostel-image', ['id' => $data['hostel']->id]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="image"
                                                                        value="{{ $image }}">
                                                                    <input type="hidden" name="key"
                                                                        value="{{ $key }}">
                                                                    <button type="submit"
                                                                        class="btn btn-danger text-nowrap"><i
                                                                            class="bi bi-trash"></i> Delete Image</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>

                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>

                                            </div><!-- End Slides with indicators -->


                                        </div>
                                    </div>
                                @endempty

                                @empty(!$data['hostel']->hostel_description)
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Hostel Description</h5>
                                            {!! $data['hostel']->hostel_description !!}
                                        </div>
                                    </div>
                                @endempty

                                @empty(!$data['hostel']->hostel_policy)
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Hostel Policy</h5>
                                            {!! $data['hostel']->hostel_policy !!}
                                        </div>
                                    </div>
                                @endempty

                                @empty(!$data['hostel']->hostel_features)
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Hostel Features</h5>
                                            <p class="card-text">A desirable or useful feature or facility of a hostel and
                                                places.</p>
                                            <ul>
                                                @foreach ($data['hostel']->hostel_features as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endempty

                                @empty(!$data['hostel']->youtube_video_link)
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">YouTube Video</h5>
                                            <iframe width="100%" height="350"
                                                src="{{ $data['hostel']->youtube_video_link }}" title="YouTube video player"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                @endempty

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Nearby</h5>

                                        <!-- Bordered Tabs -->
                                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="restaurants-tab" data-bs-toggle="tab"
                                                    data-bs-target="#bordered-restaurants" type="button" role="tab"
                                                    aria-controls="restaurants" aria-selected="true">Restaurants</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="coachings-tab" data-bs-toggle="tab"
                                                    data-bs-target="#bordered-coachings" type="button" role="tab"
                                                    aria-controls="coachings" aria-selected="false">Coaching
                                                    Centers</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="hospitals-tab" data-bs-toggle="tab"
                                                    data-bs-target="#bordered-hospitals" type="button" role="tab"
                                                    aria-controls="hospitals" aria-selected="false">Hospitals</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="shopping_malls-tab" data-bs-toggle="tab"
                                                    data-bs-target="#bordered-shopping_malls" type="button"
                                                    role="tab" aria-controls="shopping_malls"
                                                    aria-selected="false">Shopping Malls</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content pt-2" id="borderedTabContent">
                                            <div class="tab-pane fade show active" id="bordered-restaurants"
                                                role="tabpanel" aria-labelledby="restaurants-tab">
                                                {!! $data['hostel']->restaurants !!}
                                            </div>
                                            <div class="tab-pane fade" id="bordered-coachings" role="tabpanel"
                                                aria-labelledby="coachings-tab">
                                                {!! $data['hostel']->coachings !!}
                                            </div>
                                            <div class="tab-pane fade" id="bordered-hospitals" role="tabpanel"
                                                aria-labelledby="hospitals-tab">
                                                {!! $data['hostel']->hospitals !!}
                                            </div>
                                            <div class="tab-pane fade" id="bordered-shopping_malls" role="tabpanel"
                                                aria-labelledby="shopping_malls-tab">
                                                {!! $data['hostel']->shopping_malls !!}
                                            </div>
                                        </div><!-- End Bordered Tabs -->

                                    </div>
                                </div>

                            </div> <!-- End Hostel -->

                            <!-- Profile -->
                            <div class="tab-pane fade" id="profile-justified" role="tabpanel"
                                aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <section class="section profile">
                                            <div class="card">
                                                <div
                                                    class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                                    <img src="{{ getImage($data['hostel']->user->id, $data['hostel']->user->image) }}"
                                                        alt="Profile" class="rounded-circle">
                                                    <h3>{{ $data['hostel']->user->name }}</h3>
                                                    <div class="social-links mt-2">
                                                        <a href="{{ $data['hostel']->user->twitter }}" target="_blank"
                                                            class="twitter"><i class="bi bi-twitter"></i></a>
                                                        <a href="{{ $data['hostel']->user->facebook }}" target="_blank"
                                                            class="facebook"><i class="bi bi-facebook"></i></a>
                                                        <a href="{{ $data['hostel']->user->instagram }}" target="_blank"
                                                            class="instagram"><i class="bi bi-instagram"></i></a>
                                                        <a href="{{ $data['hostel']->user->linkedin }}" target="_blank"
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
                                                        <p class="small fst-italic">{{ $data['hostel']->user->about }}</p>

                                                        <h5 class="card-title">Profile Details</h5>

                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                                            <div class="col-lg-9 col-md-8">
                                                                {{ $data['hostel']->user->name }}</div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                                                            <div class="col-lg-9 col-md-8">
                                                                {{ getDob($data['hostel']->user->dob, 'd-M-Y') }}</div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-4 label">Gender</div>
                                                            <div class="col-lg-9 col-md-8">
                                                                {{ $data['hostel']->user->gender }}</div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-4 label">Country</div>
                                                            <div class="col-lg-9 col-md-8">
                                                                {{ $data['hostel']->user->country }}</div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-4 label">Address</div>
                                                            <div class="col-lg-9 col-md-8">
                                                                {{ $data['hostel']->user->address }}</div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-4 label">Phone</div>
                                                            <div class="col-lg-9 col-md-8"><a
                                                                    href="tel:+91{{ $data['hostel']->user->phone }}"
                                                                    class="text-dark">{{ $data['hostel']->user->phone }}</a>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-4 label">Email</div>
                                                            <div class="col-lg-9 col-md-8"><a
                                                                    href="mailto:{{ $data['hostel']->user->email }}"
                                                                    class="text-dark">{{ $data['hostel']->user->email }}</a>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div><!-- End Bordered Tabs -->

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- End Profile -->

                            <!-- Students -->
                            <div class="tab-pane fade" id="student-justified" role="tabpanel"
                                aria-labelledby="student-tab">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">All Students</h5>

                                                <!-- Table with stripped rows -->
                                                <div class="table-responsive" style="overflow-x: scroll">
                                                    <table class="table table-borderless datatable">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Image</th>
                                                                <th scope="col">Student Details</th>
                                                                <th scope="col">Other Details</th>
                                                                <th scope="col">Booking Details</th>
                                                                <th scope="col">Gender</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data['booking'] as $key => $student)
                                                                <tr style="height: 100px;">
                                                                    <th scope="row">{{ ++$key }}</th>
                                                                    <td><img src="{{ getImage($student->id, $student->image) }}"
                                                                            height="80px" width="80px" alt="">
                                                                    </td>
                                                                    <td>
                                                                        <span class="d-flex">Name :
                                                                            {{ $student->name }}</span>
                                                                        <span class="d-flex">Mother Name :
                                                                            {{ $student->mother_name }}</span>
                                                                        <span class="d-flex">Father Name :
                                                                            {{ $student->father_name }}</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="d-flex">Email :
                                                                            <a
                                                                                href="mailto:{{ $student->email }}">{{ $student->email }}</a></span>
                                                                        <span class="d-flex">Phone :
                                                                            <a
                                                                                href="tel:{{ $student->phone }}">{{ $student->phone }}</a></span>
                                                                        <span class="d-flex">Address :
                                                                            {{ $student->address }}</span>
                                                                    </td>
                                                                    <td>
                                                                        <span class="d-flex">Room No. :
                                                                            {{ $student->room_name }}</span>
                                                                        <span class="d-flex">Rent :
                                                                            {{ $student->rent }}</span>
                                                                        <span class="d-flex">Due Rent :
                                                                            {{ $student->due_payment }}</span>
                                                                    </td>
                                                                    <td>{{ $student->gender }}</td>
                                                                    <td>
                                                                        @if ($student->status == 'active')
                                                                            <span class="badge bg-success"><i
                                                                                    class="bi bi-check-circle me-1"></i>
                                                                                Active</span>
                                                                        @else
                                                                            <span class="badge bg-danger"><i
                                                                                    class="bi bi-exclamation-octagon me-1"></i>
                                                                                Inactive</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a
                                                                            href="{{ route('admin-show-student', ['id' => $student->id]) }}">
                                                                            <button type="button"
                                                                                class="btn btn-success me-2"><i
                                                                                    class="bi bi-eye"></i></button>
                                                                        </a>
                                                                        <a
                                                                            href="{{ route('admin-edit-student', ['id' => $student->id]) }}">
                                                                            <button type="button"
                                                                                class="btn btn-warning me-2"><i
                                                                                    class="bi bi-pencil-square"></i></button>
                                                                        </a>
                                                                        <a
                                                                            href="{{ route('admin-destroy-student', ['id' => $student->id]) }}">
                                                                            <button type="button"
                                                                                class="btn btn-danger me-2"><i
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
                            </div><!-- End Students -->

                            <!-- Rooms -->
                            <div class="tab-pane fade" id="room-justified" role="tabpanel" aria-labelledby="room-tab">
                                <div class="col-12">
                                    <div class="card recent-sales overflow-auto">

                                        <div class="card-body">
                                            <h5 class="card-title">Rooms</h5>

                                            <table class="table table-borderless datatable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Room Name</th>
                                                        <th scope="col">Floor</th>
                                                        <th scope="col">Bed Type</th>
                                                        <th scope="col">Bed Rent</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data['hostel']->room as $key => $room)
                                                        <tr>
                                                            <th scope="row">{{ ++$key }}</th>
                                                            <td>{{ $room->room_name }}</td>
                                                            <td>{{ $room->floor }}</td>
                                                            <td>
                                                                <h5>
                                                                    @if ($room->bed_type == 1)
                                                                        <span class="badge bg-success">Single Bed</span>
                                                                    @elseif ($room->bed_type == 2)
                                                                        <span class="badge bg-info">Double Bed</span>
                                                                    @else
                                                                        <span class="badge bg-primary">Triple Bed</span>
                                                                    @endif
                                                                </h5>
                                                            </td>
                                                            <td>{{ $room->room_price }}</td>
                                                            <td>
                                                                @if ($room->room_status == 'available')
                                                                    <span class="badge bg-success"><i
                                                                            class="bi bi-check-circle me-1"></i>
                                                                        Available</span>
                                                                @else
                                                                    <span class="badge bg-danger"><i
                                                                            class="bi bi-exclamation-octagon me-1"></i>
                                                                        Booked</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a
                                                                    href="{{ route('admin-show-room', ['id' => $room->id]) }}">
                                                                    <button type="button" class="btn btn-success me-2"><i
                                                                            class="bi bi-eye"></i></button>
                                                                </a>
                                                                <a
                                                                    href="{{ route('admin-edit-room', ['id' => $room->id]) }}">
                                                                    <button type="button" class="btn btn-warning me-2"><i
                                                                            class="bi bi-pencil-square"></i></button>
                                                                </a>
                                                                <a
                                                                    href="{{ route('admin-destroy-room', ['id' => $room->id]) }}">
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
                                </div>
                            </div><!-- End Rooms -->

                            <!-- Bed -->
                            <div class="tab-pane fade" id="bed-justified" role="tabpanel" aria-labelledby="bed-tab">
                                <div class="col-12">
                                    <div class="card recent-sales overflow-auto">

                                        <div class="card-body">
                                            <h5 class="card-title">Beds</h5>

                                            <table class="table table-borderless datatable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Bed Details</th>
                                                        <th scope="col">Room Type</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data['hostel']->bed as $key => $bed)
                                                        <tr>
                                                            <th scope="row">{{ ++$key }}</th>
                                                            <td>
                                                                <span class="d-flex"><span class="fw-bold">Name: </span>
                                                                    {{ $bed->bed_name }}</span>
                                                                <span class="d-flex"><span class="fw-bold">Room Name:
                                                                    </span> {{ $bed->room->room_name }}</span>
                                                                <span class="d-flex"><span class="fw-bold">Floor: </span>
                                                                    {{ $bed->room->floor }}</span>
                                                            </td>
                                                            <td>
                                                                <h5>
                                                                    @if ($bed->bed_type == 1)
                                                                        <span class="badge bg-success">Single Bed</span>
                                                                    @elseif ($bed->bed_type == 2)
                                                                        <span class="badge bg-info">Double Bed</span>
                                                                    @else
                                                                        <span class="badge bg-primary">Triple Bed</span>
                                                                    @endif
                                                                </h5>
                                                            </td>
                                                            <td>
                                                                @if ($bed->bed_status == 'available')
                                                                    <span class="badge bg-success"><i
                                                                            class="bi bi-check-circle me-1"></i>
                                                                        Available</span>
                                                                @else
                                                                    <span class="badge bg-danger"><i
                                                                            class="bi bi-exclamation-octagon me-1"></i>
                                                                        Booked</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($bed->bed_status == 'booked')
                                                                    <a
                                                                        href="{{ route('admin-show-bed', ['id' => $bed->id]) }}">
                                                                        <button type="button"
                                                                            class="btn btn-success me-2"><i
                                                                                class="bi bi-eye"></i></button>
                                                                    </a>
                                                                @endif
                                                                <a
                                                                    href="{{ route('admin-edit-bed', ['id' => $bed->id]) }}">
                                                                    <button type="button" class="btn btn-warning me-2"><i
                                                                            class="bi bi-pencil-square"></i></button>
                                                                </a>
                                                                <a
                                                                    href="{{ route('admin-destroy-bed', ['id' => $bed->id]) }}">
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
                                </div>
                            </div> <!-- End Bed -->
                        </div><!-- End Tabs -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
