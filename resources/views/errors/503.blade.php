@extends('errors.main')
@push('title')
    <title >503 Service Unavailable </title>
@endpush
@section('main-section')
    <div class="container">
        <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <h1>503</h1>
            <h2>SERVICE UNAVAILABLE</h2>
            <a class="btn" href="/">Back to home</a>
            <img src="{{ url('/') }}/assets/img/not-found.svg" class="img-fluid py-2" alt="Page Not Found">
    </div>
    </section>

    </div>
@endsection
