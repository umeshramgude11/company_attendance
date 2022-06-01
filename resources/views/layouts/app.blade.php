<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{!! str_replace('-', ' ', config('app.name')) !!}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" />


    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    @yield('third_party_stylesheets')

    @stack('page_css')
    <style>
        body {
            font-family: Source Sans Pro;

        }

        table td,
        th {
            font-size: 13px !important;
        }

    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center" style="">
            <img class="animation__shake" src="{{ asset('images/ish-logo.jpg') }}" alt="Attendance Project" height="60"
                width="60">
            <span id="base_url" style="display: none">{{ URL::to('/') }}</span>
        </div>
        <!-- Main Header -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('images/ish-logo.jpg') }}" class="user-image img-circle elevation-2"
                            alt="User Image">

                        <span class="d-none d-md-inline">{{ session('attendance_session.first_name') }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <div class="alert  alert-block">
                                @if (session('attendance_session.profile_photo'))
                                    <img src="{{ asset('images/UserProfile_photo') }}/{{ session('attendance_session.profile_photo') }}"
                                        class="img-circle elevation-2" alt="User Image">
                                @else
                                    <img src="{{ asset('images/UserProfile_photo/no_user.png') }}"
                                        class="img-circle elevation-2" style="height: 70px;" alt="User Image">
                                @endif
                            </div>
                            <p>
                                {{ session('attendance_session.first_name') }}
                                {{-- <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small> --}}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                            <a href="{{ url('logout') }}" class="btn btn-default btn-flat float-right">
                                Sign out
                            </a>

                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                @yield('content')
                {{-- {{ session('attendance_session.user_type') }} --}}
            </section>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 2.0
            </div>
            <strong>Copyright &copy; {{ date('Y') }} All rights
            reserved.
        </footer>
    </div>


    <script src="{{ mix('js/app.js') }}"></script>
    @stack('third_party_scripts')

    @stack('page_scripts')
    <script src="{{ asset('js/admin/categories.js') }}"></script>

    <script>

    </script>
</body>

</html>
