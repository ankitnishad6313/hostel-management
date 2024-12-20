@extends('admin.main')
@push('title')
    <title>Edit Owner</title>
@endpush
@section('main-section')
    <div class="pagetitle position-relative">
        <h1>Owners</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Owners</a></li>
                <li class="breadcrumb-item active">Edit Owner</li>
            </ol>
        </nav>

        <div class="position-absolute top-0 end-0 p-lg-2 ">
            <a href="{{ route('admin-edit-document', ['id' => $owner->id]) }}" class="btn btn-sm btn-outline-dark">Add / Edit Documents</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body form-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Edit Owner Details Below</h5>
                            <p class="text-center small">To update an Owner Acount</p>
                        </div>

                        <form action="{{ route('admin-update-owner', ['id' => $owner->id]) }}" method="POST"
                            enctype="multipart/form-data" class="g-3 needs-validation" novalidate>
                            @csrf

                            <div class="row">

                                <div class="col-12 col-lg-6">
                                    <label for="name" class="form-label fw-bold">Name <sup
                                            class="text-danger">*</sup></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i
                                                class="bi bi-person"></i></span>
                                        <input type="text" name="name" value="{{ $owner->name }}"
                                            class="form-control" id="name" placeholder="Enter Name">
                                        <div class="invalid-feedback">Please enter Name.</div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="yourUsername" class="form-label fw-bold">Phone Number <sup
                                            class="text-danger">*</sup></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i
                                                class="bi bi-telephone"></i></span>
                                        <input type="number" name="phone" minlength="10" maxlength="10"
                                            value="{{ $owner->phone }}" class="form-control" id="yourUsername"
                                            placeholder="Enter Phone Number">
                                        <div class="invalid-feedback">Please enter Phone Number.</div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="yourUsername" class="form-label fw-bold">Email <sup
                                            class="text-danger">*</sup></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="email" name="email" value="{{ $owner->email }}"
                                            class="form-control" id="yourUsername" placeholder="Enter Your Email">
                                        <div class="invalid-feedback">Please enter your Email.</div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i
                                                class="bi bi-lock"></i></span>
                                        <input type="password" name="password" class="form-control" id="yourPassword"
                                            placeholder="Enter Your Password">
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="status" class="form-label fw-bold">Status <sup
                                            class="text-danger">*</sup></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i
                                                class="bi bi-radioactive"></i></span>
                                        <select name="status" id="status" class="form-select">
                                            <option value="active" {{ $owner->status == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="inactive" {{ $owner->status == 'inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">Please Select Status!</div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <label for="gender" class="form-label fw-bold">Gender <sup
                                            class="text-danger">*</sup></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend"><i
                                                class="bi bi-gender-male"></i></span>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="Male" {{ $owner->gender == 'Male' ? 'selected' : '' }}>
                                                Male
                                            </option>
                                            <option value="Female" {{ $owner->gender == 'Female' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">Please Select your Gender!</div>
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
                                        <input type="text" name="address" value="{{ $owner->address }}"
                                            class="form-control" id="address" placeholder="Enter Address">
                                        <div class="invalid-feedback">Please enter Address.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 text-center mt-3">
                                <button class="btn btn-primary w-50 text-center" type="submit">Update Acount</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
