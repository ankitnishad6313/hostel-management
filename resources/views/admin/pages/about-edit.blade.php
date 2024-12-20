@extends('admin.main')
@push('title')
    <title>Edit About Us</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>About Us</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Pages</a></li>
                <li class="breadcrumb-item active">Edit About Us</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <form action="{{ route('admin-about-edit', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">About Us</h5>
                            <label for="about_image" class="col-sm-2 col-form-label fw-bold">File Upload</label>
                            <input class="form-control mb-3" type="file" name="about_image" id="about_image">
                            <textarea class="tinymce-editor" name="about_content">
                              {{ $data->about_content }}
                            </textarea>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Message</h5>
                            <label for="message_image" class="col-sm-2 col-form-label fw-bold">File Upload</label>
                            <input class="form-control mb-3" type="file" name="message_image" id="message_image">
                            <textarea class="tinymce-editor" name="message_content">
                              {{ $data->message_content }}
                            </textarea>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">What We Do?</h5>
                            <label for="what_we_do_image" class="col-sm-2 col-form-label fw-bold">File Upload</label>
                            <input class="form-control mb-3" type="file" name="what_we_do_image" id="what_we_do_image">
                            <textarea class="tinymce-editor" name="what_we_do_content">
                              {{ $data->what_we_do_content }}
                            </textarea>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Mission</h5>
                            <label for="mission_image" class="col-sm-2 col-form-label fw-bold">File Upload</label>
                            <input class="form-control mb-3" type="file" name="mission_image" id="mission_image">
                            <textarea class="tinymce-editor" name="mission_content">
                              {{ $data->mission_content }}
                            </textarea>
                        </div>
                    </div>

                </div>

                <div class="mx-auto text-center">
                  <input type="submit" value="Update" class="btn btn-primary w-50 mt-3 text-center">
                </div>

            </div>
        </form>
    </section>
@endsection
