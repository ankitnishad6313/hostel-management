@extends('admin.main')
@push('title')
    <title>Confirm Booking</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Students</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Students</li>
                <li class="breadcrumb-item active">Confirm Booking</li>
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
                            <p class="text-center small">To Confirm Booking</p>
                        </div>

                        <form action="{{ route('admin-confirm-booking', ['id' => $data->id]) }}" method="POST"
                            enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf

                            <div class="col-12">
                                <label for="hostel_id" class="form-label fw-bold">Hostel Name <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" name="hostel_id" id="hostel_id" class="form-control"
                                    value="{{ old('hostel_name', $data->hostel->hostel_name) }}" readonly>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="room_id" class="form-label fw-bold">Room Name <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" name="room_name" id="room_id" class="form-control"
                                    value="{{ old('room_name', $data->room->room_name) }}" readonly>

                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="bed_id" class="form-label fw-bold">Bed Name <sup
                                        class="text-danger">*</sup></label>
                                <input type="text" name="" id="bed_id" class="form-control"
                                    value="{{ old('bed_name', $data->bed->bed_name) }}" readonly>
                            </div>


                            <div class="col-12 col-lg-6">
                                <label for="check_in_date" class="form-label fw-bold">Check In Date <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bx bxs-calendar"></i></span>
                                    <input type="date" name="check_in_date"
                                        value="{{ old('check_in_date', $data->check_in_date) }}" class="form-control"
                                        id="check_in_date" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="check_out_date" class="form-label fw-bold">Check Out Date <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bx bxs-calendar"></i></span>
                                    <input type="date" name="check_out_date"
                                        value="{{ old('check_out_date', $data->check_out_date) }}" class="form-control"
                                        id="check_out_date" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="name" class="form-label fw-bold">Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person"></i></span>
                                    <input type="text" name="name" value="{{ old('name', $data->user->name) }}"
                                        class="form-control" id="name" placeholder="Enter Name" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="father_name" class="form-label fw-bold">Father Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person"></i></span>
                                    <input type="text" name="father_name"
                                        value="{{ old('father_name', $data->user->father_name) }}" class="form-control"
                                        id="father_name" placeholder="Enter Father Name" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="mother_name" class="form-label fw-bold">Mother Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person"></i></span>
                                    <input type="text" name="mother_name"
                                        value="{{ old('mother_name', $data->user->mother_name) }}" class="form-control"
                                        id="mother_name" placeholder="Enter Mother Name" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="phone" class="form-label fw-bold">Phone Number <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-telephone"></i></span>
                                    <input type="number" name="phone" minlength="10" maxlength="10"
                                        value="{{ old('phone', $data->user->phone) }}" class="form-control"
                                        id="phone" placeholder="Enter Phone Number" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="email" class="form-label fw-bold">Email <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="email" name="email" value="{{ old('email', $data->user->email) }}"
                                        class="form-control" id="email" placeholder="Enter Your Email" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="gender" class="form-label fw-bold">Gender <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-gender-male"></i></span>
                                    <select name="gender" id="gender" class="form-select" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ old('gender', $data->user->gender == 'Male') ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female" {{ old('gender', $data->user->gender == 'Female') ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="image" class="form-label fw-bold">Profile Pic</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person-square"></i></span>
                                    <input type="file" name="image" class="form-control" id="image">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="address" class="form-label fw-bold">Address <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-house"></i></span>
                                    <input type="text" name="address" value="{{ old('address', $data->user->address) }}"
                                        class="form-control" id="address" placeholder="Enter Address" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="rent" class="form-label fw-bold">Rent</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" name="rent"
                                        value="{{ old('rent', $data->room->room_price) }}" class="form-control"
                                        id="rent" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="pre_due_amount" class="form-label fw-bold">Previous Due Amount</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" name="pre_due_amount" value="{{ old('pre_due_amount', 0) }}"
                                        class="form-control" id="pre_due_amount" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="new_due_amount" class="form-label fw-bold">New Due Amount</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" name="new_due_amount" value="{{ old('new_due_amount', 0) }}"
                                        class="form-control" id="new_due_amount" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="security_amount" class="form-label fw-bold">Security Amount</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" name="security_amount"
                                        value="{{ old('security_amount', $data->hostel->security_amount) }}"
                                        class="form-control" id="security_amount" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="payment" class="form-label fw-bold">Payment <sup class="text-danger">* (Rent
                                        + Security Amount)</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" name="payment"
                                        value="{{ old('payment', $data->room->room_price + $data->hostel->security_amount) }}"
                                        min="0" class="form-control" id="payment"
                                        placeholder="Enter Payment Amount" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="payment_mode" class="form-label fw-bold">Payment Mode <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-credit-card"></i></span>
                                    <select name="payment_mode" id="payment_mode" class="form-select" required>
                                        <option value="" selected>Select Payment Mode</option>
                                        <option value="cash" {{ old('payment_mode' == 'cash') ? 'selected' : '' }}>Cash
                                        </option>
                                        <option value="card" {{ old('payment_mode' == 'card') ? 'selected' : '' }}>Card
                                        </option>
                                        <option value="online" {{ old('payment_mode' == 'online') ? 'selected' : '' }}>
                                            Online</option>
                                        <option value="other" {{ old('payment_mode' == 'other') ? 'selected' : '' }}>
                                            Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="lock_in_period_date" class="form-label fw-bold">Lock in Date <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bx bxs-calendar"></i></span>
                                    <input type="date" name="lock_in_period_date"
                                        value="{{ old('lock_in_period_date', $data->lock_in_period_date) }}"
                                        class="form-control" id="lock_in_period_date" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="next_due_date" class="form-label fw-bold">Next Due Date <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bx bxs-calendar"></i></span>
                                    <input type="date" name="next_due_date"
                                        value="{{ old('next_due_date', $data->next_due_date) }}" class="form-control"
                                        id="next_due_date" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="booking_status" class="form-label fw-bold">Booking Status <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-gender-male"></i></span>
                                    <select name="booking_status" id="booking_status" class="form-select" required>
                                        <option value="booked"
                                            {{ old('booking_status') == 'booked' ? 'selected' : '' }}>
                                            Booked</option>
                                        <option value="pending"
                                            {{ old('booking_status') == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        {{-- <option value="cancel"
                                            {{ old('booking_status', $data->booking_status) == 'cancel' ? 'selected' : '' }}>
                                            Cancel</option> --}}
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="boarding_status" class="form-label fw-bold">Boarding Status <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-gender-male"></i></span>
                                    <select name="boarding_status" id="boarding_status" class="form-select" required>
                                        <option value="onboarding"
                                            {{ old('boarding_status') == 'onboarding' ? 'selected' : '' }}>
                                            On Boarding</option>
                                        <option value="pending"
                                            {{ old('boarding_status') == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        {{-- <option value="cancel"
                                            {{ old('boarding_status', $data->boarding_status) == 'cancel' ? 'selected' : '' }}>
                                            Cancel</option> --}}
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="aadhar_no" class="form-label fw-bold">Aadhar Number</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" minlength="12" maxlength="12" name="aadhar_no"
                                        value="{{ old('aadhar_no', $data->user->aadhar_no) }}" class="form-control" id="aadhar_no"
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
                                <button class="btn btn-primary w-50 text-center" type="submit">Confirm Booking</button>
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
            $('#payment').keyup(function() {
                if ($(this).val() === "" || $(this).val() === "0") {
                    $(this).val(0);
                } else {
                    $(this).val($(this).val().replace(/^0+/, ''));
                }

                var payment = JSON.parse($(this).val());
                var security_amount = JSON.parse($('#security_amount').val());
                var rent = JSON.parse($("#rent").val());
                let amount = eval(((rent + security_amount) - payment));
                let final_am = amount < 0 ? 0 : amount
                $("#new_due_amount").val(final_am);
            });

        });
    </script>
@endsection
