<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#0EABAF" />
    <meta name="description" content="xCRM - NxCloud" />

    <!-- Fontawesome -->
    <link rel="stylesheet" href="../assets/fontawesome/all.css" />

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">


    <link href="../assets/css/vender.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="../assets/css/colors.css" rel="stylesheet">
    <link href="../assets/css/components.css" rel="stylesheet">

    <link href="../assets/css/authentication.css" rel="stylesheet">

    <title>{{ env('APP_NAME') }}</title>
    @notifyCss
    @yield('style')
</head>

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static menu-collapsed blank-page"
    data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">

    @yield('header')
    @yield('sidebar')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        @yield('content')
    </div>
    <!-- END: Content-->

    <x-notify::notify />
    @notifyJs
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.5/perfect-scrollbar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.6/waves.min.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>

    <script src="../assets/js/tooltips.min.js"></script>
    <script src="../assets/js/main.js"></script>

    @yield('script')

</body>

</html>
