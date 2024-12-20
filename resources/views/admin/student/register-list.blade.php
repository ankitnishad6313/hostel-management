@extends('admin.main')
@push('title')
    <title>Registerd Students</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Students</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Students</li>
                <li class="breadcrumb-item active">Registerd Students</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Registerd Students</h5>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive" style="overflow-x: scroll">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Student Details</th>
                                        <th scope="col" style="width: 30% !important">Other Details</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $key => $student)
                                        <tr style="height: 100px;">
                                            <th scope="row">{{ ++$key }}</th>
                                            <td><img src="{{ getImage($student->id, $student->image) }}" height="80px" width="80px"
                                                    alt="">
                                            </td>
                                            <td>
                                                <span class="d-flex">Name : {{ $student->name }}</span>
                                                <span class="d-flex">Mother Name : {{ $student->mother_name }}</span>
                                                <span class="d-flex">Father Name : {{ $student->father_name }}</span>
                                            </td>
                                            <td>
                                                <span class="d-flex">Email : <a href="mailto:{{ $student->email }}">{{ $student->email }}</a></span>
                                                <span class="d-flex">Phone : <a href="tel:{{ $student->phone }}">{{ $student->phone }}</a></span>
                                                <span class="d-flex">Address : {{ $student->address }}</span>
                                            </td>
                                            <td class="align-middle">
                                                @if ($student->status == 'active')
                                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                        Active</span>
                                                @else
                                                    <span class="badge bg-danger"><i
                                                            class="bi bi-exclamation-octagon me-1"></i>
                                                        Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-danger align-middle" style="width: 100px !important">
                                                <a href="{{ route('admin-show-student', ['id' => $student->id]) }}">
                                                    <button type="button" class="btn btn-success me-2"><i
                                                            class="bi bi-eye"></i></button>
                                                </a>
                                                <a href="{{ route('admin-edit-student', ['id' => $student->id]) }}">
                                                    <button type="button" class="btn btn-warning me-2"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                </a>
                                                <a href="{{ route('admin-destroy-student', ['id' => $student->id]) }}" onclick="return confirmDelete()">
                                                    <button type="button" class="btn btn-danger me-2"><i
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
