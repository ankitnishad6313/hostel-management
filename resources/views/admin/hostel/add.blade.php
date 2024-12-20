@extends('admin.main')
@push('title')
    <title>Add Hostel</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Hostels</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Hostels</a></li>
                <li class="breadcrumb-item active">Add Hostel</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body form-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Enter Hostel Details Below</h5>
                            <p class="text-center small">Create a new account for booking a hostel in your locations.</p>
                        </div>

                        <form action="{{ route('admin-store-hostel') }}" method="POST" enctype="multipart/form-data"
                            class="row g-3 needs-validation">
                            @csrf

                            <div class="col-12 col-lg-6">
                                <label for="property_type" class="form-label fw-bold">Property Type<sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="property_type" id="property_type" class="form-control" required>
                                        <option value="" selected>Select Property Type</option>
                                        <option value="hostel">Hostel</option>
                                        <option value="pg">PG</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="user_id" class="form-label fw-bold">Hostel Owner <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        <option value="" selected>Select Owner</option>
                                        <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }} (You)
                                        </option>
                                        @foreach ($data['users'] as $user)
                                            <option value="{{ $user->id }}">{{ $user->name . ' | ' . $user->phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please enter your password!</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="hostel_name" class="form-label fw-bold">Hostel Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <input type="text" name="hostel_name" value="{{ old('hostel_name') }}"
                                        class="form-control" id="hostel_name" placeholder="Enter Hostel Name" required>
                                    <div class="invalid-feedback">Please enter Hostel Name!</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="gender_type" class="form-label fw-bold">Gender Type<sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="gender_type" id="gender_type" class="form-control" required>
                                        <option value="boys">Boys</option>
                                        <option value="girls">Girls</option>
                                        <option value="common">Common</option>
                                    </select>
                                    <div class="invalid-feedback">Please Select Gender Type!</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="hostel_status" class="form-label fw-bold">Hostel Status<sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="hostel_status" id="hostel_status" class="form-control" required>
                                        <option value="active" {{ old('hostel_status') == 'active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="inactive"
                                            {{ old('hostel_status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <div class="invalid-feedback">Please Select Hostel Status</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="isVerified" class="form-label fw-bold">Verify Hostel<sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="isVerified" id="isVerified" class="form-control" required>
                                        <option value="1" {{ old('isVerified') == 1 ? 'selected' : '' }}>Verified
                                        </option>
                                        <option value="0" {{ old('isVerified') == 0 ? 'selected' : '' }}>Unverified
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">Please Select Verify Hostel</div>
                                </div>
                            </div>


                            <div class="col-12 col-lg-6">
                                <label for="hostel_images" class="form-label fw-bold">Hostel Images <sup
                                        class="text-danger">*</sup> <small>(multiple)</small></label>
                                <div class="input-group has-validation">
                                    <input type="file" name="hostel_images[]" multiple class="form-control"
                                        id="hostel_images" required>
                                    <div class="invalid-feedback">Please Select Images!</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="city" class="form-label fw-bold">City <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="city" id="city" class="form-control" required>
                                        @foreach ($data['cities'] as $city)
                                            <option value="{{ $city->city }}">{{ $city->city }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please Select City!</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="hostel_address" class="form-label fw-bold">Hostel Address <sup
                                        class="text-danger">*</sup><small>(Locality)</small></label>
                                <div class="input-group has-validation">
                                    <input type="text" name="hostel_address" value="{{ old('hostel_address') }}"
                                        class="form-control" id="hostel_address" placeholder="Enter hostel address"
                                        required>
                                    <div class="invalid-feedback">Please enter hostel_address!</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="youtube_video_link" class="form-label fw-bold">YouTube Video Link</label>
                                <div class="input-group has-validation">
                                    <input type="text" name="youtube_video_link"
                                        value="{{ old('youtube_video_link') }}" class="form-control"
                                        id="youtube_video_link" placeholder="Enter YouTube video link">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="single_bed_rent" class="form-label fw-bold">Min. Single Bed Room Rent <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <input type="text" name="single_bed_rent" class="form-control"
                                        id="single_bed_rent" placeholder="(For Display on Front)" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="double_bed_rent" class="form-label fw-bold">Min. Double Bed Room Rent <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <input type="text" name="double_bed_rent" class="form-control"
                                        id="double_bed_rent" placeholder="(For Display on Front)" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="triple_bed_rent" class="form-label fw-bold">Min. Triple Bed Room Rent <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <input type="text" name="triple_bed_rent" class="form-control"
                                        id="triple_bed_rent" placeholder="(For Display on Front)" required>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Hostel Features</label>
                                <div class="row">
                                    <div class="d-flex flex-wrap gap-4">
                                        @foreach ($data['features'] as $feature)
                                            <div>
                                                <input type="checkbox" class="form-check-input" name="hostel_features[]"
                                                    value="{{ $feature->features }}">
                                                <label class="form-check-label fw-bld">{{ $feature->features }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="hostel_policy" class="form-label fw-bold">Hostel Policy</label>
                                <textarea class="tinymce-editor" id="hostel_policy" name="hostel_policy">
                                  {{ old('hostel_policy') }}
                                </textarea>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="hostel_description" class="form-label fw-bold">Hostel Description</label>
                                <textarea class="tinymce-editor" id="hostel_description" name="hostel_description">
                                  {{ old('hostel_description') }}
                                </textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <h5>Add Nearby</h5>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="hospitals" class="form-label fw-bold">Hospitals</label>
                                <textarea class="tinymce-editor" id="hospitals" name="hospitals">
                                  {{ old('hospitals') }}
                                </textarea>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="coachings" class="form-label fw-bold">Coaching Centers</label>
                                <textarea class="tinymce-editor" id="coachings" name="coachings">
                                  {{ old('coachings') }}
                                </textarea>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="shopping_malls" class="form-label fw-bold">Shopping Malls</label>
                                <textarea class="tinymce-editor" id="shopping_malls" name="shopping_malls">
                                  {{ old('shopping_malls') }}
                                </textarea>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="restaurants" class="form-label fw-bold">Restaurants</label>
                                <textarea class="tinymce-editor" id="restaurants" name="restaurants">
                                  {{ old('restaurants') }}
                                </textarea>
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-50 text-center" type="submit">Add Hostel</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
