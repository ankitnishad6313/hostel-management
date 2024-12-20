@extends('main')
@push('title')
    <title>NearMeHostels | Forgot Password</title>
@endpush
@section('main-section')
<div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-lg-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    
                    <div class="card form-bg mb-3 px-2">
                    <div class="d-flex justify-content-center pt-lg-2">
                        <a href="{{ route('login') }}" class="logo d-flex align-items-center w-auto">
                            <img src="{{ SiteSetting()->logo }}" alt="">
                        </a>
                    </div><!-- End Logo -->


                        <div class="card-body">

                            <div>
                                <h5 class="card-title text-center pb-0 fs-4">Recover to Your Account</h5>
                            </div>
                            @if (Session::get('step') == 2)
                            <form action="{{ route('verify-otp') }}" method="POST" class="row g-3 needs-validation" novalidate>
                                @csrf
                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="email" name="email" value="{{ Session::get('email') }}" class="form-control" id="yourUsername" placeholder="{{ Session::get('email') }}" readonly>
                                        <div class="invalid-feedback">Please enter your Email.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="otp" class="form-label">Enter OTP</label>
                                    <input type="password" name="otp" class="form-control" id="otp" placeholder="Enter Your OTP" required>
                                    <div class="invalid-feedback">Please enter your OTP.</div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Verify OTP</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0 d-flex align-items-center justify-content-evenly">
                                        <span>Click Here for <a href="{{ route('login') }}"> Login</a></span>
                                    </p>
                                </div>
                            </form> 
                            @elseif (Session::get('step') == 3)
                            <form action="{{ route('change-password') }}" method="POST" class="row g-3 needs-validation" novalidate>
                                @csrf

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock"></i></span>
                                        <input type="password" name="password" class="form-control" id="yourPassword" placeholder="Enter Your Password" required>
                                        <div class="invalid-feedback">Please Create your Password.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock"></i></span>
                                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password" required>
                                        <div class="invalid-feedback">Please Confirm Password.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Reset Password</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0 d-flex align-items-center justify-content-evenly">
                                        <span>Click Here for <a href="{{ route('login') }}"> Login</a></span>
                                    </p>
                                </div>
                            </form>
                            @else
                            <form action="{{ route('send-otp') }}" method="POST" class="row g-3 needs-validation">
                                @csrf
                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Email</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="yourUsername" placeholder="Enter Your Email" required>
                                        <div class="invalid-feedback">Please enter your Email.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Get OTP</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0 d-flex align-items-center justify-content-evenly">
                                        <span>Click Here for <a href="{{ route('login') }}"> Login</a></span>
                                    </p>
                                </div>
                            </form>
                            @endif
                            

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>

</div>
@endsection
