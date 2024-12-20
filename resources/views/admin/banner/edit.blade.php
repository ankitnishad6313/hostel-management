@extends('admin.main')
@push('title')
    <title>Edit Banner</title>
@endpush
@section('main-section')
<div class="pagetitle">
    <h1>Banners</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Banner</a></li>
        <li class="breadcrumb-item active">Edit Banner</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-sm-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Banner</h5>

            <!-- General Form Elements -->
            <form action="{{ route('admin-update-banner', ['id' => $banner->id]) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                  <div class="col-12 col-lg-4  mb-3">
                    <label for="link" class="col-form-label fw-bold">Location<sup class="text-danger fw-bold">*</sup></label>
                    <select name="city" id="city" class="form-control" onchange="checkCustom()" required>
                      @foreach ($cities as $city)
                        <option value="{{ $city->city }}" {{ ($city->city == $banner->city) ? "selected" : "" }}>{{ $city->city }}</option>
                      @endforeach
                      <option value="custom" selected>Other (Please specify)</option>
                    </select>
                    
                    <input type="text" id="customCityInput" name="custom_city" class="form-control mt-2" value="{{ $banner->city }}" placeholder="Enter Custom City">
                  </div>

                  <div class="col-12 col-lg-4  mb-3">
                    <label for="image" class="col-sm-2 col-form-label fw-bold">Image<sup class="text-danger fw-bold">*</sup></label>
                      <input type="file" name="image" id="image" class="form-control">
                  </div>

                  <div class="col-12 col-lg-4  mb-3">
                    <label for="link" class="col-sm-2 col-form-label fw-bold">Link</label>
                      <input type="text" name="link" value="{{ $banner->link }}" id="link" class="form-control" placeholder="Web Address">
                  </div>
                  
                  <div class="col-12 col-lg-4  mx-auto mb-3 text-center">
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
          $('#city').on('change', function() {
              var selectedOption = $(this).val();
              if (selectedOption === 'custom') {
                  $('#customCityInput').show().prop('required', true);
              } else {
                  $('#customCityInput').hide().prop('required', false);
              }
          });
      });
    </script>
@endsection