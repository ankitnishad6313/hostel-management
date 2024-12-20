@extends('admin.main')
@push('title')
    <title>All Blogs</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Blog</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Blog</a></li>
                <li class="breadcrumb-item active">All Blogs</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Blogs</h5>
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $key => $item)
                                        <tr >
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ $item->title }}</td>
                                            <td><img src="{{ $item->image }}" style="height: 150px; width:100%; object-fit:contain" alt=""></td>
                                            <td>
                                                <a href="{{ route('admin-show-blog', ['id' => $item->id]) }}">
                                                    <button type="button" class="btn btn-success mx-2"><i
                                                            class="bi bi-eye"></i></button>
                                                </a>
                                                <a href="{{ route('admin-edit-blog', ['id' => $item->id]) }}">
                                                    <button type="button" class="btn btn-warning mx-2"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                </a>
                                                <a href="{{ route('admin-destroy-blog', ['id' => $item->id]) }}" onclick="return confirmDelete()">
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
