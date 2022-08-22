
<!DOCTYPE html>
<html class="loading" lang="{{App::isLocale('ar') ? 'ar' : 'en'}}" data-textdirection="{{App::isLocale('ar') ? 'rtl' : 'ltr'}}">
<!-- BEGIN: Head-->
<head>
@include('layout.head')
<title>Loghaty - @yield('title','Dahsboard')</title>
</head>
<!-- END: Head-->
<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
@include('layout.header')
@include('layout.side')
<div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">@yield('title_page')</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                    @yield('content')
                <!-- Dashboard Analytics end -->
            </div>
        </div>
    </div>

@include('layout.footer')
@yield('scripts')
</body>
</html>