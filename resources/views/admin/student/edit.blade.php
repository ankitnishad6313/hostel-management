@extends('admin.main')
@push('title')
    <title>Edit Students</title>
@endpush
@section('main-section')
    <div class="pagetitle position-relative">
        <h1>Students</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Students</a></li>
                <li class="breadcrumb-item active">Edit Student</li>
            </ol>
        </nav>

        {{-- <div class="position-absolute top-0 end-0 p-2">
            <a href="{{ route('admin-edit-document', ['id' => $student->id]) }}" class="btn btn-outline-dark">Add / Edit
                Documents</a>
        </div> --}}
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body form-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Enter Student Details Below</h5>
                            <p class="text-center small">To create an Student Acount</p>
                        </div>

                        <form action="{{ route('admin-update-student', ['id' => $student->id]) }}" method="POST"
                            enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                            @csrf

                            <div class="col-12 col-lg-4">
                                <label for="name" class="form-label fw-bold">Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person"></i></span>
                                    <input type="text" name="name" value="{{ old('name', $student->name) }}"
                                        class="form-control" id="name" placeholder="Enter Name" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="father_name" class="form-label fw-bold">Father Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person"></i></span>
                                    <input type="text" name="father_name"
                                        value="{{ old('father_name', $student->father_name) }}" class="form-control"
                                        id="father_name" placeholder="Enter Father Name" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="mother_name" class="form-label fw-bold">Mother Name</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person"></i></span>
                                    <input type="text" name="mother_name"
                                        value="{{ old('mother_name', $student->mother_name) }}" class="form-control"
                                        id="mother_name" placeholder="Enter Mother Name">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="phone" class="form-label fw-bold">Phone Number <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-telephone"></i></span>
                                    <input type="number" name="phone" minlength="10" maxlength="10"
                                        value="{{ old('phone', $student->phone) }}" class="form-control" id="phone"
                                        placeholder="Enter Phone Number" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="email" name="email" value="{{ old('email', $student->email) }}"
                                        class="form-control" id="email" placeholder="Enter Your Email">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="gender" class="form-label fw-bold">Gender <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-gender-male"></i></span>
                                    <select name="gender" id="gender" class="form-select" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male"
                                            {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female"
                                            {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="father_mobile_no" class="form-label fw-bold">Father Mobile No <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-telephone"></i></span>
                                    <input type="number" name="father_mobile_no" minlength="10" maxlength="10"
                                        value="{{ old('father_mobile_no', $student->father_mobile_no) }}"
                                        class="form-control" id="father_mobile_no"
                                        placeholder="Enter Father Mobile Number" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="mother_mobile_no" class="form-label fw-bold">Mother Mobile No</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-telephone"></i></span>
                                    <input type="number" name="mother_mobile_no" minlength="10" maxlength="10"
                                        value="{{ old('mother_mobile_no', $student->mother_mobile_no) }}"
                                        class="form-control" id="mother_mobile_no"
                                        placeholder="Enter Mother Mobile Number">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="alternate_no" class="form-label fw-bold">Alternate Phone Number</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-telephone"></i></span>
                                    <input type="number" name="alternate_no" minlength="10" maxlength="10"
                                        value="{{ old('alternate_no', $student->alternate_no) }}" class="form-control"
                                        id="alternate_no" placeholder="Enter Alternate Number">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="status" class="form-label fw-bold">Status <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-gender-male"></i></span>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="active"
                                            {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive"
                                            {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="image" class="form-label fw-bold">Profile Pic</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person-square"></i></span>
                                    <input type="file" name="image" class="form-control" id="image">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="dob" class="form-label fw-bold">Date of Birth</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person-square"></i></span>
                                    <input type="date" name="dob" value="{{ old('dob', $student->dob) }}"
                                        class="form-control" id="dob">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="address" class="form-label fw-bold">Address</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-house"></i></span>
                                    <input type="text" name="address" value="{{ old('address', $student->address) }}"
                                        class="form-control" id="address" placeholder="Enter Address">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="current_address" class="form-label fw-bold">Current Address</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-house"></i></span>
                                    <input type="text" name="current_address"
                                        value="{{ old('current_address', $student->current_address) }}"
                                        class="form-control" id="current_address" placeholder="Enter Current Address"
                                        >
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="country" class="form-label fw-bold">Country</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-house"></i></span>
                                    <input type="text" name="country" value="{{ old('country', $student->country) }}"
                                        class="form-control" id="country" placeholder="Enter country">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="aadhar_no" class="form-label fw-bold">Aadhar Number</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" minlength="12" maxlength="12" name="aadhar_no"
                                        value="{{ old('aadhar_no', $student->aadhar_no) }}" class="form-control"
                                        id="aadhar_no" placeholder="Aadhar Number">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="aadhar_front" class="form-label fw-bold">Aadhar Front Image</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="file" name="aadhar_front" class="form-control" id="aadhar_front">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="aadhar_back" class="form-label fw-bold">Aadhar Back Image</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="file" name="aadhar_back" class="form-control" id="aadhar_back">
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-50 text-center" type="submit">Update Student</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection

@section('script-section')
    <script>
        $(document).ready(function() {
            // Room
            $('#hostel_id').on('change', function() {
                var hostel_id = this.value;
                $('#room_id').html('');
                $.ajax({
                    url: '{{ route('admin-get-room') }}?id=' + hostel_id,
                    type: 'get',
                    success: function(res) {
                        if (res.length > 0) {
                            $('#room_id').html(
                                '<option value="" selected>Select Room</option>');
                            $.each(res, function(key, value) {
                                $('#room_id').append('<option value="' + value
                                    .id + '">' + value.room_name + " | " + value
                                    .floor + " Floor" + '</option>');
                            });
                        } else {
                            $('#room_id').html(
                                '<option value="" selected>No Room Available in this Hostel</option>'
                            );
                        }
                    },

                    error: function(res) {
                        console.error('Error fetching Room data.');
                    }
                });
            });

            // Bed
            $('#room_id').on('change', function() {
                var room_id = this.value;
                $('#bed_id').html('');
                $.ajax({
                    url: '{{ route('admin-get-bed') }}?id=' + room_id,
                    type: 'get',
                    success: function(res) {
                        if (res.length > 0) {
                            $('#bed_id').html(
                                '<option value="" selected>Select Bed</option>');
                            $.each(res, function(key, value) {
                                $('#bed_id').append('<option value="' + value
                                    .id + '">' + value.bed_name + '</option>');
                            });
                        } else {
                            $('#bed_id').html(
                                '<option value="" selected>No Bed Available in this Room</option>'
                            );
                        }
                    },

                    error: function(res) {
                        console.error('Error fetching Bed data.');
                    }
                });
            });
        });
    </script>
@endsection
