@extends('admin.main')
@push('title')
    <title>Admin Dashboard</title>
@endpush
@section('main-section')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Owner Card -->
                    <div class="col-lg-4 col-sm-12">
                        <div class="card info-card sales-card">

                            <a href="{{ route('admin-list-owner') }}">
                                <div class="card-body">
                                    <h5 class="card-title">Owners </h5> {{-- <span>| Today</span> --}}

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $data['owner'] }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div><!-- End Owner Card -->

                    <!-- Hostel Card -->
                    <div class="col-lg-4 col-sm-12">
                        <div class="card info-card hostel-card">

                            <a href="{{ route('admin-list-hostel') }}">
                                <div class="card-body">
                                    <h5 class="card-title">Hostels </h5> {{-- <span>| Today</span> --}}

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-building"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $data['hostel'] }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div><!-- End Hostel Card -->

                    <!-- Agent Card -->
                    <div class="col-lg-4 col-sm-12">
                        <div class="card info-card revenue-card">

                            <a href="{{ route('admin-list-agent') }}">
                                <div class="card-body">
                                    <h5 class="card-title">Agents </h5> {{-- <span>| This Month</span> --}}

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $data['agent'] }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div><!-- End Agent Card -->

                    <!-- Student Card -->
                    <div class="col-lg-4 col-sm-12">

                        <div class="card info-card customers-card">

                            <a href="{{ route('admin-boarding-student') }}">
                                <div class="card-body">
                                    <h5 class="card-title">Students </h5> {{-- <span>| This Year</span> --}}

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $data['student'] }}</h6>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>

                    </div><!-- End Student Card -->

                    <!-- Enquiry Card -->
                    <div class="col-lg-4 col-sm-12">

                        <div class="card info-card enquiry-card">

                            <a href="{{ route('admin-list-enquiry') }}">
                                <div class="card-body">
                                    <h5 class="card-title">Enquiries </h5> {{-- <span>| This Year</span> --}}

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-chat-left-text"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $data['enquiry'] }}</h6>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>

                    </div><!-- End Enquiry Card -->

                    <!-- Booking Card -->
                    <div class="col-lg-4 col-sm-12">

                        <div class="card info-card booking-card">

                            <a href="{{ route('admin-list-bookings') }}">
                                <div class="card-body">
                                    <h5 class="card-title">Bookings </h5> {{-- <span>| This Year</span> --}}

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-card-checklist"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $data['booking'] }}</h6>
                                        </div>
                                    </div>

                                </div>
                            </a>
                        </div>

                    </div><!-- End Booking Card -->

                    {{-- <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Reports <span>/Today</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: 'Sales',
                                                data: [31, 40, 28, 51, 42, 82, 56],
                                            }, {
                                                name: 'Revenue',
                                                data: [11, 32, 45, 32, 34, 52, 41]
                                            }, {
                                                name: 'Customers',
                                                data: [15, 11, 32, 18, 9, 24, 11]
                                            }],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                type: 'datetime',
                                                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z",
                                                    "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z",
                                                    "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                                                    "2018-09-19T06:30:00.000Z"
                                                ]
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy HH:mm'
                                                },
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports --> --}}

                    <!-- Recent Bookings -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">Recent Bookings</h5>

                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Hostel</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['recent_bookings'] as $key => $student)
                                            <tr style="height: 100px;">
                                                <th scope="row">{{ ++$key }}</th>
                                                <td>{{ $student->user->name }}</td>
                                                <td>{{ $student->hostel->hostel_name }}</td>
                                                <td>
                                                    @if ($student->booking_status == 'booked')
                                                        <h5 class="badge bg-success">Booked</h5>
                                                    @elseif($student->booking_status == 'cancel')
                                                        <h5 class="badge bg-danger">Cancel</h5>
                                                    @else
                                                        <h5 class="badge bg-warning">Pending</h5>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a
                                                        href="{{ route('admin-show-student', ['id' => $student->user->id]) }}">
                                                        <button type="button" class="btn btn-success me-2"><i
                                                                class="bi bi-eye"></i></button>
                                                    </a>
                                                    <a
                                                        href="{{ route('admin-edit-student', ['id' => $student->user->id]) }}">
                                                        <button type="button" class="btn btn-warning me-2"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </a>
                                                    <a
                                                        href="{{ route('admin-destroy-student', ['id' => $student->user->id]) }}">
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
                    </div><!-- End Recent Bookings -->

                    <!-- Recent Added Hostels -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            <div class="card-body pb-0">
                                <h5 class="card-title">Recent Added Hostels</h5> {{-- <span>| Today</span> --}}

                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Hostel/PG</th>
                                            <th>Owner Name</th>
                                            <th>Added On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['hostels'] as $key => $hostel)
                                            <tr>
                                                <th>{{ ++$key }}</th>
                                                <td>{{ $hostel->hostel_name }}</td>
                                                <td>{{ $hostel->user->name }}</td>
                                                <td>{{ getFormatedDate($hostel->created_at, 'd-M-Y') }}</td>
                                                <td>
                                                    <a href="{{ route('admin-show-hostel', ['id' => $hostel->id]) }}">
                                                        <button type="button" class="btn btn-success me-2"><i
                                                                class="bi bi-eye"></i></button>
                                                    </a>
                                                    <a href="{{ route('admin-edit-hostel', ['id' => $hostel->id]) }}">
                                                        <button type="button" class="btn btn-warning me-2"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </a>
                                                    <a href="{{ route('admin-destroy-hostel', ['id' => $hostel->id]) }}">
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
                    </div><!-- End Recent Added Hostels -->

                </div>
            </div><!-- End Left side columns -->
            
            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Enquiries -->
                <div class="card">

                    <div class="card-body pb-0">
                        <h5 class="card-title">Enquiries </h5> {{-- <span>| Today</span> --}}

                        <div class="news">

                            @foreach ($data['enquiries'] as $enquiry)
                                <div class="post-item clearfix">
                                    <img src="{{ getImage($enquiry->user->id,$enquiry->user->image) }}"
                                        style="height: 50px; width:50px; object-fit:fit" alt="">
                                    <h4><a
                                            href="{{ route('admin-show-enquiry', ['id' => $enquiry->hostel_id]) }}">{{ $enquiry->name }}</a>
                                    </h4>
                                    <p>{{ substr($enquiry->description, 0, 30) }}</p>
                                </div>
                            @endforeach

                        </div><!-- End sidebar Enquiries -->

                    </div>
                </div><!-- End Enquiries -->
                 <!-- Gender Waise Students -->
                 <div class="card">
                    {{-- <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div> --}}

                    <div class="card-body pb-0">
                        <h5 class="card-title">Gender Wise Students </h5> {{-- <span>| Today</span> --}}

                        <div id="gender-chart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                echarts.init(document.querySelector("#gender-chart")).setOption({
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        top: '5%',
                                        left: 'center'
                                    },
                                    series: [{
                                        name: 'Gender Wise Students',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: '18',
                                                fontWeight: 'bold'
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: [{
                                                value: {{ $data['total_boys'] }},
                                                name: 'Boys'
                                            },

                                            {
                                                value: {{ $data['total_girls'] }},
                                                name: 'Girls'
                                            }
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div><!-- End Gender Waise Students -->

                {{-- <!-- Recent Activity -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Recent Activity <span>| Today</span></h5>

                        <div class="activity">

                            <div class="activity-item d-flex">
                                <div class="activite-label">32 min</div>
                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                <div class="activity-content">
                                    Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a>
                                    beatae
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">56 min</div>
                                <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                <div class="activity-content">
                                    Voluptatem blanditiis blanditiis eveniet
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">2 hrs</div>
                                <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                <div class="activity-content">
                                    Voluptates corrupti molestias voluptatem
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">1 day</div>
                                <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                                <div class="activity-content">
                                    Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati
                                        voluptatem</a> tempore
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">2 days</div>
                                <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                                <div class="activity-content">
                                    Est sit eum reiciendis exercitationem
                                </div>
                            </div><!-- End activity item-->

                            <div class="activity-item d-flex">
                                <div class="activite-label">4 weeks</div>
                                <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                                <div class="activity-content">
                                    Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                                </div>
                            </div><!-- End activity item-->

                        </div>

                    </div>
                </div><!-- End Recent Activity -->

                <!-- Budget Report -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Budget Report <span>| This Month</span></h5>

                        <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                                    legend: {
                                        data: ['Allocated Budget', 'Actual Spending']
                                    },
                                    radar: {
                                        // shape: 'circle',
                                        indicator: [{
                                                name: 'Sales',
                                                max: 6500
                                            },
                                            {
                                                name: 'Administration',
                                                max: 16000
                                            },
                                            {
                                                name: 'Information Technology',
                                                max: 30000
                                            },
                                            {
                                                name: 'Customer Support',
                                                max: 38000
                                            },
                                            {
                                                name: 'Development',
                                                max: 52000
                                            },
                                            {
                                                name: 'Marketing',
                                                max: 25000
                                            }
                                        ]
                                    },
                                    series: [{
                                        name: 'Budget vs spending',
                                        type: 'radar',
                                        data: [{
                                                value: [4200, 3000, 20000, 35000, 50000, 18000],
                                                name: 'Allocated Budget'
                                            },
                                            {
                                                value: [5000, 14000, 28000, 26000, 42000, 21000],
                                                name: 'Actual Spending'
                                            }
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div><!-- End Budget Report -->--}}

                

            </div><!-- End Right side columns -->

        </div>
    </section>
@endsection
