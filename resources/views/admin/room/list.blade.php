@extends('admin.main')
@push('title')
    <title>Room</title>
@endpush
@section('main-section')
<div class="pagetitle">
    <h1>Rooms</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Room</a></li>
        <li class="breadcrumb-item active">All Room</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

@endsection