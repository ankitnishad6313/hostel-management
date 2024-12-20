@extends('agent.main')
@push('title')
    <title>Add Hostel</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Hostels</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('agent-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Hostels</li>
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

                        <form action="{{ route('agent-store-hostel') }}" method="POST" enctype="multipart/form-data"
                            class="row g-3 needs-validation">
                            @csrf

                            <div class="col-6">
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

                            <div class="col-6">
                                <label for="user_id" class="form-label fw-bold">Hostel Owner <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        <option value="" selected>Select Owner</option>
                                        @foreach ($data['users'] as $user)
                                            <option value="{{ $user->id }}">{{ $user->name . ' | ' . $user->phone }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="hostel_name" class="form-label fw-bold">Hostel Name <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <input type="text" name="hostel_name" value="{{ old('hostel_name') }}"
                                        class="form-control" id="hostel_name" placeholder="Enter Hostel Name" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="gender_type" class="form-label fw-bold">Gender Type<sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="gender_type" id="gender_type" class="form-control" required>
                                        <option value="boys">Boys</option>
                                        <option value="girls">Girls</option>
                                        <option value="common">Common</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="hostel_images" class="form-label fw-bold">Hostel Images <sup
                                        class="text-danger">*</sup> <small>(multiple)</small></label>
                                <div class="input-group has-validation">
                                    <input type="file" name="hostel_images[]" multiple class="form-control"
                                        id="hostel_images" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="city" class="form-label fw-bold">City <sup
                                        class="text-danger">*</sup></label>
                                <div class="input-group has-validation">
                                    <select name="city" id="city" class="form-control" required>
                                        @foreach ($data['cities'] as $city)
                                            <option value="{{ $city->city }}">{{ $city->city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="hostel_address" class="form-label fw-bold">Hostel Address <sup
                                        class="text-danger">*</sup><small>(Locality)</small></label>
                                <div class="input-group has-validation">
                                    <input type="text" name="hostel_address" value="{{ old('hostel_address') }}"
                                        class="form-control" id="hostel_address" placeholder="Enter hostel_address"
                                        required>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="youtube_video_link" class="form-label fw-bold">Youtube Video Link</label>
                                <div class="input-group has-validation">
                                    <input type="text" name="youtube_video_link"
                                        value="{{ old('youtube_video_link') }}" class="form-control"
                                        id="youtube_video_link" placeholder="Enter youtube_video_link">
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Hostel Features</label>
                                <div class="row">
                                    @foreach ($data['features'] as $feature)
                                    <div class="col-4">
                                        <input type="checkbox" class="form-check-input" name="hostel_features[]" value="{{ $feature->features }}">
                                        <label class="form-check-label fw-bld">{{ $feature->features }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="hostel_policy" class="form-label fw-bold">Hostel Policy</label>
                                <textarea class="tinymce-editor" id="hostel_policy" name="hostel_policy">
                                  {{ old('hostel_policy') }}
                                </textarea>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="hostel_description" class="form-label fw-bold">Hostel Description</label>
                                <textarea class="tinymce-editor" id="hostel_description" name="hostel_description">
                                  {{ old('hostel_description') }}
                                </textarea>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <h5>Add Nearby</h5>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="hospitals" class="form-label fw-bold">Hospitals</label>
                                <textarea class="tinymce-editor" id="hospitals" name="hospitals">
                                  {{ old('hospitals') }}
                                </textarea>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="coachings" class="form-label fw-bold">Coaching Centers</label>
                                <textarea class="tinymce-editor" id="coachings" name="coachings">
                                  {{ old('coachings') }}
                                </textarea>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="shopping_malls" class="form-label fw-bold">Shopping Malls</label>
                                <textarea class="tinymce-editor" id="shopping_malls" name="shopping_malls">
                                  {{ old('shopping_malls') }}
                                </textarea>
                            </div>

                            <div class="col-6 mb-3">
                                <label for="restaurants" class="form-label fw-bold">Restaurants</label>
                                <textarea class="tinymce-editor" id="restaurants" name="restaurants">
                                  {{ old('restaurants') }}
                                </textarea>
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
