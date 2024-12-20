@extends('agent.main')
@push('title')
    <title>All Owner</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Owners</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('agent-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Owners</li>
                <li class="breadcrumb-item active">All Owners</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Owners</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Profile Image</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($owners as $key => $owner)
                                    <tr style="height: 100px;">
                                        <th scope="row">{{ ++$key }}</th>
                                        <td><img src="{{ getImage($owner->id, $owner->image) }}" height="80px" width="80px" alt="">
                                        </td>
                                        <td>
                                            <span class="d-flex">Name : {{ $owner->name }}</span>
                                            <span class="d-flex">Email : {{ $owner->email }}</span>
                                            <span class="d-flex">Phone : {{ $owner->phone }}</span>
                                            <span class="d-flex">Address : {{ $owner->address }}</span>
                                        </td>
                                        <td class="align-middle">{{ $owner->gender }}</td>
                                        <td class="align-middle">
                                            @if ($owner->status == 'active')
                                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                    Active</span>
                                            @else
                                                <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>
                                                    Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-danger align-middle" style="width: 100px !important">
                                            <a href="{{ route('agent-show-owner', ['id' => $owner->id]) }}">
                                                <button type="button" class="btn btn-success me-2"><i
                                                        class="bi bi-eye"></i></button>
                                            </a>
                                            <a href="{{ route('agent-edit-owner', ['id' => $owner->id]) }}">
                                                <button type="button" class="btn btn-warning me-2"><i
                                                        class="bi bi-pencil-square"></i></button>
                                            </a>
                                            {{-- <a href="{{ route('agent-destroy-owner', ['id' => $owner->id]) }}">
                                                <button type="button" class="btn btn-danger me-2"><i
                                                        class="bi bi-trash"></i></button>
                                            </a> --}}
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
    </section>
@endsection
