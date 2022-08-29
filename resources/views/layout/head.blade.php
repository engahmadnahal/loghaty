
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="PIXINVENT">
    <link rel="apple-touch-icon" href="{{asset('app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/favicon.ico')}}">

    {{-- If En or LRT --}}
    @if(!App::isLocale('ar'))
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/tether-theme-arrows.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/tether.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/shepherd-theme-default.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/dashboard-analytics.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/card-analytics.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/tour/tour.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!-- END: Custom CSS-->

    <!-- BEGIN: Toastr-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/extensions/toastr.css')}}">
    <!-- END: Toastr-->

    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/app-user.css')}}">

    @endif


    {{-- IF AR or RTL --}}
    @if(App::isLocale('ar'))
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors-rtl.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/charts/apexcharts.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/tether-theme-arrows.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/tether.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/shepherd-theme-default.css')}}">
        <!-- END: Vendor CSS-->
    
        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/bootstrap-extended.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/components.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/themes/dark-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/themes/semi-dark-layout.css')}}">
    
        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/core/colors/palette-gradient.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/pages/dashboard-analytics.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/pages/card-analytics.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/tour/tour.css')}}">
        <!-- END: Page CSS-->
    
        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/custom-rtl.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style-rtl.css')}}">
        <!-- END: Custom CSS-->
    
        <!-- BEGIN: Toastr-->
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/toastr.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/extensions/toastr.css')}}">
        <!-- END: Toastr-->
    
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/select/select2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/core/colors/palette-gradient.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/pages/app-user.css')}}">
    
    
        <!-- BEGIN: Custom CSS For Ar Lang-->
        <style>

            body ,
            .navigation .navigation-header,
            .main-menu.menu-light .navigation > li ul .active > a,
            .navigation,
            div#navbar-mobile{
                font-family: 'Cairo', sans-serif;
            }
        
        </style>

        <!-- END: Custom CSS For Ar Lang -->
    @endif

    {{-- Global --}}
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/dashboard-analytics.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">


    <style>

        .action-table button , .action-table a{
            padding: 10px;
        }
        .dataTables_length{display: none}

        .page-users-view .users-view-image {
            height: 120px;
        }
        .tippy-content {
    display: none !important;
}
.card a.anlytics {
    color: #616261;
}
.page-users-view .users-view-permission table .tableCustomRow td{
    padding-bottom: 7px;
    border-bottom: 1px solid #ebebeb;
    background: #fafafa;
}

.preview-image {
    width: 100px;
    height: 100px;
    padding: 4px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin: 10px 0;
}
.preview-image img{
    margin: 0;
    object-fit: cover;
    width: 100%;
    height: 100%;
    text-align: center;
    padding: 4px;
}
    </style>
