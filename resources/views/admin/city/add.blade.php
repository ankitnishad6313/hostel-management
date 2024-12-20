@extends('admin.main')
@push('title')
    <title>Add City</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>City</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">City</a></li>
                <li class="breadcrumb-item active">Add City</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-sm-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add City</h5>

              <!-- General Form Elements -->
              <form action="{{ route('admin-store-city') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-6 mb-3">
                      <label for="city" class="col-sm-2 col-form-label fw-bold">City<sup class="text-danger fw-bold">*</sup></label>
                        <input type="text" name="city" id="city" class="form-control" placeholder="City Name">
                    </div>
                    
                    <div class="col-12 col-lg-6 mb-3">
                      <label for="file" class="col-sm-2 col-form-label fw-bold">File Upload<sup class="text-danger fw-bold">*</sup></label>
                        <input class="form-control" type="file" id="file" name="image" id="formFile">
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
