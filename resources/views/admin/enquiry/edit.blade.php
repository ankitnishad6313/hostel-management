@extends('admin.main')
@push('title')
    <title></title>
@endpush
@section('main-section')
<div class="pagetitle">
    <h1>Enquiry</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Enquiry</a></li>
        <li class="breadcrumb-item active">Edit Enquiry</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

@endsection