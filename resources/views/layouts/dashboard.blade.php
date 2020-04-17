<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard</title>
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/simple-line-icons.css')}}">
    <link href="{{ asset('plugins/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/global.css')}}" rel="stylesheet">
    @yield('styles')

</head>

<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        </svg>
    </div>
</div>
<!--*******************
    Preloader end
********************-->


<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <div class="brand-logo">
            <a href="{{route('adminIndex')}}">
                <h3 class="text-white">Dashboard</h3>
                {{--                <b class="logo-abbr"><img src="images/logo.png" alt=""> </b>--}}
                {{--                <span class="logo-compact"><img src="./images/logo-compact.png" alt=""></span>--}}
                <span class="brand-title">
{{--                        <img src="images/logo-text.png" alt="">--}}
                    </span>
            </a>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content clearfix">

            <div class="nav-control">
                <div class="hamburger">
                    <span class="toggle-icon"><i class="icon-menu"></i></span>
                </div>
            </div>
            <div class="header-left">
                <div class="input-group icons">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                    </div>
                    <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard">
                    <div class="drop-down animated flipInX d-md-none">
                        <form action="#">
                            <input type="text" class="form-control" placeholder="Search">
                        </form>
                    </div>
                </div>
            </div>
            <div class="header-right">
                <ul class="clearfix">
                    <li class="icons dropdown">
                        <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                            {{--                            <span class="activity active"></span>--}}
                            <i class="icon-user text-dark"></i>
                            {{--                            <img src="images/user/1.png" height="40" width="40" alt="">--}}
                        </div>
                        <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li>
                                        <a href="#"><i class="icon-user"></i> <span>Profile</span></a>
                                    </li>
                                    <li><a href="#"><i class="icon-key"></i> <span>Logout</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="nk-sidebar">
        <div class="nk-nav-scroll">
            <ul class="metismenu" id="menu">
                <li class="mega-menu mega-menu-sm">
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-calender"></i><span class="nav-text">Planning</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="#">List</a></li>
{{--                        <li><a href="#">One Column</a></li>--}}
{{--                        <li><a href="#">Two column</a></li>--}}
                    </ul>
                </li>
                <li class="nav-label">Apps</li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-envelope menu-icon"></i> <span class="nav-text">Email</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="#">Inbox</a></li>
                        <li><a href="#">Read</a></li>
                        <li><a href="#">Compose</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="icon-screen-tablet menu-icon"></i><span class="nav-text">Apps</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Calender</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->

    <!--**********************************
        Content body start
    ***********************************-->
    <div class="content-body">

        <div class="container-fluid mt-3">
            @yield('content')

        </div>
        <!-- #/ container -->
    </div>
    <!--**********************************
        Content body end
    ***********************************-->


    <!--**********************************
        Footer start
    ***********************************-->

    <!--**********************************
        Footer end
    ***********************************-->
</div>
<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->

<script src="{{asset('js/common.min.js')}}"></script>
<script src="{{asset('js/custom.min.js')}}"></script>
<script src="{{asset('js/settings.js')}}"></script>
<script src="{{asset('js/gleek.js')}}"></script>
<script src="{{asset('js/chartist.min.js')}}"></script>
<!-- Circle progress -->
<script src="{{asset('js/circle-progress.min.js')}}"></script>
<script src="{{asset('js/metisMenu.min.js')}}"></script>
{{--<script src="{{asset('js/moment.min.js')}}"></script>--}}
@yield('js-script')
</body>

</html>
