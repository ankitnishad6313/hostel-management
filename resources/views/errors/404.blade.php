@extends('errors.main')
@push('title')
    <title>404 Pages Not Found </title>
@endpush
@section('main-section')
    <div class="container">
        <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <h1>404</h1>
            <h2>The page you are looking for doesn't exist.</h2>
            <a class="btn" href="/">Back to home</a>
            <img src="{{ url('/') }}/assets/img/not-found.svg" class="img-fluid py-2" alt="Page Not Found">
            <img src="{{ url('/') }}/assets/img/not-found.svg" class="img-fluid py-2" alt="Page Not Found">
    </div>
    </section>

    </div>
@endsection
