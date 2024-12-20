@extends('admin.main')
@push('title')
    <title>View City</title>
@endpush
@section('main-section')
<div class="pagetitle">
    <h1>City</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">City</a></li>
        <li class="breadcrumb-item active">City Details</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection