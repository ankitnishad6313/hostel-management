@extends('admin.main')
@push('title')
    <title>Edit Agent</title>
@endpush
@section('main-section')
    <div class="pagetitle d-flex flex-wrap justify-content-between">
        <div>
            <h1>Agents</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Agents</a></li>
                    <li class="breadcrumb-item active">Edit Agent</li>
                </ol>
            </nav>
        </div>

        <div class="top-0 end-0 p-2">
            <a href="{{ route('admin-edit-document', ['id' => $agent->id]) }}" class="btn btn-outline-dark">Add / Edit
                Documents</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body form-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Edit Agent Details Below</h5>
                            <p class="text-center small">To update an Agent Acount</p>
                        </div>

                        <form action="{{ route('admin-update-agent', ['id' => $agent->id]) }}" method="POST"
                            enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf

                            <div class="col-12 col-lg-6">
                                <label for="name" class="form-label fw-bold">Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                            class="bi bi-person"></i></span>
                                    <input type="text" name="name" value="{{ $agent->name }}" class="form-control"
                                        id="name" placeholder="Enter Name" required>
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
                                        value="{{ $agent->phone }}" class="form-control" id="yourUsername"
                                        placeholder="Enter Phone Number" required>
                                    <div class="invalid-feedback">Please enter Phone Number.</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="yourUsername" class="form-label fw-bold">Email <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="email" name="email" value="{{ $agent->email }}" class="form-control"
                                        id="yourUsername" placeholder="Enter Your Email" required>
                                    <div class="invalid-feedback">Please enter your Email.</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="yourPassword" class="form-label">Password</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock"></i></span>
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
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="active" {{ $agent->status == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive" {{ $agent->status == 'inactive' ? 'selected' : '' }}>
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
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="Male" {{ $agent->gender == 'Male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female" {{ $agent->gender == 'Female' ? 'selected' : '' }}>Female
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
                                    <input type="text" name="address" value="{{ $agent->address }}"
                                        class="form-control" id="address" placeholder="Enter Address" required>
                                    <div class="invalid-feedback">Please enter Address.</div>
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-50 text-center" type="submit">Update Acount</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
