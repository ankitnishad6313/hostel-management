@extends('admin.main')
@push('title')
    <title>Edit Slider</title>
@endpush
@section('main-section')
<div class="pagetitle">
    <h1>Sliders</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Room</a></li>
        <li class="breadcrumb-item active">Edit Slider</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-sm-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Slider</h5>

            <!-- General Form Elements -->
            <form action="{{ route('admin-edit-slider', ['id' => $slider->id]) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-12 col-lg-6 mb-3">
                  <label for="link" class="col-sm-2 col-form-label fw-bold">Link<sup class="text-danger fw-bold">*</sup></label>
                    <input type="text" name="link" value="{{ $slider->link }}" id="link" class="form-control" placeholder="Link">
                </div>
                <div class="col-12 col-lg-6 mb-3">
                  <label for="slider_image" class="col-sm-2 col-form-label fw-bold">Image<sup class="text-danger fw-bold">*</sup></label>
                    <input type="file" name="slider_image" id="slider_image" class="form-control">
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