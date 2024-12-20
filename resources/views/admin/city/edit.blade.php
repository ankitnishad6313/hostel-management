@extends('admin.main')
@push('title')
    <title>Edit City</title>
@endpush
@section('main-section')
<div class="pagetitle">
    <h1>City</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">City</a></li>
        <li class="breadcrumb-item active">Edit City</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit City</h5>

            <!-- General Form Elements -->
            <form action="{{ route('admin-edit-city', ['id' => $city->id]) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                  <div class="col-12 col-lg-4 mb-3">
                    <label for="city" class="form-label fw-bold">City<sup class="text-danger fw-bold">*</sup></label>
                      <input type="text" name="city" id="city" value="{{ $city->city }}" class="form-control" placeholder="City Name">
                  </div>
                  
                  <div class="col-12 col-lg-4 mb-3">
                    <label for="file" class="form-label fw-bold">File Upload</label>
                      <input class="form-control" type="file" id="file" name="image" id="formFile">
                  </div>

                  <div class="col-12 col-lg-4 mb-3">
                    <label for="status" class="form-label fw-bold">Status</label>
                      <select name="status" id="status" class="form-select">
                        <option value="active" {{ ($city->city == "active") ? "selected" : "" }}>Active</option>
                        <option value="inactive" {{ ($city->city == "inactive") ? "selected" : "" }}>Inactive</option>
                      </select>
                  </div>

                  <div class="col-12 mx-auto mb-3 text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </div>
            </form><!-- End General Form Elements -->

          </div>
        </div>

      </div>

    </div>
  </section>
@endsection