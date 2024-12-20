@extends('admin.main')
@push('title')
    <title>Add Enquiry</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Enquiry</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Enquiry</a></li>
                <li class="breadcrumb-item active">Add Enquiry</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Enquiry</h5>

                        <!-- General Form Elements -->
                        <form action="{{ route('admin-store-enquiry') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="user_id" class="form-label fw-bold">Owner<sup
                                            class="text-danger">*</sup></label>
                                    <div class="input-group has-validation">
                                        <select name="user_id" id="user_id" class="form-select" required>
                                            <option value="">Select Owner</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name . ' | ' . $user->phone }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="hostel_id" class="form-label fw-bold">Hostel<sup
                                            class="text-danger">*</sup></label>
                                    <div class="input-group has-validation">
                                        <select name="hostel_id" id="hostel_id" class="form-select" required>
                                            <option value="">Select Hostel / PG</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="name" class="form-label fw-bold">Name <sup
                                            class="text-danger">*</sup></label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control" id="name" placeholder="Enter Name" required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <div class="input-group has-validation">
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control" id="email" placeholder="Enter Your Email">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                    <label for="phone" class="form-label fw-bold">Phone Number <sup
                                            class="text-danger">*</sup></label>
                                    <div class="input-group has-validation">
                                        <input type="number" name="phone" minlength="10" maxlength="10"
                                            value="{{ old('phone') }}" class="form-control" id="phone"
                                            placeholder="Enter Phone Number" required>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6 mb-3">
                                  <label for="description" class="form-label fw-bold">Description</label>
                                  <div class="input-group has-validation">
                                      <textarea name="description" id="description" class="form-control" cols="30" rows="1" placeholder="Description">{{ old('description') }}</textarea>
                                  </div>
                              </div>

                                <div class="col-8 col-lg-4 mx-auto mb-3 text-center">
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection

@section('script-section')
    <script>
        $(document).ready(function() {

            // Hostel
            $('#user_id').on('change', function() {
                var user_id = this.value;
                $('#hostel_id').html('');
                $.ajax({
                    url: '{{ route('getHostels') }}?id=' + user_id,
                    type: 'get',
                    success: function(res) {
                        if (res.length > 0) {
                            $('#hostel_id').html(
                                '<option value="" selected>Select Hostel / PG</option>');
                            $.each(res, function(key, value) {
                                $('#hostel_id').append('<option value="' + value
                                    .id + '">' + value.hostel_name + '</option>');
                            });
                        } else {
                            $('#hostel_id').html(
                                '<option value="" selected>Hostels not Found</option>'
                            );
                        }
                    },

                    error: function(res) {
                        console.error('Error fetching Hostels.');
                    }
                });
            });
        });
    </script>
@endsection
