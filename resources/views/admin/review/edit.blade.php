@extends('admin.main')
@push('title')
    <title>Reviews</title>
@endpush
@section('main-section')
<div class="pagetitle">
    <h1></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Review</a></li>
        <li class="breadcrumb-item active">Edit Review</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

@endsection