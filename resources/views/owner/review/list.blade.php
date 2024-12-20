@extends('owner.main')
@push('title')
    <title>All Reviews</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Review</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('owner-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Review</li>
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
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Hostel</th>
                                    <th scope="col">Total Reviews</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $key => $review)
                                    <tr>
                                        <th scope="row">{{ ++$key }}</th>
                                        <td>
                                            <a href="{{ route('owner-show-review', ['id' => $review->hostel->id]) }}">
                                                {{ $review->hostel->hostel_name }}
                                            </a>
                                        </td>
                                        <td>{{ $review->review_count }}</td>
                                        <td>
                                            <a href="{{ route('owner-show-review', ['id' => $review->hostel->id]) }}">
                                                <button type="button" class="btn btn-success mx-2"><i
                                                        class="bi bi-eye"></i></button>
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
