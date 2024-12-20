@extends('admin.main')
@push('title')
    <title>Agent Details</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <div class="d-flex flex-wrap justify-content-between gap-3">
            <div>
                <h1>Agents</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Agents</a></li>
                        <li class="breadcrumb-item active">{{ $user->name }}</li>
                    </ol>
                </nav>
            </div>
    
            <div>
                <a href="{{ route('admin-edit-agent', ['id' => $user->id]) }}" class="btn btn-outline-dark">Edit Agent</a>
                <a href="{{ route('admin-edit-document', ['id' => $user->id]) }}" class="btn btn-outline-dark">Add / Edit
                    Documents</a>
            </div>
        </div>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ getImage($user->id, $user->image) }}" alt="Profile" class="rounded-circle">
                        <h2>{{ $user->name }}</h2>
                        <h3>{{ ucfirst($user->role) }}</h3>
                        <div class="social-links mt-2">
                            <a href="{{ $user->twitter }}" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="{{ $user->facebook }}" target="_blank" class="facebook"><i
                                    class="bi bi-facebook"></i></a>
                            <a href="{{ $user->instagram }}" target="_blank" class="instagram"><i
                                    class="bi bi-instagram"></i></a>
                            <a href="{{ $user->linkedin }}" target="_blank" class="linkedin"><i
                                    class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">About</h5>
                                <p class="small fst-italic">{{ $user->about }}</p>

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Gender</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->gender }}</div>
                                </div>

                                {{-- <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Job</div>
                                    <div class="col-lg-9 col-md-8">Web Designer</div>
                                </div> --}}

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Country</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->country }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->address }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8"><a href="tel:+91 {{ $user->phone }}" target="_blank">+91 {{ $user->phone }}</a></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8"><a href="mailto:{{ $user->email }}" target="_blank">{{ $user->email }}</a></div>
                                </div>

                            </div>
                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Documents</h5>

                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Document</th>
                                        <th scope="col">Front Side Image</th>
                                        <th scope="col">Back Side Image</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($documents as $key => $document)
                                        <tr style="height: 100px;">
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ $document->document_name }}</td>
                                            <td><a href="{{ $document->document_image_front }}" target="_blank"><img
                                                        src="{{ $document->document_image_front }}"
                                                        alt="Document Image Front" style="max-width: 200px;"></a></td>
                                            <td><a href="{{ $document->document_image_back }}" target="_blank"><img
                                                        src="{{ $document->document_image_back }}"
                                                        alt="Document Image Back" style="max-width: 200px;"></a></td>
                                            <td>
                                                @if ($document->document_status == 'verified')
                                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                        Verified</span>
                                                @elseif($document->document_status == 'pending')
                                                    <span class="badge bg-warning"><i
                                                            class="bi bi-exclamation-triangle me-1"></i>
                                                        Pending</span>
                                                @else
                                                    <span class="badge bg-danger"><i
                                                            class="bi bi-exclamation-octagon me-1"></i>
                                                        Not Verified</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin-destroy-document', ['id' => $document->id]) }}">
                                                    <button type="button" class="btn btn-danger me-2"><i
                                                            class="bi bi-trash"></i></button>
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

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Added Hostels</h5>

                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Owner Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hostels as $key => $hostel)
                                        <tr style="height: 100px;">
                                            <th scope="row">{{ ++$key }}</th>
                                            <td><a
                                                    href="{{ route('admin-show-hostel', ['id' => $hostel->id]) }}">{{ $hostel->hostel_name }}</a>
                                            </td>
                                            <td><a
                                                    href="{{ route('admin-show-owner', ['id' => $hostel->user->id]) }}">{{ $hostel->user->name }}</a>
                                            </td>
                                            <td>{{ $hostel->hostel_address }}</td>
                                            <td>
                                                @if ($hostel->hostel_status == 'active')
                                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                        Active</span>
                                                @else
                                                    <span class="badge bg-danger"><i
                                                            class="bi bi-exclamation-octagon me-1"></i>
                                                        Inactive</span>
                                                @endif
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
