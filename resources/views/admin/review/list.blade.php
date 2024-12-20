@extends('admin.main')
@push('title')
    <title>All Reviews</title>
@endpush
@section('main-section')
<div class="pagetitle">
    <h1>Reviews</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Review</a></li>
        <li class="breadcrumb-item active">All Reviews</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">All Reviews</h5>
            <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Hostel Name</th>
                    <th scope="col">Star</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($reviews as $key => $review)
                    <tr>
                      <th scope="row">{{ ++$key }}</th>
                      <td>{{ $review->user->name }}</td>
                      <td>{{ $review->hostel->hostel_name }}</td>
                      <td class="custom-width">
                        {{ $review->star }} <i class="bi bi-star-fill text-warning"></i>
                      </td>
                      <td>{{ $review->description }}</td>
                      <td>
                          <a href="{{ route('admin-destroy-review', ['id' => $review->id]) }}" onclick="return confirmDelete()">
                            <button type="button" class="btn btn-danger m-1"><i class="bi bi-trash"></i></button>
                          </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection