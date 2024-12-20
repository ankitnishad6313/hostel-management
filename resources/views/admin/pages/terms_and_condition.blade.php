@extends('admin.main')
@push('title')
    <title>Terms and Condition</title>
@endpush
@section('main-section')

    <div class="pagetitle position-relative">
      <h1>Terms and Condition</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Pages</a></li>
          <li class="breadcrumb-item active">Terms and Condition</li>
        </ol>
      </nav>

      <div class="position-absolute top-0 end-0">
        <a href="{{ route('terms-and-condition-edit', ['id' => $data->id]) }}">
            <button type="button" class="btn btn-warning mx-2"><i class="bi bi-pencil-square"></i></button>
        </a>
    </div>

    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              {!! $data->content !!}
            </div>
          </div>

        </div>

      </div>
    </section>
@endsection