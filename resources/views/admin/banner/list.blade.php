@extends('admin.main')
@push('title')
    <title>All Banner</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Banner</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Banner</a></li>
                <li class="breadcrumb-item active">All Banner</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Banner</h5>
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Link</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $key => $item)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ $item->city }}</td>
                                            <td><img src="{{ $item->banner }}" class="img-fluid" ></td>
                                            <td><a href="{{ $item->link }}" target="_blank">Click Me</a></td>
                                            <td>
                                                <a href="{{ route('admin-edit-banner', ['id' => $item->id]) }}">
                                                    <button type="button" class="btn btn-warning mx-2"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                </a>
                                                <a href="{{ route('admin-destroy-banner', ['id' => $item->id]) }}" onclick="return confirmDelete()">
                                                    <button type="button" class="btn btn-danger mx-2"><i
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
