@extends('admin.main')
@push('title')
    <title>Add Blog</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Blog</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Blog</a></li>
                <li class="breadcrumb-item active">Add Blog</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-sm-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Blog</h5>

              <!-- General Form Elements -->
              <form action="{{ route('admin-store-blog') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-6 mb-3">
                      <label for="title" class="col-sm-2 col-form-label fw-bold">Title<sup class="text-danger fw-bold">*</sup></label>
                        <input type="text" name="title" value="{{ old('title') }}" id="title" class="form-control" placeholder="Title Name">
                    </div>
                    <div class="col-12 col-lg-6 mb-3">
                      <label for="image" class="col-sm-2 col-form-label fw-bold">Image<sup class="text-danger fw-bold">*</sup></label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    
                    <div class="col-12 mb-3">
                      <label for="description" class="col-sm-2 col-form-label fw-bold">Blog Description<sup class="text-danger fw-bold">*</sup></label>
                      <textarea class="tinymce-editor" id="description" name="description">
                        {{ old('description') }}
                      </textarea>
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
