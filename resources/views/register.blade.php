@extends('main')
@push('title')
    <title>NearMeHostels | Registration</title>
@endpush
@section('main-section')
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-3">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 col-md-10 d-flex flex-column align-items-center justify-content-center">

                        <div class="card form-bg mb-3 p-2">
                            <div class="d-flex justify-content-center py-3">
                                <a href="{{ route('login') }}" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ SiteSetting()->logo }}" alt="">
                                </a>
                            </div><!-- End Logo -->


                            <div class="card-body">

                                <div>
                                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                    <p class="text-center ">Enter your personal details to create account for Listing
                                        Hostels</p>
                                </div>

                                <form action="{{ route('register.post') }}" method="POST" class="row g-3 needs-validation"
                                    novalidate>
                                    @csrf
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <label for="name" class="form-label fw-bold">Your Name <sup
                                                class="text-danger">*</sup></label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control" id="name" placeholder="Enter Your Name" required>
                                        <div class="invalid-feedback">Please enter your Name.</div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6">
                                        <label for="email" class="form-label fw-bold">Your Email <sup
                                                class="text-danger">*</sup></label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control" id="email" placeholder="Enter Your Email" required>
                                        <div class="invalid-feedback">Please enter your Email.</div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6">
                                        <label for="phone" class="form-label fw-bold">Your Phone <sup
                                                class="text-danger">*</sup></label>
                                        <input type="number" name="phone" minlength="10" maxlength="10"
                                            value="{{ old('phone') }}" class="form-control" id="phone"
                                            placeholder="Enter Your Phone Number" required>
                                        <div class="invalid-feedback">Please enter your Phone Number.</div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6">
                                        <label for="image" class="form-label fw-bold">Profile Pic</label>
                                        <input type="file" name="image" class="form-control" id="phone">
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6">
                                        <label for="gender" class="form-label fw-bold">Gender <sup
                                                class="text-danger">*</sup></label>
                                        <select name="gender" id="gender" class="form-select" required>
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <div class="invalid-feedback">Please enter your Gender.</div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6">
                                        <label for="address" class="form-label fw-bold">Address <sup
                                                class="text-danger">*</sup></label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="address" value="{{ old('address') }}"
                                                class="form-control" id="address" placeholder="Enter Your Address"
                                                required>
                                            <div class="invalid-feedback">Please enter your Address.</div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-lg-6">
                                        <label for="password" class="form-label fw-bold">Create Password <sup
                                                class="text-danger">*</sup></label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control" id="password"
                                                title="Minimum 6 Character" minlength="6"
                                                placeholder="Create Your Password" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="toggle-password">
                                                    <i class="bi bi-eye-fill"></i>
                                                </span>
                                            </div>
                                            <div class="invalid-feedback">Please enter your Password.</div>
                                        </div>
                                    </div>


                                    <div class="col-12 col-md-6 col-lg-6">
                                        <label for="confirm_password" class="form-label fw-bold">Confirm Password <sup
                                                class="text-danger">*</sup></label>
                                        <input type="password" name="confirm_password" class="form-control"
                                            id="confirm_password" title="Minimum 6 Character" minlength="6"
                                            placeholder="Confirm Your Password" required>
                                        <div class="invalid-feedback">Please enter Confirm Password.</div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check d-flex">
                                            <input class="form-check-input" name="terms" id="terms"
                                                type="checkbox" checked required>
                                            <label class="form-check-label" for="terms"><sup class="text-danger fw-bold">*</sup> I agree and accept the
                                                <a href="https://nearmehostel.com/terms-condition"
                                                    target="_blank"><u>terms and conditions</u></a>.</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-7 mx-auto">
                                        <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                    </div>

                                    <div class="col-12 col-lg-12">
                                        <p class="mb-0 text-center">Already have an account? <a
                                                href="{{ route('login') }}"><u>Log in</u></a>
                                        </p>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
@endsection
