@extends('admin.main')
@push('title')
    <title>All Agent</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Agents</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Agents</a></li>
                <li class="breadcrumb-item active">All Agents</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Agents</h5>
                        <div class="table-responsive">
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
                                    @foreach ($agents as $key => $agent)
                                        <tr style="height: 100px;">
                                            <th scope="row">{{ ++$key }}</th>
                                            <td><img src="{{ getImage($agent->id, $agent->image) }}" height="80px" width="80px" alt="">
                                            </td>
                                            <td>
                                                <span class="d-flex">Name : {{ $agent->name }}</span>
                                                <span class="d-flex">Email : {{ $agent->email }}</span>
                                                <span class="d-flex">Phone : {{ $agent->phone }}</span>
                                                <span class="d-flex">Address : {{ $agent->address }}</span>
                                            </td>
                                            <td class="align-middle">{{ $agent->gender }}</td>
                                            <td class="align-middle">
                                                @if ($agent->status == 'active')
                                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>
                                                        Active</span>
                                                @else
                                                    <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>
                                                        Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-danger align-middle">
                                                <a href="{{ route('admin-show-agent', ['id' => $agent->id]) }}">
                                                    <button type="button" class="btn btn-success me-2"><i
                                                            class="bi bi-eye"></i></button>
                                                </a>
                                                <a href="{{ route('admin-edit-agent', ['id' => $agent->id]) }}">
                                                    <button type="button" class="btn btn-warning me-2"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                </a>
                                                <a href="{{ route('admin-destroy-agent', ['id' => $agent->id]) }}" onclick="return confirmDelete()">
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
@endsection
