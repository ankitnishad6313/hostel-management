@extends('admin.main')
@push('title')
    <title>Add Student</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Students</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Student</a></li>
                <li class="breadcrumb-item active">Add Student</li>
            </ol>
        </nav>
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

                        <form action="{{ route('admin-store-student') }}" method="POST" enctype="multipart/form-data"
                            class="row g-3 needs-validation" novalidate>
                            @csrf

                            <div class="col-12 col-lg-6">
                                <label for="hostel_id" class="form-label fw-bold">Hostel Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bx bxs-building-house"></i></span>
                                    <select name="hostel_id" id="hostel_id" class="form-select" required>
                                        <option value="">Select Hostel</option>
                                        @foreach ($hostels as $hostel)
                                            <option value="{{ $hostel->id }}">
                                                {{ $hostel->hostel_name . ' | ' . $hostel->user->name . ' | ' . $hostel->gender_type . ' Hostel' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <label for="room_id" class="form-label fw-bold">Room Number <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="ri-building-4-line"></i></span>
                                    <select name="room_id" id="room_id" class="form-select" required></select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-3">
                                <label for="bed_id" class="form-label fw-bold">Bed Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="bx bxs-bed"></i></span>
                                    <select name="bed_id" id="bed_id" class="form-select" required></select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="rent" class="form-label fw-bold">Rent <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" name="rent" value="{{ old('rent') }}" class="form-control" id="rent"
                                        placeholder="Rent" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="security_amount" class="form-label fw-bold">Security Amount <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" name="security_amount" value="{{ old('security_amount') }}" class="form-control"
                                        id="security_amount" placeholder="Security Amount" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="payment" class="form-label fw-bold">Payment <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" name="payment" value="{{ old('payment') }}" class="form-control" id="payment"
                                        placeholder="Enter Payment Amount" required>
                                </div>
                            </div>

                            {{-- <div class="col-12 col-lg-4">
                                <label for="pre_due_amount" class="form-label fw-bold">Previous Due Amount</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" name="pre_due_amount" value="{{ old('pre_due_amount', 0) }}"
                                        class="form-control" id="pre_due_amount" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="new_due_amount" class="form-label fw-bold">New Due Amount</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" name="new_due_amount" value="{{ old('new_due_amount', 0) }}"
                                        class="form-control" id="new_due_amount" readonly>
                                </div>
                            </div> --}}

                            <div class="col-12 col-lg-6">
                                <label for="payment_mode" class="form-label fw-bold">Payment Mode <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-credit-card"></i></span>
                                    <select name="payment_mode" id="payment_mode" class="form-select" required>
                                        <option value="" selected>Select Payment Mode</option>
                                        <option value="cash" {{ (old('payment_mode') == "cash") ? "selected" : "" }}>Cash</option>
                                        <option value="card" {{ (old('payment_mode') == "card") ? "selected" : "" }}>Card</option>
                                        <option value="online" {{ (old('payment_mode') == "online") ? "selected" : "" }}>Online</option>
                                        <option value="other" {{ (old('payment_mode') == "other") ? "selected" : "" }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="booking_status" class="form-label fw-bold">Booking Status <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-gender-male"></i></span>
                                    <select name="booking_status" id="booking_status" class="form-select" required>
                                        <option value="">Select Booking Status</option>
                                        <option value="pending" {{ (old('booking_status') == "pending") ? "selected" : "" }}>Pending</option>
                                        <option value="booked" {{ (old('booking_status') == "booked") ? "selected" : "" }}>Booked</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="boarding_status" class="form-label fw-bold">Boarding Status <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-gender-male"></i></span>
                                    <select name="boarding_status" id="boarding_status" class="form-select" required>
                                        <option value="">Select Boarding Status</option>
                                        <option value="pending" {{ (old('boarding_status') == "pending") ? "selected" : "" }}>Pending</option>
                                        <option value="onboarding" {{ (old('boarding_status') == "onboarding") ? "selected" : "" }}>On Boarding</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="check_in_date" class="form-label fw-bold">Check In Date <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bx bxs-calendar"></i></span>
                                    <input type="date" name="check_in_date" value="{{ old('check_in_date') }}"
                                        class="form-control" id="check_in_date" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="check_out_date" class="form-label fw-bold">Check Out Date <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bx bxs-calendar"></i></span>
                                    <input type="date" name="check_out_date" value="{{ old('check_out_date') }}"
                                        class="form-control" id="check_out_date" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="lock_in_period_date" class="form-label fw-bold">Lock in Date <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bx bxs-calendar"></i></span>
                                    <input type="date" name="lock_in_period_date"
                                        value="{{ old('lock_in_period_date') }}"
                                        class="form-control" id="lock_in_period_date" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="next_due_date" class="form-label fw-bold">Next Due Date <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bx bxs-calendar"></i></span>
                                    <input type="date" name="next_due_date"
                                        value="{{ old('next_due_date') }}" class="form-control"
                                        id="next_due_date" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="name" class="form-label fw-bold">Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person"></i></span>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                        id="name" placeholder="Enter Name" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="father_name" class="form-label fw-bold">Father Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person"></i></span>
                                    <input type="text" name="father_name" value="{{ old('father_name') }}"
                                        class="form-control" id="father_name" placeholder="Enter Father Name" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="mother_name" class="form-label fw-bold">Mother Name</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person"></i></span>
                                    <input type="text" name="mother_name" value="{{ old('mother_name') }}"
                                        class="form-control" id="mother_name" placeholder="Enter Mother Name">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="phone" class="form-label fw-bold">Phone Number <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-telephone"></i></span>
                                    <input type="number" name="phone" minlength="10" maxlength="10"
                                        value="{{ old('phone') }}" class="form-control" id="phone"
                                        placeholder="Enter Phone Number" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control" id="email" placeholder="Enter Your Email">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="dob" class="form-label fw-bold">Date of Birth</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bx bxs-calendar"></i></span>
                                    <input type="date" name="dob"
                                        value="{{ old('dob') }}"
                                        class="form-control" id="dob">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="status" class="form-label fw-bold">Status <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-gender-male"></i></span>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="">Select Status</option>
                                        <option value="active" {{ (old('status') == "active") ? "selected" : "" }}>Active</option>
                                        <option value="inactive" {{ (old('status') == "inactive") ? "selected" : "" }}>Inactive</option>
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
                                        value="{{ old('father_mobile_no') }}"
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
                                        value="{{ old('mother_mobile_no') }}"
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
                                        value="{{ old('alternate_no') }}" class="form-control"
                                        id="alternate_no" placeholder="Enter Alternate Number">
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
                                        <option value="Male" {{ (old('gender') == "Male") ? "selected" : "" }}>Male</option>
                                        <option value="Female" {{ (old('gender') == "Female") ? "selected" : "" }}>Female</option>
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
                                <label for="address" class="form-label fw-bold">Address</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-house"></i></span>
                                    <input type="text" name="address" value="{{ old('address') }}"
                                        class="form-control" id="address" placeholder="Enter Address">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="current_address" class="form-label fw-bold">Current Address</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-house"></i></span>
                                    <input type="text" name="current_address"
                                        value="{{ old('current_address') }}"
                                        class="form-control" id="current_address" placeholder="Enter Current Address"
                                        >
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="country" class="form-label fw-bold">Country</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-house"></i></span>
                                    <input type="text" name="country" value="{{ old('country') }}"
                                        class="form-control" id="country" placeholder="Enter country">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="aadhar_no" class="form-label fw-bold">Aadhar Number</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" minlength="12" maxlength="12" name="aadhar_no"
                                        value="{{ old('aadhar_no') }}" class="form-control" id="aadhar_no"
                                        placeholder="Aadhar Number">
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
                                <button class="btn btn-primary w-50 text-center" type="submit">Add Student</button>
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
                                    .floor + " Floor | Bed Type => " + value
                                    .bed_type + '</option>');
                            });
                            $('#security_amount').val(res[0].security_amount);
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
                        if (res) {
                            $('#bed_id').html(
                                '<option value="" selected>Select Bed</option>');
                            $.each(res, function(key, value) {
                                $('#bed_id').append('<option value="' + value
                                    .id + '">' + value.bed_name + '</option>');
                            });
                            $('#rent').val(res[0].room_price);
                            var rent = parseFloat($('#rent').val());
                            var securityAmount = parseFloat($('#security_amount').val());
                            $('#payment').val(rent + securityAmount);
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

            $('#rent').keyup(function() {
                var security_amount = parseInt($('#security_amount').val());
                var rent = parseInt($("#rent").val());
                $('#payment').val(rent+security_amount)
            });

            // $('#payment').keyup(function() {
            //     var security_amount = parseInt($('#security_amount').val());
            //     var rent = parseInt($("#rent").val());
            //     var payment = parseInt($('#payment').val());
            //     let due_amount = rent+security_amount - payment
            //     $("#new_due_amount").val(due_amount);
            // });

            $('#security_amount').keyup(function() {
                var security_amount = parseInt($(this).val()) ?? 0;
                var rent = parseInt($("#rent").val());
                $('#payment').val(rent+security_amount)
            });
        });
    </script>
@endsection
