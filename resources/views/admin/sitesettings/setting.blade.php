@extends('admin.main')
@push('title')
    <title>Site Setting</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Site Setting</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Room</a></li>
                <li class="breadcrumb-item active">Site Setting</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body form-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Enter Site Details Below</h5>
                        </div>

                        <form action="{{ route('admin-update-site-setting') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf

                            <div class="col-12 col-lg-6">
                                <label for="site_name" class="form-label fw-bold">Site Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-spellcheck"></i></span>
                                    <input type="text" name="site_name" value="{{ $setting->site_name }}" class="form-control"
                                        id="site_name" placeholder="Enter site name" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="address" class="form-label fw-bold">Address <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="ri-map-pin-2-line"></i></span>
                                    <input type="text" name="address" value="{{ $setting->address }}" class="form-control"
                                        id="address" placeholder="Enter site name" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="mobile" class="form-label fw-bold">Mobile Number <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-telephone"></i></span>
                                    <input type="number" name="mobile" minlength="10" maxlength="10" value="{{ $setting->mobile }}" class="form-control"
                                        id="mobile" placeholder="Enter Mobile Number" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="mobile_second" class="form-label fw-bold">Second Mobile Number </label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-telephone"></i></span>
                                    <input type="number" name="mobile_second" minlength="10" maxlength="10" value="{{ $setting->mobile_second }}" class="form-control"
                                        id="mobile_second" placeholder="Enter Second Mobile Number">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="email" class="form-label fw-bold">Email <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="email" name="email" value="{{ $setting->email }}" class="form-control"
                                        id="email" placeholder="Enter Email" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="email_second" class="form-label fw-bold">Second Email </label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="email" name="email_second" value="{{ $setting->email_second }}" class="form-control"
                                        id="email_second" placeholder="Enter Second Email">
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="about_site" class="form-label fw-bold">About Site </label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-sort-alpha-down"></i></span>
                                    <textarea name="about_site" id="about_site" class="form-control" rows="3" placeholder="Write About Site">{{ $setting->about_site }}</textarea>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="logo" class="form-label fw-bold">Logo</label>
                                <div class="input-group has-validation mb-2">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-card-image"></i></span>
                                    <input type="file" name="logo" class="form-control" id="logo">
                                </div>
                                <img src="{{ $setting->logo }}" class="d-flex mx-auto" alt="Logo">
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="favicon" class="form-label fw-bold">Favicon</label>
                                <div class="input-group has-validation mb-2">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-card-image"></i></span>
                                    <input type="file" name="favicon" class="form-control" id="favicon">
                                </div>
                                <img src="{{ $setting->favicon }}" class="d-flex mx-auto" alt="Favicon">
                            </div>
                            
                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-50 text-center" type="submit">Update</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
