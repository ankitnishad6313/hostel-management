@extends('admin.main')
@push('title')
    <title>Add Package</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Package</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Package</a></li>
                <li class="breadcrumb-item active">Add Package</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-sm-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Package</h5>

              <!-- General Form Elements -->
              <form action="{{ route('admin-store-package') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                      <label for="package" class="form-label fw-bold">Package<sup class="text-danger fw-bold">*</sup></label>
                        <input type="text" name="package" value="{{ old('package') }}" id="package" class="form-control" placeholder="Package Name">
                    </div>
                    <div class="col-12 col-lg-4 mb-3">
                      <label for="price" class="form-label fw-bold">Price<sup class="text-danger fw-bold">*</sup></label>
                        <input type="number" name="price" value="{{ old('price') }}" id="price" class="form-control" placeholder="Package Price">
                    </div>
                    <div class="col-12 col-lg-4 mb-3">
                      <label for="validity" class="form-label fw-bold">Validity <small>(In Days)</small><sup class="text-danger fw-bold">*</sup></label>
                        <input type="number" name="validity" value="{{ old('validity') }}" id="validity" class="form-control" placeholder="Package Validity In Days">
                    </div>
                    
                    <div class="col-12 mb-3">
                      <label for="content" class="form-label fw-bold">Package Description<sup class="text-danger fw-bold">*</sup></label>
                      <textarea class="tinymce-editor" id="content" name="content">
                        {{ old('content') }}
                      </textarea>
                    </div>

                    <div class="col-8 col-lg-8 mx-auto mb-3 text-center">
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
