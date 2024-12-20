<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    @stack('title')
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ SiteSetting()->favicon }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url('/') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    {{-- <link href="{{ url('/') }}/assets/vendor/simple-datatables/style.css" rel="stylesheet"> --}}

    <!-- Buttons -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/buttons.dataTables.min.css">

    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/plugins/slick.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/plugins/cssanimation.min.css">
    <!-- IonRange slider CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/plugins/ion.rangeSlider.min.css">

    <!-- Template Main CSS File -->
    <link href="{{ url('/') }}/assets/css/style.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/css/custom.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/css/toast.css" rel="stylesheet">

    @stack('style')
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('owner-dashboard') }}" class="logo d-flex d-none d-lg-block align-items-center">
                <img src="{{ SiteSetting()->logo }}" alt="Logo">
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ getProfiePic() }}" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                            <span>{{ ucfirst(Auth::user()->role) }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('owner-profile') }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item mb-2">
                <a href="{{ route('owner-dashboard') }}" class="logo d-flex d-block d-lg-none align-items-center">
                    <img src="{{ SiteSetting()->logo }}" class="img-fluid" alt="Logo">
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('owner/dashboard') }}"
                    href="{{ route('owner-dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('owner/hostel') }}" data-bs-target="#components-nav"
                    data-bs-toggle="collapse" href="#">
                    <i class="bx bxs-building-house"></i><span>Hostels</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse {{ active_if_match('owner/hostel') }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('owner-list-hostel') }}"
                            class="{{ active_if_full_match('owner/hostel/list-hostel') }}">
                            <i class="bi bi-circle"></i><span>All Hostels</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('owner-create-hostel') }}"
                            class="{{ active_if_full_match('owner/hostel/add-hostel') }}">
                            <i class="bi bi-circle"></i><span>Add Hostels</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('owner-popular-hostel') }}"
                            class="{{ active_if_full_match('owner/hostel/list-popular-hostel') }}">
                            <i class="bi bi-circle"></i><span>Popular Hostels</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Hostels Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('owner/student') }}" data-bs-target="#student-nav"
                    data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-circle"></i><span>Students</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="student-nav" class="nav-content collapse {{ active_if_match('owner/student') }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('owner-list-student') }}"
                            class="{{ active_if_full_match('owner/student/list-student') }}">
                            <i class="bi bi-circle"></i><span>All Students</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('owner-create-student') }}"
                            class="{{ active_if_full_match('owner/student/add-student') }}">
                            <i class="bi bi-circle"></i><span>Add Student</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Students Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('owner/enquiry') }}" data-bs-target="#enquiry-nav"
                    data-bs-toggle="collapse" href="#">
                    <i class="bi bi-card-list"></i><span>Enquiry</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="enquiry-nav" class="nav-content collapse {{ active_if_match('owner/enquiry') }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('owner-list-enquiry') }}"
                            class="{{ active_if_full_match('owner/enquiry/list-enquiry') }}">
                            <i class="bi bi-circle"></i><span>All Enquiries</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Enquiry Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('owner/review') }}" data-bs-target="#review-nav"
                    data-bs-toggle="collapse" href="#">
                    <i class="bi bi-card-list"></i><span>Review</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="review-nav" class="nav-content collapse {{ active_if_match('owner/review') }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('owner-list-review') }}"
                            class="{{ active_if_full_match('owner/review/list-review') }}">
                            <i class="bi bi-circle"></i><span>All Reviews</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Review Nav -->

            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('owner/profile') }}"
                    href="{{ route('owner-profile') }}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('owner/document') }}"
                    href="{{ route('owner-edit-document') }}">
                    <i class="bi bi-file-pdf"></i>
                    <span>Documents</span>
                </a>
            </li><!-- End Documents Page Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('owner/fee') }}"
                    href="{{ route('owner-student-fee') }}">
                    <i class="bi bi-currency-dollar"></i>
                    <span>Fee</span>
                </a>
            </li><!-- End Documents Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        @yield('main-section')
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; 2024 Copyright <strong><span><a href="https://www.eucoders.org/">Eucoders</a></span></strong>. All
            Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://www.eucoders.org/">Eucoders</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ url('/') }}/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="{{ url('/') }}/assets/vendor/echarts/echarts.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/quill/quill.min.js"></script>
    {{-- <script src="{{ url('/') }}/assets/vendor/simple-datatables/simple-datatables.js"></script> --}}
    <script src="{{ url('/') }}/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/php-email-form/validate.js"></script>

    <!-- Modernizer JS -->
    <script src="{{ url('/') }}/assets/js/modernizr-2.8.3.min.js"></script>
    <!-- jQuery JS -->
    <script src="{{ url('/') }}/assets/js/jquery.min.js"></script>
    <!-- IonRanger JS -->
    <script src="{{ url('/') }}/assets/js/plugins/ion.rangeSlider.min.js"></script>
    <!-- SVG inject JS -->
    <script src="{{ url('/') }}/assets/js/plugins/svg-inject.min.js"></script>
    <!-- Slick slider JS -->
    <script src="{{ url('/') }}/assets/js/plugins/slick.min.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ url('/') }}/assets/js/main.js"></script>
    <script src="{{ url('/') }}/assets/js/toast.js"></script>

    <!-- Export -->
    <script src="{{ url('/') }}/assets/js/dataTables.js"></script>
    <script src="{{ url('/') }}/assets/js/dataTables.buttons.js"></script>
    <script src="{{ url('/') }}/assets/js/buttons.dataTables.js"></script>
    <script src="{{ url('/') }}/assets/js/jszip.min.js"></script>
    <script src="{{ url('/') }}/assets/js/pdfmake.min.js"></script>
    <script src="{{ url('/') }}/assets/js/vfs_fonts.js"></script>
    <script src="{{ url('/') }}/assets/js/buttons.html5.js"></script>
    <script src="{{ url('/') }}/assets/js/buttons.print.min.js"></script>
    <script src="{{ url('/') }}/assets/js/dataTables.dataTables.min.js"></script>
    <!-- Export End -->

    <script>
        new DataTable('.datatable', {
            layout: {
                topStart: {
                    buttons: ['pdf', 'print'] // 'copy', 'csv', 'excel',
                }
            }
        });

        function confirmDelete() {
            return window.confirm("Are you sure to Delete?");
        }
    </script>


    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                triggerAlert('{{ $error }}', 'error')
            </script>
        @endforeach
    @endif

    @if (session('success'))
        <script>
            triggerAlert("{{ session('success') }}", 'success')
        </script>
    @endif

    @if (session('error'))
        <script>
            triggerAlert("{{ session('error') }}", 'error')
        </script>
    @endif

    @yield('script-section')
</body>

</html>
