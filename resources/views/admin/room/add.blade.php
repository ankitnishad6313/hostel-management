@extends('admin.main')
@push('title')
    <title>Add Room</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Rooms</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Room</a></li>
                <li class="breadcrumb-item active">Add Room</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body form-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Enter Room Details Below</h5>
                            <p class="text-center small">To Add a Room in Hostel</p>
                        </div>

                        <form action="{{ route('admin-store-room', ['id' => $hostel->id]) }}" method="POST"
                            enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf

                            <div class="col-12 col-lg-6">
                                <label for="hostel_id" class="form-label fw-bold">Hostel Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="hostel_id" id="hostel_id" class="form-control" @readonly(true)>
                                        <option value="{{ $hostel->id }}">{{ $hostel->hostel_name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="user_id" class="form-label fw-bold">Hostel Owner <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        <option value="{{ $hostel->user_id }}" @readonly(true)>{{ $hostel->user->name }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="floor" class="form-label fw-bold">Floor<sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="floor" id="floor" class="form-control" required>
                                        <option value="">Select Floor</option>
                                        <option value="ground">Ground Floor</option>
                                        <option value="first">First Floor</option>
                                        <option value="second">Second Floor</option>
                                        <option value="third">Third Floor</option>
                                        <option value="fourth">Fourth Floor</option>
                                        <option value="fifth">Fifth Floor</option>
                                        <option value="sixth">Sixth Floor</option>
                                        <option value="seventh">Seventh Floor</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="room_name" class="form-label fw-bold">Room Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <input type="text" name="room_name" value="{{ old('room_name') }}"
                                        class="form-control" id="room_name" placeholder="Enter Room Name" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="bed_type" class="form-label fw-bold">Room Type <small>(Number of Bed in this Room)</small><sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="bed_type" id="bed_type" class="form-control" required>
                                        <option value="">Select Bed</option>
                                        <option value="1">Single Bed</option>
                                        <option value="2">Double Bed</option>
                                        <option value="3">Triple Bed</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="room_price" class="form-label fw-bold">Room Rent <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <input type="number" name="room_price" value="{{ old('room_price') }}"
                                        class="form-control" id="room_price" placeholder="Enter Room Rent" required>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-50 text-center" type="submit">Add Room</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
