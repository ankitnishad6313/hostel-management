@extends('admin.main')
@push('title')
    <title>Trashed Data</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Trashed Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Trashed Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if (!empty($data))
        {{-- User --}}
        @if(($data['users']) != null)
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Users</h5>

                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Profile Image</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['users'] as $key => $user)
                                            <tr style="height: 100px;">
                                                <th scope="row">{{ ++$key }}</th>
                                                <td><img src="{{ getImage($user->id, $user->image) }}" height="80px" width="80px"
                                                        alt="">
                                                </td>
                                                <td>
                                                    <span class="d-flex">Name : {{ $user->name }}</span>
                                                    <span class="d-flex">Email : {{ $user->email }}</span>
                                                    <span class="d-flex">Phone : {{ $user->phone }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    @if ($user->role == 'owner')
                                                        <span class="badge bg-info"><i class="bi bi-check-circle me-1"></i>
                                                            Owner</span>
                                                    @elseif ($user->role == 'agent')
                                                        <span class="badge bg-secondary"><i
                                                                class="bi bi-exclamation-octagon me-1"></i>
                                                            Agent</span>
                                                    @elseif ($user->role == 'student')
                                                        <span class="badge bg-primary"><i
                                                                class="bi bi-exclamation-octagon me-1"></i>
                                                            Student</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    @if ($user->status == 'active')
                                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                            Active</span>
                                                    @else
                                                        <span class="badge bg-danger"><i
                                                                class="bi bi-exclamation-octagon me-1"></i>
                                                            Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-danger align-middle" style="width: 100px !important">
                                                    <a href="{{ route('restore-user', ['id' => $user->id]) }}">
                                                        <button type="button" class="btn btn-warning me-2">Restore</button>
                                                    </a>

                                                    <a href="{{ route('force-delete-user', ['id' => $user->id]) }}">
                                                        <button type="button" class="btn btn-danger me-2">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->

                            </div>
                        </div>

                    </div>
                </div>
            </section>
        @endif

        {{-- Hostel --}}
        @if(!empty($data['hostel']))
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Hostels</h5>

                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Owner Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['hostel'] as $key => $hostel)
                                            <tr style="height: 100px;">
                                                <th scope="row">{{ ++$key }}</th>
                                                <td>{{ $hostel->hostel_name }}</td>
                                                <td>{{ $hostel->user->name }}</td>
                                                <td class="align-middle">
                                                    @if ($hostel->hostel_status == 'active')
                                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                            Active</span>
                                                    @else
                                                        <span class="badge bg-danger"><i
                                                                class="bi bi-exclamation-octagon me-1"></i>
                                                            Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-danger align-middle" style="width: 100px !important">
                                                    <a href="{{ route('restore-hostel', ['id' => $hostel->id]) }}">
                                                        <button type="button" class="btn btn-warning me-2">Restore</button>
                                                    </a>

                                                    <a href="{{ route('force-delete-hostel', ['id' => $hostel->id]) }}">
                                                        <button type="button" class="btn btn-danger me-2">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->

                            </div>
                        </div>

                    </div>
                </div>
            </section>
        @endif

        {{-- Popular Hostel --}}
        @if(!empty($data['popular']))
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Popular Hostels</h5>

                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['popular'] as $key => $hostel)
                                            <tr style="height: 100px;">
                                                <th scope="row">{{ ++$key }}</th>
                                                <td>
                                                    <span class="d-flex"><span class="fw-bold">Name : </span>
                                                        {{ $hostel->hostel->hostel_name }}</span>
                                                    <span class="d-flex"><span class="fw-bold">Owner Name : </span>
                                                        {{ $hostel->user->name }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    @if ($hostel->status == 'active')
                                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                            Active</span>
                                                    @else
                                                        <span class="badge bg-danger"><i
                                                                class="bi bi-exclamation-octagon me-1"></i>
                                                            Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-danger align-middle" style="width: 100px !important">
                                                    <a href="{{ route('restore-popular-hostel', ['id' => $hostel->id]) }}">
                                                        <button type="button" class="btn btn-warning me-2">Restore</button>
                                                    </a>

                                                    <a
                                                        href="{{ route('force-delete-popular-hostel', ['id' => $hostel->id]) }}">
                                                        <button type="button" class="btn btn-danger me-2">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->

                            </div>
                        </div>

                    </div>
                </div>
            </section>
        @endif
    @else
        <section class="section">
            <div class="row">
                <!-- Card with an image overlay -->
                <div class="card" style="max-height: 400px">
                    <img src="{{ url('/') }}/assets/img/recycle-bin.avif" style="height:400px; width:400px" class="card-img-top m-auto" alt="...">
                    <div class="card-img-overlay pagetitle">
                        <h1 class=" text-center" style="line-height: 330px;">No Data Found</h1>
                    </div>
                </div><!-- End Card with an image overlay -->
            </div>
        </section>
    @endif

@endsection
