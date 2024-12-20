@extends('agent.main')
@push('title')
    <title>Agent Dashboard</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('agent-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Added Owners Card -->
                    <div class="col-lg-4 col-sm-12">
                        <div class="card info-card sales-card">
                      
                            <a href="{{ route('agent-list-owner') }}">
                                <div class="card-body">
                                    <h5 class="card-title">Added Owners </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $data['owners']->count() }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div><!-- End Added Owners Card -->

                    <!-- Added Hostels Card -->
                    <div class="col-lg-4 col-sm-12">
                        <div class="card info-card revenue-card">

                            <a href="{{ route('agent-list-hostel') }}">
                                <div class="card-body">
                                    <h5 class="card-title">Added Hostels </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-buildings-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $data['hostels']->count() }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div><!-- End Added Hostels Card -->

                    <!-- Recent Added Owners -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                           
                            <div class="card-body">
                                <h5 class="card-title">Recent Added Owners</h5>

                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Profile Image</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Total Hostels</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['owners'] as $key => $owner)
                                            <tr style="height: 100px;">
                                                <th scope="row">{{ ++$key }}</th>
                                                <td>
                                                    <a href="{{ route('agent-show-owner', ['id' => $owner->id]) }}"><img src="{{ getImage($owner->id, $owner->image) }}" height="80px" width="80px" alt="Something went Wrong!"></a>
                                                </td>
                                                <td>
                                                    <span class="d-flex">Name : {{ $owner->name }}</span>
                                                    <span class="d-flex">Email : {{ $owner->email }}</span>
                                                    <span class="d-flex">Phone : {{ $owner->phone }}</span>
                                                    <span class="d-flex">Address : {{ $owner->address }}</span>
                                                </td>
                                                <td>{{ $owner->hostels->count() }}</td>
                                                <td>
                                                    @if ($owner->status == 'active')
                                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                            Active</span>
                                                    @else
                                                        <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>
                                                            Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('agent-show-owner', ['id' => $owner->id]) }}">
                                                        <button type="button" class="btn btn-success me-2"><i
                                                                class="bi bi-eye"></i></button>
                                                    </a>
                                                    <a href="{{ route('agent-edit-owner', ['id' => $owner->id]) }}">
                                                        <button type="button" class="btn btn-warning me-2"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </a>
                                                    {{-- <a href="{{ route('agent-destroy-owner', ['id' => $owner->id]) }}">
                                                        <button type="button" class="btn btn-danger me-2"><i
                                                                class="bi bi-trash"></i></button>
                                                    </a> --}}
                                                </td>
                                            </tr>

                                            @php
                                                if ($key == 9) {
                                                    break;
                                                }
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Added Owners -->

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

                                <table class="table datatable">
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
                                        @foreach ($data['hostels'] as $key => $hostel)
                                            <tr>
                                                <th>{{ ++$key }}</th>
                                                <td>{{ $hostel->hostel_name }}</td>
                                                <td><a href="{{ route('agent-show-owner', ['id' => $hostel->user->id]) }}">{{ $hostel->user->name }}</a></td>
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
                                            @php
                                            if ($key == 9) {
                                                break;
                                            }
                                        @endphp
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Added Hostels -->

                </div>
            </div><!-- End Left side columns -->

        </div>
    </section>
@endsection
