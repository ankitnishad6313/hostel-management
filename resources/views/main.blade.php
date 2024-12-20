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
    <link href="{{ url('/') }}/assets/vendor/simple-datatables/style.css" rel="stylesheet">

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
    <style>
        .logo {
            line-height: 1;
        }

        @media (min-width: 1200px) {
            .logo {
                width: 280px;
            }
        }
        
        .logo img {
            max-height: 50px;
            margin-right: 6px;
            mix-blend-mode: color-burn !important;
        }

        /* .logo span {
            font-size: 26px;
            font-weight: 700;
            color: #012970;
            font-family: "Nunito", sans-serif;
        }

        .card {
            background-color: transparent !important;
            color: white;
        }

        .logo span {
            color: white !important;
        }

        .card h5 {
            color: white !important;
        }

        ::placeholder {
            color: rgb(8, 166, 240) !important;
        }

        .form-bg input, select,textarea {
            background-color: transparent !important;
            color: white !important;
        }

        select option{
            background-color: rgb(57, 57, 235) !important;
            color: white !important;
        } */
        
    </style>
</head>

<body class="form-bg-body">
    <main>
        @yield('main-section')
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ url('/') }}/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="{{ url('/') }}/assets/vendor/echarts/echarts.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/quill/quill.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/simple-datatables/simple-datatables.js"></script>
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

    @stack('script')
    @yield('script-section')
    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
            var passwordInput = document.getElementById('password');
            var icon = this.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            }
        });
        </script>
</body>

</html>
