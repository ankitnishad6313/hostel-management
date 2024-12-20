@extends('admin.main')
@push('title')
    <title>View Blog</title>
@endpush
@section('main-section')
<div class="pagetitle">
    <h1>Blog</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Blog</a></li>
        <li class="breadcrumb-item active">Blog Details</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row align-items-top">
      <!-- Card with an image on top -->
      <div class="card py-2">
        <img src="{{ $blog->image }}" class="card-img-top h-50" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{ $blog->title }}</h5>
          {!! $blog->description !!}
        </div>
      </div><!-- End Card with an image on top -->
    </div>
  </section>
@endsection