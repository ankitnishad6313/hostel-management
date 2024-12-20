@extends('owner.main')
@push('title')
    <title>Add Fee</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Fees</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('owner-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Fees</li>
                <li class="breadcrumb-item active">Add Fee</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body form-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Enter Fee Details Below</h5>
                        </div>

                        <form action="{{ route('owner-store-student-fee') }}" method="POST" enctype="multipart/form-data"
                            class="row g-3 needs-validation">
                            @csrf

                            <div class="col-12">
                                <label for="hostel_id" class="form-label fw-bold">Hostel Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bx bxs-building-house"></i></span>
                                    <select name="hostel_id" id="hostel_id" class="form-select" required>
                                        <option value="">Select Hostel</option>
                                        @foreach ($hostels as $hostel)
                                            <option value="{{ $hostel->id }}">
                                                {{ $hostel->hostel_name .' | ' . $hostel->gender_type . ' Hostel' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="student_id" class="form-label fw-bold">Select Student<sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person"></i></span>
                                    <select name="student_id" id="student_id" class="form-select" required>
                                        <option value="">Select Student</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="father_name" class="form-label fw-bold">Father Name</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person"></i></span>
                                    <input type="text" name="father_name" value="{{ old('father_name') }}"
                                        class="form-control" id="father_name" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="mother_name" class="form-label fw-bold">Mother Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person"></i></span>
                                    <input type="text" name="mother_name" value="{{ old('mother_name') }}"
                                        class="form-control" id="mother_name" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="phone" class="form-label fw-bold">Phone Number <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-telephone"></i></span>
                                    <input type="number" name="phone" minlength="10" maxlength="10"
                                        value="{{ old('phone') }}" class="form-control" id="phone"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="email" class="form-label fw-bold">Email <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control" id="email" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="check_in_date" class="form-label fw-bold">Check In Date <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bx bxs-calendar"></i></span>
                                    <input type="date" name="check_in_date" value="{{ old('check_in_date') }}"
                                        class="form-control" id="check_in_date" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="check_out_date" class="form-label fw-bold">Check Out Date <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bx bxs-calendar"></i></span>
                                    <input type="date" name="check_out_date" value="{{ old('check_out_date') }}"
                                        class="form-control" id="check_out_date" readonly>
                                </div>
                            </div>



                            <div class="col-12 col-lg-4 mb-3">
                                <label for="rent" class="form-label fw-bold">Rent</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" name="rent" class="form-control" id="rent" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 mb-3">
                                <label for="pre_due_amount" class="form-label fw-bold">Previous Due Amount</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" name="pre_due_amount" class="form-control" id="pre_due_amount" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 mb-3">
                                <label for="new_due_amount" class="form-label fw-bold">New Due Amount</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" name="new_due_amount" class="form-control" id="new_due_amount" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 mb-3">
                                <label for="security_amount" class="form-label fw-bold">Security Amount</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" name="security_amount" class="form-control" id="security_amount" readonly>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 mb-3">
                                <label for="payment" class="form-label fw-bold">Payment <sup
                                    class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-cash"></i></span>
                                    <input type="number" name="payment" class="form-control" id="payment" placeholder="Enter Payment Amount" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 mb-3">
                                <label for="payment_mode" class="form-label fw-bold">Payment Mode <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-credit-card"></i></span>
                                    <select name="payment_mode" id="payment_mode" class="form-select" required>
                                        <option value="" selected>Select Payment Mode</option>
                                        <option value="cash">Cash</option>
                                        <option value="card">Card</option>
                                        <option value="online">Online</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-50 text-center" type="submit">Submit Fee</button>
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
                $('#student_id').html('');
                $.ajax({
                    url: '{{ route("owner-get-booking") }}?id=' + hostel_id,
                    type: 'get',
                    success: function(res) {
                        if (res) {
                            $('#student_id').html(
                                '<option value="" selected>Select Student</option>');
                            $.each(res, function(key, value) {
                                $('#student_id').append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        } else {
                            $('#student_id').html(
                                '<option value="" selected>No Student Found in this Hostel</option>'
                            );
                        }
                    },

                    error: function(res) {
                        console.error('Error fetching Student data.');
                    }
                });
            });

            // Bed
            $('#student_id').on('change', function() {
                var student_id = this.value;
                $('#bed_id').html('');
                $.ajax({
                    url: '{{ route("owner-get-student-data") }}?id=' + student_id,
                    type: 'get',
                    success: function(res) {
                        if (res) {
                            $("#father_name").val(res.father_name);
                            $("#mother_name").val(res.mother_name);
                            $("#phone").val(res.phone);
                            $("#email").val(res.email);
                            $("#check_in_date").val(res.check_in_date);
                            $("#check_out_date").val(res.check_out_date);
                            $("#rent").val(res.rent);
                            $("#pre_due_amount").val(res.due_payment);
                            $("#new_due_amount").val('0');
                            $("#security_amount").val(res.security_amount);
                            var total_amount = eval(res.rent + + res.due_payment);
                            $("#payment").val(total_amount);
                        } else {
                            console.log('No Data Found')
                        }
                    },

                    error: function(res) {
                        console.error('Something Went Wrong.....');
                    }
                });
            });

            $('#payment').keyup(function(){
                var payment = $(this).val();
                var pre_due = $("#pre_due_amount").val();
                console.log(pre_due);
                var rent = $("#rent").val();
                console.log(rent);
                var total_amt = eval((pre_due + rent));
                console.log(total_amt);
                $("#new_due_amount").val(total_amt);
            })
        });
    </script>
@endsection
