@extends('owner.main')
@push('title')
    <title></title>
@endpush
@section('main-section')
<div class="pagetitle">
    <h1>Hostels</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('owner-dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item">Hostels</li>
        <li class="breadcrumb-item active">Hostel Details</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
@endsection