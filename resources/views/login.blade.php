@extends('main')
@push('title')
    <title>NearMeHostels | Login</title>
@endpush
@section('main-section')
<div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-lg-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="card form-bg mb-3 px-2">
                        <div class="d-flex justify-content-center pt-lg-2">
                            <a href="{{ route('login') }}" class="logo d-flex align-items-center w-auto">
                                <img src="{{ SiteSetting()->logo }}" alt="">
                            </a>
                        </div><!-- End Logo -->

                        <div class="card-body">

                            <div class="">
                                <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                <p class="text-center ">Enter your Email & Password to Login</p>
                            </div>

                            <form action="{{ route('login.post') }}" method="POST" class="row g-3 needs-validation" novalidate>
                                @csrf
                                <div class="col-12">
                                    <label for="yourUsername" class="form-label fw-bold">Email <sup class="text-danger">*</sup></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="email">@</span>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="yourUsername" placeholder="Enter Your Email" autofocus required>
                                        <div class="invalid-feedback">Please enter your Email.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="password" class="form-label fw-bold">Password <sup class="text-danger">*</sup></label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" id="password" minlength="6" placeholder="Enter Your Password" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="toggle-password">
                                                <i class="bi bi-eye-fill"></i>
                                            </span>
                                        </div>
                                        <div class="invalid-feedback">Please enter your Password.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">Login</button>
                                </div>
                                <div class="col-12">
                                    
                                    <p class="mb-0 d-flex flex-wrap align-items-center justify-content-between">
                                        <span>Don't have account? <a href="{{ route('register') }}" class="text-success fw-bold"> Create an account</a></span>
                                        <a href="{{ route('forgot-password') }}">Forgot Password?</a>
                                        
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
