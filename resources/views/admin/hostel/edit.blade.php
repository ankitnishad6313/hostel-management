@extends('admin.main')
@push('title')
    <title>Edit Hostel</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Hostels</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Hostels</a></li>
                <li class="breadcrumb-item active">Edit Hostel</li>
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

                        <form action="{{ route('admin-update-hostel', ['id' => $data['hostel']->id]) }}" method="POST"
                            enctype="multipart/form-data" class="row g-3 needs-validation">
                            @csrf

                            <div class="col-12 col-lg-6">
                                <label for="property_type" class="form-label fw-bold">Property Type<sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="property_type" id="property_type" class="form-control" required>
                                        <option value="hostel"
                                            {{ $data['hostel']->property_type == 'hostel' ? 'selected' : '' }}>Hostel
                                        </option>
                                        <option value="pg"
                                            {{ $data['hostel']->property_type == 'pg' ? 'selected' : '' }}>PG</option>
                                    </select>
                                    <div class="invalid-feedback">Please Select Property Type!</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="user_id" class="form-label fw-bold">Hostel Owner <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        @foreach ($data['users'] as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $data['hostel']->user_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name . ' | ' . $user->phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please select your Owner!</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="hostel_name" class="form-label fw-bold">Hostel Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <input type="text" name="hostel_name" value="{{ $data['hostel']->hostel_name }}"
                                        class="form-control" id="hostel_name" placeholder="Enter Hostel Name" required>
                                    <div class="invalid-feedback">Please enter Hostel Name!</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="gender_type" class="form-label fw-bold">Gender Type<sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="gender_type" id="gender_type" class="form-control" required>
                                        <option value="boys"
                                            {{ $data['hostel']->gender_type == 'Boys' ? 'selected' : '' }}>Boys</option>
                                        <option value="girls"
                                            {{ $data['hostel']->gender_type == 'Girls' ? 'selected' : '' }}>Girls
                                        </option>
                                        <option value="common"
                                            {{ $data['hostel']->gender_type == 'Common' ? 'selected' : '' }}>Common
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">Please Select Gender Type!</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="hostel_status" class="form-label fw-bold">Hostel Status<sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="hostel_status" id="hostel_status" class="form-control" required>
                                        <option value="active"
                                            {{ $data['hostel']->hostel_status == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive"
                                            {{ $data['hostel']->hostel_status == 'inactive' ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">Please Select Hostel Status</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="isVerified" class="form-label fw-bold">Verify Hostel<sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="isVerified" id="isVerified" class="form-control" required>
                                        <option value="1" {{ $data['hostel']->isVerified == 1 ? 'selected' : '' }}>
                                            Verified</option>
                                        <option value="0" {{ $data['hostel']->isVerified == 0 ? 'selected' : '' }}>
                                            Unverified</option>
                                    </select>
                                    <div class="invalid-feedback">Please Select Verify Hostel</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="hostel_images" class="form-label fw-bold">Hostel Images
                                    <small>(multiple)</small></label>
                                <div class="input-group has-validation">
                                    <input type="file" name="hostel_images[]" multiple class="form-control"
                                        id="hostel_images">
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
                                    <input type="text" name="hostel_address"
                                        value="{{ $data['hostel']->hostel_address }}" class="form-control"
                                        id="hostel_address" placeholder="Enter hostel_address" required>
                                    <div class="invalid-feedback">Please enter hostel_address!</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <label for="youtube_video_link" class="form-label fw-bold">Youtube Video Link</label>
                                <div class="input-group has-validation">
                                    <input type="text" name="youtube_video_link"
                                        value="{{ $data['hostel']->youtube_video_link }}" class="form-control"
                                        id="youtube_video_link" placeholder="Enter youtube_video_link">
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="single_bed_rent" class="form-label fw-bold">Min. Single Bed Room Rent <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <input type="text" name="single_bed_rent"
                                        value="{{ $data['hostel']->single_bed_rent }}" class="form-control"
                                        id="single_bed_rent" placeholder="(For Display on Front)" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="double_bed_rent" class="form-label fw-bold">Min. Double Bed Room Rent <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <input type="text" name="double_bed_rent"
                                        value="{{ $data['hostel']->double_bed_rent }}" class="form-control"
                                        id="double_bed_rent" placeholder="(For Display on Front)" required>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <label for="triple_bed_rent" class="form-label fw-bold">Min. Triple Bed Room Rent <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <input type="text" name="triple_bed_rent"
                                        value="{{ $data['hostel']->triple_bed_rent }}" class="form-control"
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
                                                    value="{{ $feature->features }}"
                                                    {{ checkFeature($data['hostel']->hostel_features, $feature->features) }}>
                                                <label class="form-check-label fw-bld">{{ $feature->features }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="hostel_policy" class="form-label fw-bold">Hostel Policy</label>
                                <textarea class="tinymce-editor" id="hostel_policy" name="hostel_policy">
                              {{ $data['hostel']->hostel_policy }}
                            </textarea>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="hostel_description" class="form-label fw-bold">Hostel Description</label>
                                <textarea class="tinymce-editor" id="hostel_description" name="hostel_description">
                              {{ $data['hostel']->hostel_description }}
                            </textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <h5>Add Nearby</h5>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="hospitals" class="form-label fw-bold">Hospitals</label>
                                <textarea class="tinymce-editor" id="hospitals" name="hospitals">
                                  {{ $data['hostel']->hospitals }}
                                </textarea>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="coachings" class="form-label fw-bold">Coaching Centers</label>
                                <textarea class="tinymce-editor" id="coachings" name="coachings">
                                  {{ $data['hostel']->coachings }}
                                </textarea>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="shopping_malls" class="form-label fw-bold">Shopping Malls</label>
                                <textarea class="tinymce-editor" id="shopping_malls" name="shopping_malls">
                                  {{ $data['hostel']->shopping_malls }}
                                </textarea>
                            </div>

                            <div class="col-12 col-lg-6 mb-3">
                                <label for="restaurants" class="form-label fw-bold">Restaurants</label>
                                <textarea class="tinymce-editor" id="restaurants" name="restaurants">
                                  {{ $data['hostel']->restaurants }}
                                </textarea>
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-50 text-center" type="submit">Update Hostel</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
