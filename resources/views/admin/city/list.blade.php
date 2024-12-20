@extends('admin.main')
@push('title')
    <title>All City</title>
@endpush
@section('main-section')
<div class="pagetitle">
    <h1>City</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">City</a></li>
        <li class="breadcrumb-item active">All City</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">All City</h5>
            <div class="table-responsive" style="overflow-x: scroll">
            <!-- Table with stripped rows -->
            <table class="table datatable text-center">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">City</th>
                  <th scope="col">Image</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($city as $key => $item)
                  <tr style="height: 80px;">
                    <th scope="row">{{ ++$key }}</th>
                    <td>{{ $item->city }}</td>
                    <td><img src="{{ $item->image }}" class="d-block m-auto" alt="City Icon" height="80px" width="80px"></td>
                    <td>
                        @if ($item->status == "active")
                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Active</span>
                        @else
                        <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin-edit-city', ['id' => $item->id]) }}">
                          <button type="button" class="btn btn-warning mx-2"><i class="bi bi-pencil-square"></i></button>
                        </a>
                        <a href="{{ route('admin-destroy-city', ['id' => $item->id]) }}" onclick="return confirmDelete()">
                          <button type="button" class="btn btn-danger mx-2"><i class="bi bi-trash"></i></button>
                        </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection