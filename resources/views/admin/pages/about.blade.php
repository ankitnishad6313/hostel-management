@extends('admin.main')
@push('title')
    <title>About Us</title>
@endpush
@section('main-section')
    <div class="pagetitle position-relative">
        <h1>About Us</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Pages</a></li>
                <li class="breadcrumb-item active">About Us</li>
            </ol>
        </nav>
        <div class="position-absolute top-0 end-0">
            <a href="{{ route('admin-about-edit', ['id' => $data->id]) }}">
                <button type="button" class="btn btn-warning mx-2"><i class="bi bi-pencil-square"></i></button>
            </a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mt-3">About Us</h5>
                        <img src="{{ $data->about_image }}" alt="" class="img-fluid">
                        {!! $data->about_content !!}
                    </div>
                </div>

            </div>
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mt-3">Message</h5>
                        <img src="{{ $data->message_image }}" alt="" class="img-fluid">
                        {!! $data->message_content !!}
                    </div>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mt-3">What We Do</h5>
                        <img src="{{ $data->what_we_do_image }}" alt="" class="img-fluid">
                        {!! $data->what_we_do_content !!}
                    </div>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mt-3">Mission</h5>
                        <img src="{{ $data->mission_image }}" alt="" class="img-fluid">
                        {!! $data->mission_content !!}
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
