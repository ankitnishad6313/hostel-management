@extends('agent.main')
@push('title')
    <title>Add Owner</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Owners</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('agent-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Owners</li>
                <li class="breadcrumb-item active">Add an Owner</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body form-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Enter Owners Details Below</h5>
                            <p class="text-center small">To create an Owner Acount</p>
                        </div>

                        <form action="{{ route('agent-store-owner') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf

                            <div class="col-6">
                                <label for="name" class="form-label fw-bold">Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person"></i></span>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                        id="name" placeholder="Enter Name" required>
                                    <div class="invalid-feedback">Please enter Name.</div>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="phone" class="form-label fw-bold">Phone Number <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-telephone"></i></span>
                                    <input type="number" name="phone" minlength="10" maxlength="10" value="{{ old('phone') }}" class="form-control"
                                        id="phone" placeholder="Enter Phone Number" required>
                                    <div class="invalid-feedback">Please enter Phone Number.</div>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="email" class="form-label fw-bold">Email <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                        id="email" placeholder="Enter Your Email" required>
                                    <div class="invalid-feedback">Please enter your Email.</div>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="gender" class="form-label fw-bold">Gender <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-gender-male"></i></span>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="Male" selected>Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <div class="invalid-feedback">Please enter your password!</div>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="image" class="form-label fw-bold">Profile Pic</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person-square"></i></span>
                                    <input type="file" name="image" class="form-control" id="image">
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="address" class="form-label fw-bold">Address <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-house"></i></span>
                                    <input type="text" name="address" value="{{ old('address') }}" class="form-control"
                                        id="address" placeholder="Enter Address" required>
                                    <div class="invalid-feedback">Please enter Address.</div>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-50 text-center" type="submit">Create Acount</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
