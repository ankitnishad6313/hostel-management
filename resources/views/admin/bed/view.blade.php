@extends('admin.main')
@push('title')
    <title>Beds</title>
@endpush
@section('main-section')
<div class="pagetitle">
    <h1>Beds</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Beds</a></li>
        <li class="breadcrumb-item active">Hostel Beds</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bed Student Details</h5>

                    <!-- Table with stripped rows -->
                    <div class="table-responsive" style="overflow-x: scroll">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Student Detail</th>
                                    <th scope="col" style="width: 30% !important">Other Details</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr style="height: 100px;">
                                        <td><img src="{{ getImage($student->user->image) }}" height="80px" width="80px"
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
                                        <td class="align-middle">{{ $student->user->gender }}</td>
                                        <td class="align-middle">
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
                                                <button type="button" class="btn btn-success me-2"><i
                                                        class="bi bi-eye"></i></button>
                                            </a>
                                            <a href="{{ route('admin-edit-student', ['id' => $student->user->id]) }}">
                                                <button type="button" class="btn btn-warning me-2"><i
                                                        class="bi bi-pencil-square"></i></button>
                                            </a>
                                            <a href="{{ route('admin-destroy-student', ['id' => $student->user->id]) }}">
                                                <button type="button" class="btn btn-danger me-2"><i
                                                        class="bi bi-trash"></i></button>
                                            </a>
                                        </td>
                                    </tr>
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