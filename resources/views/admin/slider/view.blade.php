@extends('admin.main')
@push('title')
    <title>View Slider</title>
@endpush
@section('main-section')
<div class="pagetitle">
    <h1>Slider</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Room</a></li>
        <li class="breadcrumb-item active">Slider Details</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection