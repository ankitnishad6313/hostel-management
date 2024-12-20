@extends('owner.main')
@push('title')
    <title>Add Bed</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Beds</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('owner-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Beds</li>
                <li class="breadcrumb-item active">Add Bed</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body form-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Enter Bed Details Below</h5>
                            <p class="text-center small">To add a Bed in Room</p>
                        </div>

                        <form action="{{ route('owner-store-bed', ['id' => $hostel->id]) }}" method="POST"
                            enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf

                            <div class="col-12">
                                <label for="hostel_id" class="form-label fw-bold">Hostel Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="hostel_id" id="hostel_id" class="form-control" @readonly(true)>
                                        <option value="{{ $hostel->id }}">{{ $hostel->hostel_name }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="room_id" class="form-label fw-bold">Room <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="room_id" id="room_id" class="form-control" required>
                                        <option value="">Select Room</option>
                                        @foreach ($hostel->room as $room)
                                        <option value="{{ $room->id }}" @readonly(true)>{{ $room->room_name . " | " . $room->floor . " Floor"}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="bed_name" class="form-label fw-bold">Bed Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <input type="text" name="bed_name" value="{{ old('bed_name') }}"
                                        class="form-control" id="bed_name" placeholder="Enter Bed Name" required>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-50 text-center" type="submit">Add Bed</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
