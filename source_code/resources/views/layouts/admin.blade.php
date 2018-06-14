<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Jobee - Admin Page</title>


    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/vendors/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('assets/vendors/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{asset('assets/dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    {{-- Custom style --}}
    <link href="{{asset('assets/vendors/bootstrap/css/admin-custom.css')}}" rel="stylesheet">

    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }} ">
    @yield('styles')
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="modal-ajax-loading">
        <img class="modal-ajax-loading-content" src="{{ asset('assets/img/ajax-loader.gif') }}">
    </div>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header" style="margin-left:3%">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{ route('admin.home') }}"><img src="{{ asset('assets/img/logo2.png') }}" alt="Jobee" style="max-width: 200px; max-height: 50px;"></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Hồ sơ</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Cài đặt</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Đăng xuất</a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Tìm...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="{{ route('admin.home') }}"><i class="fa fa-dashboard fa-fw"></i> Bảng điều khiển</a>
                    </li>
                    @can('recruitments.view', Auth::user())
                    <li>
                        <a href="#"><i class="fa fa-newspaper-o fa-fw"></i> Tin tuyển dụng<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('admin.recruitments.index') }}">Danh sách tin tuyển dụng</a>
                            </li>
                            @can('recruitments.update', Auth::user())
                            <li>
                                <a href="{{route('admin.recruitments.approve')}}">Tin tuyển dụng chờ xác nhận</a>
                            </li> 
                            @endcan                  
                        </ul>
                    </li>
                    @endcan
                    @can('companies.view', Auth::user())
                    <li>
                        <a href="#"><i class="fa fa-building fa-fw"></i> Công ty<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{ route('company') }}">Danh sách công ty</a>
                            </li>
                            @can('companies.update', Auth::user())
                            <li>
                                <a href="{{route('company.registration')}}">Công ty đang chờ xác nhận</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    
                    @can('accounts.view', Auth::user())
                    <li>
                        <a href="#"><i class="fa fa-users fa-fw"></i> Danh sách tài khoản<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="list-account-company.html">Công ty</a>
                            </li>
                            <li>
                                <a href="list-account-candidate.html">Ứng viên</a>
                            </li>
                            <li>
                                <a href="{{ route('staffs.index') }}">Nhân viên</a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    @can('faculties.view', Auth::user())
                    <li>
                        <a href="#"><i class="fa fa-archive fa-fw"></i> Ngành nghề<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ route('faculties.index') }}">Danh sách ngành nghề</a></li>
                            @can('faculties.create', Auth::user())
                            <li><a href="{{route('faculties.create')}}">Thêm ngành nghề</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('blogs.view', Auth::user())
                    <li>
                        <a href="#"><i class="fa fa-pencil-square-o fa-fw"></i> Blog<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ route('blogs.index') }}">Danh sách Blog</a></li>
                            @can('blogs.create', Auth::user())
                            <li><a href="{{route('blogs.create')}}">Đăng Blog</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('admin', Auth::user())
                    <li>
                        <a href="{{ route('admin.background') }}"><i class="fa fa-wrench" aria-hidden="true"></i> Cài đặt ảnh bìa</a>
                    </li>
                    @endcan
                </ul>
            </div>
            <!-- /.navbar-static-side -->
        </div>
    </nav>

    <!-- Page Content -->
    @yield('body')
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="{{asset('assets/vendors/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->

<script
src="https://code.jquery.com/jquery-2.2.4.min.js"
integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
crossorigin="anonymous"></script>
<script src="{{asset('assets/vendors/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="{{asset('assets/vendors/metisMenu/metisMenu.min.js')}}"></script>



<!-- Custom Theme JavaScript -->
<script src="{{asset('assets/dist/js/sb-admin-2.js')}}"></script>

<script type="text/javascript">
    var loading = $('.modal-ajax-loading');
    $(document).ajaxStart(function () {
        loading.fadeIn();
    });

    $(document).ajaxStop(function () {
        loading.fadeOut();
    });
</script>
@yield('scripts')


</body>

</html>
