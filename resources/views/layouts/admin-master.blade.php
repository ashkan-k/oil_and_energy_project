<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="/{{ $settings['LOGO']['value'] }}">
    <title>@yield('title')</title>
    <!-- chartist CSS -->
    <link href="/admin/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="/admin/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="/admin/dist/css/style.css" rel="stylesheet">
    <!-- This page CSS -->
    <link href="/admin/dist/css/pages/dashboard1.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="/admin/src/css/jquery.toast.min.css"/>
    <link rel="stylesheet" href="/admin/src/css/kamadatepicker.min.css"/>
    <link rel="stylesheet" href="/admin/src/select2/select2.min.css"/>
    <link rel="stylesheet" href="/admin/src/css/sweetalert2.min.css"/>
    <link href="/admin/assets/libs/footable/css/footable.core.css" rel="stylesheet">
    <link href="/admin/dist/css/pages/footable-page.css" rel="stylesheet">
    <link href="/admin/assets/extra-libs/prism/prism.css" rel="stylesheet">

    @yield('Styles')

</head>

<body class="rtl" ng-app="myApp" ng-controller="myCtrl">
<div class="main-wrapper" id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">WIKINAFT</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <header class="topbar">
        <!-- ============================================================== -->
        <!-- Navbar scss in header.scss -->
        <!-- ============================================================== -->
        <nav>
            <div class="nav-wrapper">
                <!-- ============================================================== -->
                <!-- Logo you can find that scss in header.scss -->
                <!-- ============================================================== -->
                <a href="/" class="brand-logo">
                        <span class="icon">
                            <img width="50" class="light-logo" src="/{{ $settings['LOGO']['value'] }}">
                            <img width="50" class="dark-logo" src="/{{ $settings['LOGO']['value'] }}">
                        </span>
                    <span class="text">
                            <img class="light-logo" src="/admin/assets/images/logo-light-text.png">
                            <img class="dark-logo" src="/admin/assets/images/logo-text.png">
                        </span>
                </a>
                <!-- ============================================================== -->
                <!-- Logo you can find that scss in header.scss -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Left topbar icon scss in header.scss -->
                <!-- ============================================================== -->
                <ul class="left">
                    <li class="hide-on-med-and-down">
                        <a href="javascript: void(0);" class="nav-toggle">
                            <span class="bars bar1"></span>
                            <span class="bars bar2"></span>
                            <span class="bars bar3"></span>
                        </a>
                    </li>
                    <li class="hide-on-large-only">
                        <a href="javascript: void(0);" class="sidebar-toggle">
                            <span class="bars bar1"></span>
                            <span class="bars bar2"></span>
                            <span class="bars bar3"></span>
                        </a>
                    </li>
                    <!-- ============================================================== -->
                    <!-- Notification icon scss in header.scss -->
                    <!-- ============================================================== -->
{{--                    <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="noti_dropdown"><i--}}
{{--                                class="material-icons">notifications</i></a>--}}
{{--                        <ul id="noti_dropdown" class="mailbox dropdown-content">--}}
{{--                            <li>--}}
{{--                                <div class="drop-title">Notifications</div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="message-center">--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a href="#">--}}
{{--                                            <span class="btn-floating btn-large red"><i--}}
{{--                                                    class="material-icons">link</i></span>--}}
{{--                                        <span class="mail-contnet">--}}
{{--                                                <h5>Launch Admin</h5>--}}
{{--                                                <span class="mail-desc">Just see the my new admin!</span> <span--}}
{{--                                                class="time">9:30 AM</span>--}}
{{--                                            </span>--}}
{{--                                    </a>--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a href="#">--}}
{{--                                            <span class="btn-floating btn-large blue"><i--}}
{{--                                                    class="material-icons">date_range</i></span>--}}
{{--                                        <span class="mail-contnet">--}}
{{--                                                <h5>Event today</h5>--}}
{{--                                                <span class="mail-desc">Just a reminder that you have event</span>--}}
{{--                                                <span class="time">9:10 AM</span>--}}
{{--                                            </span>--}}
{{--                                    </a>--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a href="#">--}}
{{--                                            <span class="btn-floating btn-large cyan"><i--}}
{{--                                                    class="material-icons">settings</i></span>--}}
{{--                                        <span class="mail-contnet">--}}
{{--                                                <h5>Settings</h5>--}}
{{--                                                <span class="mail-desc">You can customize this template as you--}}
{{--                                                    want</span>--}}
{{--                                                <span class="time">9:08 AM</span>--}}
{{--                                            </span>--}}
{{--                                    </a>--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a href="#">--}}
{{--                                            <span class="btn-floating btn-large green"><i--}}
{{--                                                    class="material-icons">face</i></span>--}}
{{--                                        <span class="mail-contnet">--}}
{{--                                                <h5>Lily Jordan</h5>--}}
{{--                                                <span class="mail-desc">Just see the my admin!</span>--}}
{{--                                                <span class="time">9:02 AM</span>--}}
{{--                                            </span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a class="center-align" href="javascript:void(0);"> <strong>Check all--}}
{{--                                        notifications</strong> </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                    <!-- ============================================================== -->
                    <!-- Comment topbar icon scss in header.scss -->
                    <!-- ============================================================== -->
{{--                    <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="msg_dropdown"><i--}}
{{--                                class="material-icons">comment</i></a>--}}
{{--                        <ul id="msg_dropdown" class="mailbox dropdown-content">--}}
{{--                            <li>--}}
{{--                                <div class="drop-title">You have 4 new messages</div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <div class="message-center">--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a href="#">--}}
{{--                                            <span class="user-img">--}}
{{--                                                <img src="/admin/assets/images/users/1.jpg" alt="user"--}}
{{--                                                     class="circle">--}}
{{--                                                <span class="profile-status online pull-right"></span>--}}
{{--                                            </span>--}}
{{--                                        <span class="mail-contnet">--}}
{{--                                                <h5>Chris Evans</h5>--}}
{{--                                                <span class="mail-desc">Just see the my admin!</span>--}}
{{--                                                <span class="time">9:30 AM</span>--}}
{{--                                            </span>--}}
{{--                                    </a>--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a href="#">--}}
{{--                                            <span class="user-img">--}}
{{--                                                <img src="/admin/assets/images/users/2.jpg" alt="user"--}}
{{--                                                     class="circle">--}}
{{--                                                <span class="profile-status busy pull-right"></span>--}}
{{--                                            </span>--}}
{{--                                        <span class="mail-contnet">--}}
{{--                                                <h5>Ray Hudson</h5>--}}
{{--                                                <span class="mail-desc">I've sung a song! See you at</span>--}}
{{--                                                <span class="time">9:10 AM</span>--}}
{{--                                            </span>--}}
{{--                                    </a>--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a href="#">--}}
{{--                                            <span class="user-img">--}}
{{--                                                <img src="/admin/assets/images/users/3.jpg" alt="user"--}}
{{--                                                     class="circle">--}}
{{--                                                <span class="profile-status away pull-right"></span>--}}
{{--                                            </span>--}}
{{--                                        <span class="mail-contnet">--}}
{{--                                                <h5>Lb James</h5>--}}
{{--                                                <span class="mail-desc">I am a singer!</span>--}}
{{--                                                <span class="time">9:08 AM</span>--}}
{{--                                            </span>--}}
{{--                                    </a>--}}
{{--                                    <!-- Message -->--}}
{{--                                    <a href="#">--}}
{{--                                            <span class="user-img">--}}
{{--                                                <img src="/admin/assets/images/users/4.jpg" alt="user"--}}
{{--                                                     class="circle">--}}
{{--                                                <span class="profile-status offline pull-right"></span>--}}
{{--                                            </span>--}}
{{--                                        <span class="mail-contnet">--}}
{{--                                                <h5>Don Andres</h5>--}}
{{--                                                <span class="mail-desc">Just see the my admin!</span>--}}
{{--                                                <span class="time">9:02 AM</span>--}}
{{--                                            </span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a class="center-align" href="javascript:void(0);"> <strong>See all--}}
{{--                                        e-Mails</strong> </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="search-box">--}}
{{--                        <a href="javascript: void(0);"><i class="material-icons">search</i></a>--}}
{{--                        <form class="app-search">--}}
{{--                            <input type="text" class="form-control" placeholder="Search &amp; enter"> <a--}}
{{--                                class="srh-btn"><i class="ti-close"></i></a>--}}
{{--                        </form>--}}
{{--                    </li>--}}
                </ul>
                <!-- ============================================================== -->
                <!-- Left topbar icon scss in header.scss -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right topbar icon scss in header.scss -->
                <!-- ============================================================== -->
                <ul class="right">
                    <!-- ============================================================== -->
                    <!-- Profile icon scss in header.scss -->
                    <!-- ============================================================== -->
                    <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="user_dropdown"><img
                                src="{{ auth()->user()->get_avatar() }}" alt="user" class="circle profile-pic"></a>
                        <ul id="user_dropdown" class="mailbox dropdown-content dropdown-user">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="{{ auth()->user()->get_avatar() }}"
                                                            alt="user"></div>
                                    <div class="u-text">
                                        <h4>{{ auth()->user()->full_name() }}</h4>
                                        <p>{{ auth()->user()->phone }}</p>
                                        <a type="button" onclick="$('#frm_logout').submit()"
                                           class="waves-effect waves-light btn-small red white-text">خروج</a>
                                    </div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li role="separator" class="divider"></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('profile') }}" type="button" onclick="$('#frm_logout').submit()"><i
                                        class="material-icons">account_circle</i>
                                    ویرایش پروفایل</a></li>
                            <form id="frm_logout" style="display: none" action="{{ route('logout') }}" method="post">
                                @csrf
                            </form>
                            @if(auth()->user()->is_superuser)
                                <li><a href="{{ route('settings.index') }}"><i class="material-icons">settings</i>
                                        تنظیمات</a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
                <!-- ============================================================== -->
                <!-- Right topbar icon scss in header.scss -->
                <!-- ============================================================== -->
            </div>
        </nav>
        <!-- ============================================================== -->
        <!-- Navbar scss in header.scss -->
        <!-- ============================================================== -->
    </header>
    <!-- ============================================================== -->
    <!-- Sidebar scss in sidebar.scss -->
    <!-- ============================================================== -->
@include('Admin.Section.sidebar')
<!-- ============================================================== -->
    <!-- Sidebar scss in sidebar.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Title and breadcrumb -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Container fluid scss in scafholding.scss -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            @yield('content')
        </div>
        <!-- ============================================================== -->
        <!-- Container fluid scss in scafholding.scss -->
        <!-- ============================================================== -->
        <footer class="center-align m-b-30">
            {!! $settings['COPY_RIGHT']['value'] !!}
        </footer>
    </div>
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
{{--    <a href="#" data-target="right-slide-out"--}}
{{--       class="sidenav-trigger right-side-toggle btn-floating btn-large waves-effect waves-light red"><i--}}
{{--            class="material-icons">settings</i></a>--}}
    <aside class="right-sidebar">
        <!-- Right Sidebar -->
        <ul id="right-slide-out" class="sidenav right-sidenav p-t-10">
            <li>
                <div class="row">
                    <div class="col s12">
                        <!-- Tabs -->
                        <ul class="tabs">
                            <li class="tab col s4"><a href="#settings" class="active"><span
                                        class="material-icons">build</span></a></li>
                            <li class="tab col s4"><a href="#chat"><span
                                        class="material-icons">chat_bubble</span></a></li>
                            <li class="tab col s4"><a href="#activity"><span
                                        class="material-icons">local_activity</span></a></li>
                        </ul>
                        <!-- Tabs -->
                    </div>
                    <!-- Setting -->
                    <div id="settings" class="col s12">
                        <div class="m-t-10 p-10 b-b">
                            <h6 class="font-medium">Layout Settings</h6>
                            <ul class="m-t-15">
                                <li class="m-b-10">
                                    <label>
                                        <input type="checkbox" name="theme-view" id="theme-view"/>
                                        <span>Dark Theme</span>
                                    </label>
                                </li>
                                <li class="m-b-10">
                                    <label>
                                        <input type="checkbox" class="nav-toggle" name="collapssidebar"
                                               id="collapssidebar"/>
                                        <span>Collapse Sidebar</span>
                                    </label>
                                </li>
                                <li class="m-b-10">
                                    <label>
                                        <input type="checkbox" name="sidebar-position" id="sidebar-position"/>
                                        <span>Fixed Sidebar</span>
                                    </label>
                                </li>
                                <li class="m-b-10">
                                    <label>
                                        <input type="checkbox" name="header-position" id="header-position"/>
                                        <span>Fixed Header</span>
                                    </label>
                                </li>
                                <li class="m-b-10">
                                    <label>
                                        <input type="checkbox" name="boxed-layout" id="boxed-layout"/>
                                        <span>Boxed Layout</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="p-10 b-b">
                            <!-- Logo BG -->
                            <h6 class="font-medium">Logo Backgrounds</h6>
                            <ul class="m-t-15 theme-color">
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-logobg="skin1"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-logobg="skin2"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-logobg="skin3"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-logobg="skin4"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-logobg="skin5"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-logobg="skin6"></a></li>
                            </ul>
                            <!-- Logo BG -->
                        </div>
                        <div class="p-10 b-b">
                            <!-- Navbar BG -->
                            <h6 class="font-medium">Navbar Backgrounds</h6>
                            <ul class="m-t-15 theme-color">
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-navbarbg="skin1"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-navbarbg="skin2"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-navbarbg="skin3"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-navbarbg="skin4"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-navbarbg="skin5"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-navbarbg="skin6"></a></li>
                            </ul>
                            <!-- Navbar BG -->
                        </div>
                        <div class="p-10 b-b">
                            <!-- Logo BG -->
                            <h6 class="font-medium">Sidebar Backgrounds</h6>
                            <ul class="m-t-15 theme-color">
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-sidebarbg="skin1"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-sidebarbg="skin2"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-sidebarbg="skin3"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-sidebarbg="skin4"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-sidebarbg="skin5"></a></li>
                                <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                                          data-sidebarbg="skin6"></a></li>
                            </ul>
                            <!-- Logo BG -->
                        </div>
                    </div>
                    <!-- chat -->
                    <div id="chat" class="col s12">
                        <ul class="mailbox m-t-20">
                            <li>
                                <div class="message-center">
                                    <!-- Message -->
                                    <a href="#" class="user-info" id='chat_user_1' data-user-id='1'>
                                            <span class="user-img">
                                                <img src="/admin/assets/images/users/1.jpg" alt="user"
                                                     class="circle">
                                                <span class="profile-status online pull-right"
                                                      data-status="online"></span>
                                            </span>
                                        <span class="mail-contnet">
                                                <h5>Chris Evans</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:30 AM</span>
                                            </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="#" class="user-info" id='chat_user_2' data-user-id='2'>
                                            <span class="user-img">
                                                <img src="/admin/assets/images/users/2.jpg" alt="user"
                                                     class="circle">
                                                <span class="profile-status busy pull-right" data-status="busy"></span>
                                            </span>
                                        <span class="mail-contnet">
                                                <h5>Ray Hudson</h5>
                                                <span class="mail-desc">I've sung a song! See you at</span>
                                                <span class="time">9:10 AM</span>
                                            </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="#" class="user-info" id='chat_user_3' data-user-id='3'>
                                            <span class="user-img">
                                                <img src="/admin/assets/images/users/3.jpg" alt="user"
                                                     class="circle">
                                                <span class="profile-status away pull-right" data-status="away"></span>
                                            </span>
                                        <span class="mail-contnet">
                                                <h5>Lb James</h5>
                                                <span class="mail-desc">I am a singer!</span>
                                                <span class="time">9:08 AM</span>
                                            </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="#" class="user-info" id='chat_user_4' data-user-id='4'>
                                            <span class="user-img">
                                                <img src="/admin/assets/images/users/4.jpg" alt="user"
                                                     class="circle">
                                                <span class="profile-status offline pull-right"
                                                      data-status="offline"></span>
                                            </span>
                                        <span class="mail-contnet">
                                                <h5>Don Andres</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:02 AM</span>
                                            </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="#" class="user-info" id='chat_user_5' data-user-id='5'>
                                            <span class="user-img">
                                                <img src="/admin/assets/images/users/1.jpg" alt="user"
                                                     class="circle">
                                                <span class="profile-status online pull-right"
                                                      data-status="online"></span>
                                            </span>
                                        <span class="mail-contnet">
                                                <h5>Chris Evans</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:30 AM</span>
                                            </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="#" class="user-info" id='chat_user_6' data-user-id='6'>
                                            <span class="user-img">
                                                <img src="/admin/assets/images/users/2.jpg" alt="user"
                                                     class="circle">
                                                <span class="profile-status busy pull-right" data-status="busy"></span>
                                            </span>
                                        <span class="mail-contnet">
                                                <h5>Ray Hudson</h5>
                                                <span class="mail-desc">I've sung a song! See you at</span>
                                                <span class="time">9:10 AM</span>
                                            </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="#" class="user-info" id='chat_user_7' data-user-id='7'>
                                            <span class="user-img">
                                                <img src="/admin/assets/images/users/3.jpg" alt="user"
                                                     class="circle">
                                                <span class="profile-status away pull-right" data-status="away"></span>
                                            </span>
                                        <span class="mail-contnet">
                                                <h5>Lb James</h5>
                                                <span class="mail-desc">I am a singer!</span>
                                                <span class="time">9:08 AM</span>
                                            </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="#" class="user-info" id='chat_user_8' data-user-id='8'>
                                            <span class="user-img">
                                                <img src="/admin/assets/images/users/4.jpg" alt="user"
                                                     class="circle">
                                                <span class="profile-status offline pull-right"
                                                      data-status="offline"></span>
                                            </span>
                                        <span class="mail-contnet">
                                                <h5>Don Andres</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:02 AM</span>
                                            </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="#" class="user-info" id='chat_user_9' data-user-id='9'>
                                            <span class="user-img">
                                                <img src="/admin/assets/images/users/1.jpg" alt="user"
                                                     class="circle">
                                                <span class="profile-status online pull-right"
                                                      data-status="online"></span>
                                            </span>
                                        <span class="mail-contnet">
                                                <h5>Chris Evans</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:30 AM</span>
                                            </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="#" class="user-info" id='chat_user_10' data-user-id='10'>
                                            <span class="user-img">
                                                <img src="/admin/assets/images/users/2.jpg" alt="user"
                                                     class="circle">
                                                <span class="profile-status busy pull-right" data-status="busy"></span>
                                            </span>
                                        <span class="mail-contnet">
                                                <h5>Ray Hudson</h5>
                                                <span class="mail-desc">I've sung a song! See you at</span>
                                                <span class="time">9:10 AM</span>
                                            </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="#" class="user-info" id='chat_user_11' data-user-id='11'>
                                            <span class="user-img">
                                                <img src="/admin/assets/images/users/3.jpg" alt="user"
                                                     class="circle">
                                                <span class="profile-status away pull-right" data-status="away"></span>
                                            </span>
                                        <span class="mail-contnet">
                                                <h5>Lb James</h5>
                                                <span class="mail-desc">I am a singer!</span>
                                                <span class="time">9:08 AM</span>
                                            </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="#" class="user-info" id='chat_user_12' data-user-id='12'>
                                            <span class="user-img">
                                                <img src="/admin/assets/images/users/4.jpg" alt="user"
                                                     class="circle">
                                                <span class="profile-status offline pull-right"
                                                      data-status="offline"></span>
                                            </span>
                                        <span class="mail-contnet">
                                                <h5>Don Andres</h5>
                                                <span class="mail-desc">Just see the my admin!</span>
                                                <span class="time">9:02 AM</span>
                                            </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Activity -->
                    <div id="activity" class="col s12">
                        <div class="m-t-10 p-10">
                            <h6 class="font-medium">Activity Timeline</h6>
                            <div class="steamline">
                                <div class="sl-item">
                                    <div class="sl-left green"><i class="ti-user"></i></div>
                                    <div class="sl-right">
                                        <div class="font-medium">Meeting today <span class="sl-date">
                                                    5pm</span></div>
                                        <div class="desc">you can write anything</div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-left blue"><i class="fa fa-image"></i></div>
                                    <div class="sl-right">
                                        <div class="font-medium">Send documents to Clark</div>
                                        <div class="desc">Lorem Ipsum is simply</div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-left"><img class="circle" alt="user"
                                                              src="/admin/assets/images/users/2.jpg"></div>
                                    <div class="sl-right">
                                        <div class="font-medium">Go to the Doctor <span
                                                class="sl-date">5 minutes ago</span></div>
                                        <div class="desc">Contrary to popular belief</div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-left"><img class="circle" alt="user"
                                                              src="/admin/assets/images/users/1.jpg"></div>
                                    <div class="sl-right">
                                        <div><a href="javascript:void(0)">Stephen</a> <span
                                                class="sl-date">5 minutes ago</span></div>
                                        <div class="desc">Approve meeting with tiger</div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-left teal"><i class="ti-user"></i></div>
                                    <div class="sl-right">
                                        <div class="font-medium">Meeting today <span class="sl-date">
                                                    5pm</span></div>
                                        <div class="desc">you can write anything</div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-left purple"><i class="fa fa-image"></i></div>
                                    <div class="sl-right">
                                        <div class="font-medium">Send documents to Clark</div>
                                        <div class="desc">Lorem Ipsum is simply</div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-left"><img class="circle" alt="user"
                                                              src="/admin/assets/images/users/4.jpg"></div>
                                    <div class="sl-right">
                                        <div class="font-medium">Go to the Doctor <span
                                                class="sl-date">5 minutes ago</span></div>
                                        <div class="desc">Contrary to popular belief</div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-left"><img class="circle" alt="user"
                                                              src="/admin/assets/images/users/6.jpg"></div>
                                    <div class="sl-right">
                                        <div><a href="javascript:void(0)">Stephen</a> <span
                                                class="sl-date">5 minutes ago</span></div>
                                        <div class="desc">Approve meeting with tiger</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </aside>
    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->
<script src="/admin/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="/admin/dist/js/materialize.min.js"></script>
<script src="/admin/assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
<!-- ============================================================== -->
<!-- Apps -->
<!-- ============================================================== -->
<script src="/admin/dist/js/app.js"></script>
<script src="/admin/dist/js/app.init.js"></script>
<script src="/admin/dist/js/app-style-switcher.js"></script>
<!-- ============================================================== -->
<!-- Custom js -->
<!-- ============================================================== -->
<script src="/admin/dist/js/custom.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugin js -->
<!-- ============================================================== -->
<script src="/admin/assets/libs/chartist/dist/chartist.min.js"></script>
<script src="/admin/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="/admin/assets/extra-libs/sparkline/sparkline.js"></script>
{{-- <script src="/admin/dist/js/pages/dashboards/dashboard1.js"></script> --}}

<script src="/admin/src/js/app.js"></script>
<script src="/admin/src/js/angular.min.js"></script>
<script src="/admin/src/js/jquery.toast.min.js"></script>
<script src="/admin/src/js/sweetalert2.min.js"></script>
<script src="/admin/src/js/kamadatepicker.min.js"></script>
<script src="/admin/src/select2/select2.min.js"></script>
<script src="/admin/src/ckeditor/ckeditor.js"></script>
<script src="/admin/assets/libs/footable/dist/footable.all.min.js"></script>
<script src="/admin/dist/js/pages/footable/footable-init.js"></script>
<script src="/admin/assets/extra-libs/prism/prism.js"></script>
<script src="/admin/src/js/pagination.js"></script>
<script src="/admin/src/js/jquery-ui.js"></script>

<script>
    var app = angular.module("myApp", []);
    app.config(function ($interpolateProvider, $httpProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');

        $httpProvider.defaults.xsrfCookieName = 'csrftoken';
        $httpProvider.defaults.xsrfHeaderName = 'X-CSRFToken';
    });
</script>

@yield('Scripts')

</body>

</html>
