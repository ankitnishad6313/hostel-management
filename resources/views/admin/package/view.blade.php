@extends('admin.main')
@push('title')
    <title>View Package</title>
@endpush
@section('main-section')
<div class="pagetitle">
    <h1>Package</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Package</a></li>
        <li class="breadcrumb-item active">Package Details</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection