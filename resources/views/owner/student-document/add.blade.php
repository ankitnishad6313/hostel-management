@extends('owner.main')
@push('title')
    <title>Add Document</title>
@endpush
@section('main-section')
    <div class="pagetitle position-relative">
        <h1>Document</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('owner-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Document</a></li>
                <li class="breadcrumb-item active">Add Document</li>
            </ol>
        </nav>

        @php
            $role = strtolower($user->role);
        @endphp
        <div class="position-absolute top-0 end-0 p-2">
            <a href="{{ route("owner-show-$role", ['id' => $user->id]) }}" class="btn btn-outline-dark">View
                {{ ucfirst($role) }}</a>
        </div>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body form-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Add Documents Below</h5>
                        </div>

                        <form action="{{ route('owner-student-store-document', ['id' => $user['id']]) }}" method="POST"
                            enctype="multipart/form-data" class="g-3 needs-validation" novalidate>
                            @csrf

                            <fieldset>
                                <legend>Documents:</legend>
                                <div id="fieldsContainer">
                                    <div class="row fields-row mb-4">
                                        <div class="col-3">
                                            <label for="name" class="form-label fw-bold">Document Name <sup
                                                    class="text-danger">*</sup></label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend"><i
                                                        class="bi bi-type"></i></span>
                                                <input type="text" name="document_name[]" class="form-control"
                                                    placeholder="Enter Document Name" required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <label for="image" class="form-label fw-bold">Document Image Front <sup
                                                    class="text-danger">*</sup></label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend"><i
                                                        class="bi bi-card-checklist"></i></span>
                                                <input type="file" name="document_image_front[]" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <label for="image" class="form-label fw-bold">Document Image Back</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend"><i
                                                        class="bi bi-card-checklist"></i></span>
                                                <input type="file" name="document_image_back[]" value="default"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-3 position-relative d-grid align-content-end">
                                            <button type="button"
                                                class="btn btn-outline-danger w-100 removeBtn">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-outline-success w-25" id="addMoreBtn">Add
                                            More</button>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-50 text-center" type="submit">Add Document</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </div>
    </section>

    @isset($documents)
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body form-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Edit Documents Below</h5>
                            </div>

                            @foreach ($documents as $document)
                                <form action="{{ route('owner-student-update-document', ['id' => $document->id]) }}"
                                    method="POST" enctype="multipart/form-data" class="g-3 needs-validation" novalidate>
                                    @csrf

                                    <div id="fieldsContainer">
                                        <div class="row fields-row mb-4">
                                            <div class="col">
                                                <label for="name" class="form-label fw-bold">Document Name <sup
                                                        class="text-danger">*</sup></label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                                            class="bi bi-type"></i></span>
                                                    <input type="text" name="document_name"
                                                        value="{{ $document->document_name }}" class="form-control"
                                                        placeholder="Enter Document Name" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="image" class="form-label fw-bold">Document Image Front <sup
                                                        class="text-danger">*</sup></label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                                            class="bi bi-card-checklist"></i></span>
                                                    <input type="file" name="document_image_front" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="image" class="form-label fw-bold">Document Image Back</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                                            class="bi bi-card-checklist"></i></span>
                                                    <input type="file" name="document_image_back" value="default"
                                                        class="form-control">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label for="status" class="form-label fw-bold">Status</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                                            class="bi bi-card-checklist"></i></span>
                                                    <select name="status" id="status" class="form-select">
                                                        <option value="pending"
                                                            {{ $document->document_status == 'pending' ? 'selected' : '' }}>
                                                            Pending</option>
                                                        <option value="verified"
                                                            {{ $document->document_status == 'verified' ? 'selected' : '' }}>
                                                            Verified</option>
                                                        <option value="not_verified"
                                                            {{ $document->document_status == 'not_verified' ? 'selected' : '' }}>
                                                            Not Verified</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col position-relative d-grid align-content-end">
                                                <button class="btn btn-primary w-100 text-center"
                                                    type="submit">Upadte</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </section>
    @endisset
@endsection

@section('script-section')
    <script>
        $(document).ready(function() {
            $('#addMoreBtn').click(function() {
                var newFieldsGroup = $('.fields-row').first().clone();
                newFieldsGroup.find('input[type="text"], input[type="file"]').val(
                    ''); // Clear input values
                newFieldsGroup.find('.removeBtn').click(function() {
                    $(this).closest('.fields-row').remove();
                });
                $('#fieldsContainer').append(newFieldsGroup);
            });
        });
    </script>
@endsection
