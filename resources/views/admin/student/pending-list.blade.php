@extends('admin.main')
@push('title')
    <title>All Students</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Students</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Students</li>
                <li class="breadcrumb-item active">All Students</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pending Students</h5>
                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table table-stripped datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Student Details</th>
                                        <th scope="col">Other Details</th>
                                        <th scope="col">Booking Details</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $key => $student)
                                        <tr style="height: 100px;">
                                            <th scope="row">{{ ++$key }}</th>
                                            <td><img src="{{ getImage($student->user_id, $student->user->image) }}" height="80px" width="80px"
                                                    alt="">
                                            </td>
                                            <td>
                                                <span class="d-flex">Name : {{ $student->user->name }}</span>
                                                <span class="d-flex">Mother Name : {{ $student->user->mother_name }}</span>
                                                <span class="d-flex">Father Name : {{ $student->user->father_name }}</span>
                                            </td>
                                            <td>
                                                <span class="d-flex">Email : {{ $student->user->email }}</span>
                                                <span class="d-flex">Phone : {{ $student->user->phone }}</span>
                                                <span class="d-flex">Address : {{ $student->user->address }}</span>
                                            </td>
                                            <td>
                                                <span class="d-flex">Room/Bed :
                                                    {{ $student->room->room_name }}/{{ $student->bed->bed_name }}</span>
                                                <span class="d-flex">Rent :
                                                    {{ $student->rent }}</span>
                                                <span class="d-flex">Due Rent :
                                                    {{ $student->due_payment }}</span>
                                            </td>
                                            <td>
                                                @if ($student->user->status == 'active')
                                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                        Active</span>
                                                @else
                                                    <span class="badge bg-danger"><i
                                                            class="bi bi-exclamation-octagon me-1"></i>
                                                        Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-danger align-middle" style="width: 100px !important">
                                                <a href="{{ route('admin-show-student', ['id' => $student->user->id]) }}">
                                                    <button type="button" class="btn btn-success me-2" title="Show Student"><i
                                                            class="bi bi-eye"></i></button>
                                                </a>
                                                <a href="{{ route('admin-confirm-booking', ['id' => $student->id]) }}">
                                                    <button type="button" class="btn btn-warning me-2">Confirm Booking</button>
                                                </a>
                                                <a href="{{ route('owner-destroy-student', ['id' => $student->user->id]) }}">
                                                    <button type="button" class="btn btn-danger me-2" title="Delete Booking"><i
                                                            class="bi bi-trash"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
