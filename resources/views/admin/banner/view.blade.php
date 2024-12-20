@extends('admin.main')
@push('title')
    <title>View Banner</title>
@endpush
@section('main-section')
<div class="pagetitle">
    <h1>Banner</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Banner</a></li>
        <li class="breadcrumb-item active">Banner Details</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection