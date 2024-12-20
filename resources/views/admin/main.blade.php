<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    @stack('title')
   
    <!-- Favicons -->
    <link href="{{ SiteSetting()->favicon }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
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
            <a href="{{ route("admin-dashboard") }}" class="logo d-flex d-none d-lg-block align-items-center">
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
                            <a class="dropdown-item d-flex align-items-center" href="{{ route("admin-profile") }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route("logout") }}">
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

            <li class="nav-item mb-3">
                <a href="{{ route("admin-dashboard") }}" class="logo d-flex d-block d-lg-none align-items-center">
                    <img src="{{ SiteSetting()->logo }}" class="img-fluid" alt="Logo">
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/dashboard') }}" href="{{ route('admin-dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/hostel') }}" data-bs-target="#components-nav" data-bs-toggle="collapse"
                    href="#">
                    <i class="bx bxs-building-house"></i><span>Hostels</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse {{ active_if_match('admin/hostel') }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin-list-hostel') }}" class="{{ active_if_full_match('admin/hostel/list-hostel') }}">
                            <i class="bi bi-circle"></i><span>All Hostels</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-create-hostel') }}" class="{{ active_if_full_match('admin/hostel/add-hostel') }}">
                            <i class="bi bi-circle"></i><span>Add Hostels</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-popular-hostel') }}" class="{{ active_if_full_match('admin/hostel/list-popular-hostel') }}">
                            <i class="bi bi-circle"></i><span>Popular Hostels</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-store-feature') }}" class="{{ active_if_full_match('admin/hostel/add-feature') }}">
                            <i class="bi bi-circle"></i><span>Hostel Features</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Hostels Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/city') }}" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="ri-map-pin-2-line"></i><span>City</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse {{ active_if_match('admin/city') }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin-list-city') }}" class="{{ active_if_full_match('admin/city/list-city') }}">
                            <i class="bi bi-circle"></i><span>All City</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-create-city') }}" class="{{ active_if_full_match('admin/city/add-city') }}">
                            <i class="bi bi-circle"></i><span>Add City</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End City Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/owner') }}" data-bs-target="#owner-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-circle"></i><span>Owners</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="owner-nav" class="nav-content collapse {{ active_if_match('admin/owner') }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin-list-owner') }}" class="{{ active_if_full_match('admin/owner/list-owner') }}">
                            <i class="bi bi-circle"></i><span>All Owners</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-store-owner') }}" class="{{ active_if_full_match('admin/owner/add-owner') }}">
                            <i class="bi bi-circle"></i><span>Add an Owner</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Owners Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/agent') }}" data-bs-target="#agent-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-circle"></i><span>Agents</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="agent-nav" class="nav-content collapse {{ active_if_match('admin/agent') }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin-list-agent') }}" class="{{ active_if_full_match('admin/agent/list-agent') }}">
                            <i class="bi bi-circle"></i><span>All Agent</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-store-agent') }}" class="{{ active_if_full_match('admin/agent/add-agent') }}">
                            <i class="bi bi-circle"></i><span>Add an Agent</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Agent Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/student') }}" data-bs-target="#student-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-circle"></i><span>Students</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="student-nav" class="nav-content collapse {{ active_if_match('admin/student') }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin-register-student') }}" class="{{ active_if_full_match('admin/student/list-student') }}">
                            <i class="bi bi-circle"></i><span>Registerd Students</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-pending-student') }}" class="{{ active_if_full_match('admin/student/list-student') }}">
                            <i class="bi bi-circle"></i><span>Pending Students</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-boarding-student') }}" class="{{ active_if_full_match('admin/student/list-student') }}">
                            <i class="bi bi-circle"></i><span>Boarding Students</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-create-student') }}" class="{{ active_if_full_match('admin/student/add-student') }}">
                            <i class="bi bi-circle"></i><span>Add Student</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Students Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/package') }}" data-bs-target="#packages-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-bar-chart"></i><span>Packages</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="packages-nav" class="nav-content collapse {{ active_if_match('admin/package') }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin-list-package') }}" class="{{ active_if_full_match('admin/package/list-package') }}">
                            <i class="bi bi-circle"></i><span>All Packages</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-create-package') }}" class="{{ active_if_full_match('admin/package/add-package') }}">
                            <i class="bi bi-circle"></i><span>Add Packages</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Packages Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/enquiry') }}" data-bs-target="#enquiry-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-card-list"></i><span>Enquiry</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="enquiry-nav" class="nav-content collapse {{ active_if_match('admin/enquiry') }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin-list-enquiry') }}" class="{{ active_if_full_match('admin/enquiry/list-enquiry') }}">
                            <i class="bi bi-circle"></i><span>All Enquiries</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-create-enquiry') }}" class="{{ active_if_full_match('admin/enquiry/add-enquiry') }}">
                            <i class="bi bi-circle"></i><span>Add Enquiry</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Enquiry Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/review') }}" data-bs-target="#review-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-star"></i><span>Review</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="review-nav" class="nav-content collapse {{ active_if_match('admin/review') }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin-list-review') }}" class="{{ active_if_full_match('admin/review/list-review') }}">
                            <i class="bi bi-circle"></i><span>All Reviews</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Review Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/slider') }}" data-bs-target="#slider-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-sliders"></i><span>Slider</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="slider-nav" class="nav-content collapse {{ active_if_match('admin/slider') }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin-list-slider') }}" class="{{ active_if_full_match('admin/slider/list-slider') }}">
                            <i class="bi bi-circle"></i><span>All Sliders</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-create-slider') }}" class="{{ active_if_full_match('admin/slider/add-slider') }}">
                            <i class="bi bi-circle"></i><span>Add Slider</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Sliders Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/banner') }}" data-bs-target="#banner-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-sliders"></i><span>Ads Banner</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="banner-nav" class="nav-content collapse {{ active_if_match('admin/banner') }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin-list-banner') }}" class="{{ active_if_full_match('admin/banner/list-banner') }}">
                            <i class="bi bi-circle"></i><span>All Banners</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-create-banner') }}" class="{{ active_if_full_match('admin/banner/add-banner') }}">
                            <i class="bi bi-circle"></i><span>Add Banner</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Banners Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/blog') }}" data-bs-target="#blog-nav" data-bs-toggle="collapse" href="#">
                    <i class="bx bxl-blogger"></i><span>Blog</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="blog-nav" class="nav-content collapse {{ active_if_match('admin/blog') }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin-list-blog') }}" class="{{ active_if_full_match('admin/blog/list-blog') }}">
                            <i class="bi bi-circle"></i><span>All Blogs</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-create-blog') }}" class="{{ active_if_full_match('admin/blog/add-blog') }}">
                            <i class="bi bi-circle"></i><span>Add Blog</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Blogs Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/pages') }}" data-bs-target="#pages" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-book"></i><span>Pages</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="pages" class="nav-content collapse {{ active_if_match('admin/pages') }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin-about-view') }}" class="{{ active_if_full_match('admin/pages/about') }}">
                            <i class="bi bi-circle"></i><span>About Us</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('terms-and-condition-view') }}" class="{{ active_if_full_match('admin/pages/terms-and-condition') }}">
                            <i class="bi bi-circle"></i><span>Terms and Condition</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('privacy-and-policy-view') }}" class="{{ active_if_full_match('admin/pages/privacy-and-policy') }}">
                            <i class="bi bi-circle"></i><span>Privacy and Policy</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('refund-policy-view') }}" class="{{ active_if_full_match('admin/pages/refund-policy') }}">
                            <i class="bi bi-circle"></i><span>Refund Policy</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Pages Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/setting') }}" data-bs-target="#setting" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gear"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="setting" class="nav-content collapse {{ active_if_match('admin/setting') }}" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('admin-site-setting') }}" class="{{ active_if_full_match('admin/setting/site-setting') }}">
                            <i class="bi bi-circle"></i>
                            <span>Site Setting</span>
                        </a>
                    </li>

                    {{-- <li>
                        <a href="{{ route('down') }}" onclick="return maintenancMode();" class="{{ active_if_full_match('admin/setting/down') }}">
                            <i class="bi bi-circle"></i>
                            <span>Maintenance Mode</span>
                        </a>
                    </li> --}}
                </ul>
            </li><!-- End Setting Nav -->

            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/profile') }}" href="{{ route('admin-profile') }}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link {{ remove_collapsed_if_match('admin/trash') }}" href="{{ route('trash') }}">
                    <i class="bi bi-trash"></i>
                    <span>Recycle Bin</span>
                </a>
            </li><!-- End Profile Page Nav -->


        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        @yield('main-section')
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; 2024 Copyright <strong><span><a href="https://www.eucoders.org/">Eucoders</a></span></strong>. All Rights Reserved
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

    <script>
        function maintenancMode(){
            return window.confirm("Are you sure to put the application into maintenance mode?");
        }
        
        function confirmDelete(){
            return window.confirm("Are you sure to Delete?");
        }
    </script>

    @yield('script-section')

</body>

</html>
