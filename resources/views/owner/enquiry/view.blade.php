@extends('owner.main')
@push('title')
    <title>All Enquiries</title>
@endpush
@section('main-section')
    <div class="pagetitle d-flex flex-wrap gap-3 justify-content-between align-items-center">
        <div>
            <h1>Enquiries</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('owner-dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Enquiries</li>
                    <li class="breadcrumb-item active">{{ $hostel_name }} / Enquiries Details</li>
                </ol>
            </nav>
        </div>
        <div>
            <form action="{{ route('owner-show-enquiry', ['id' => request()->route('id')]) }}" method="POST"
                class="row row-cols-lg-auto gx-3 align-items-center">
                @csrf
                <div class="col-12">
                    <label class="form-label" for="from-date">From Date</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="from_date" id="from-date" placeholder="From Date">
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label" for="from-date">To Date</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="to_date" id="to-date" placeholder="To Date">
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </div>
            </form>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Enquiries</h5>
                        <div class="table-responsive">
                            <!-- Table with stripped rows -->
                            <table class="table table-bordered border-primary table-striped datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">User Details</th>
                                        {{-- <th scope="col">Room Details</th> --}}
                                        <th scope="col">Description</th>
                                        <th scope="col" class="text-start">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($enquiries as $key => $enquiry)
                                        <tr>
                                            <th scope="row" class="text-center">{{ ++$key }}</th>
                                            <td>
                                                <span class="d-flex"><span class="fw-bold">Name :
                                                        &nbsp;</span>{{ $enquiry->name }}</span>
                                                <span class="d-flex"><span class="fw-bold">Email : &nbsp;</span><a
                                                        href="mailto:{{ $enquiry->email }}">{{ $enquiry->email }}</a></span>
                                                <span class="d-flex"><span class="fw-bold">Phone : &nbsp;</span><a
                                                        href="tel:+91 {{ $enquiry->phone }}">{{ $enquiry->phone }}</a></span>
                                            </td>
                                            {{-- <td>
                                          <span class="d-flex"><span class="fw-bold">A.C. : &nbsp;</span>{{ $enquiry->ac }}</span>
                                          <span class="d-flex"><span class="fw-bold">Room Type : &nbsp;</span>{{ $enquiry->room_type }}</span>
                                          <span class="d-flex"><span class="fw-bold">Date/Time : &nbsp;</span>{{ $enquiry->date . " / " . $enquiry->time }}</span>
                                        </td> --}}
                                            <td>{{ $enquiry->description }}</td>
                                            <td class="text-start">{{ $enquiry->created_at }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('owner-destroy-enquiry', ['id' => $enquiry->id]) }}">
                                                    <button type="button" class="btn btn-danger me-2"><i
                                                            class="bi bi-trash"></i></button>
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
