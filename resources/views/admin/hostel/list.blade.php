@extends('admin.main')
@push('title')
    <title>All Hostels / PG</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Hostels</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Hostels</a></li>
                <li class="breadcrumb-item active">All Hostels</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Hostels / PG</h5>
                        <form action="{{ route('admin-list-hostel') }}" method="GET"
                            class="row row-cols-1 row-cols-sm-auto g-3 align-items-center mb-4">
                            @csrf
                            <div class="col-12">
                                <label class="form-label" for="address">Address</label>
                                <div class="input-group">
                                    <input type="text" name="address" class="form-control"
                                        value="@php echo isset($_GET['address']) ? $_GET['address'] : "" @endphp"
                                        id="address" placeholder="Address">
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="city">City</label>
                                <select class="form-select" name="city" id="city">
                                    <option value="" selected>Select City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->city }}"
                                            @php if(isset($_GET['city'])) {
                                      echo ($_GET['city'] == $city->city) ? "selected" : "";
                                    } @endphp>
                                            {{ $city->city }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Gender Type</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender_type" id="all_gender"
                                            @php if(isset($_GET['gender_type'])) {
                                        echo ($_GET['gender_type'] == 'on') ? "checked" : "";
                                      } @endphp>
                                        <label class="form-check-label" for="all_gender">
                                            All
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender_type" value="boys"
                                            id="boys"
                                            @php if(isset($_GET['gender_type'])) {
                                        echo ($_GET['gender_type'] == 'boys') ? "checked" : "";
                                      } @endphp>
                                        <label class="form-check-label" for="boys">
                                            Boys
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender_type" value="girls"
                                            id="girls"
                                            @php if(isset($_GET['gender_type'])) {
                                        echo ($_GET['gender_type'] == 'girls') ? "checked" : "";
                                      } @endphp>
                                        <label class="form-check-label" for="girls">
                                            Girls
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Property Type</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="property_type"
                                            id="all_property"
                                            @php if(isset($_GET['property_type'])) {
                                        echo ($_GET['property_type'] == 'on') ? "checked" : "";
                                      } @endphp>
                                        <label class="form-check-label" for="all_property">
                                            All
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="property_type" value="hostel"
                                            id="hostel"
                                            @php if(isset($_GET['property_type'])) {
                                        echo ($_GET['property_type'] == 'hostel') ? "checked" : "";
                                      } @endphp>
                                        <label class="form-check-label" for="hostel">
                                            Hostel
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="property_type" value="pg"
                                            id="pg"
                                            @php if(isset($_GET['property_type'])) {
                                        echo ($_GET['property_type'] == 'pg') ? "checked" : "";
                                      } @endphp>
                                        <label class="form-check-label" for="pg">
                                            PG
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive" style="overflow-x: scroll">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Profile Pic</th>
                                        <th>Hostel/PG Details</th>
                                        <th>Other Details</th>
                                        <th>Hostel Status</th>
                                        <th>Agent Detail</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hostels as $key => $hostel)
                                        <tr>
                                            <th>{{ ++$key }}</th>
                                            <td><img src="{{ getImage($hostel->user->id, $hostel->user->image) }}"
                                                    height="80px" width="80px" alt="">
                                            <td>
                                                <span class="d-flex"><span class="fw-bold">Owner Name </span> :
                                                    {{ $hostel->user->name }}</span>
                                                <span class="d-flex"><span class="fw-bold">Hostel Name </span> :
                                                    {{ $hostel->hostel_name }}</span>
                                                <span class="d-flex"><span class="fw-bold">Address </span> :
                                                    {{ $hostel->hostel_address }}</span>
                                            </td>
                                            <td>
                                                <span class="d-flex"><span class="fw-bold">City </span> :
                                                    {{ $hostel->city }}</span>
                                                <span class="d-flex"><span class="fw-bold">Property Type </span> :
                                                    {{ $hostel->property_type }}</span>
                                                <span class="d-flex"><span class="fw-bold">Gender Type </span> :
                                                    {{ $hostel->gender_type }}</span>
                                            </td>
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
                                            <td>
                                                {!! agentDetails($hostel->agent_id) !!}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin-show-hostel', ['id' => $hostel->id]) }}">
                                                    <button type="button" class="btn btn-success me-2"><i
                                                            class="bi bi-eye"></i></button>
                                                </a>
                                                <a href="{{ route('admin-edit-hostel', ['id' => $hostel->id]) }}">
                                                    <button type="button" class="btn btn-warning me-2"><i
                                                            class="bi bi-pencil-square"></i></button>
                                                </a>
                                                <a href="{{ route('admin-destroy-hostel', ['id' => $hostel->id]) }}"
                                                    onclick="return confirmDelete()">
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
