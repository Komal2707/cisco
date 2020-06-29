<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mercantile') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('head_css')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- Google Font -->
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">--}}

</head>
<body class="hold-transition skin-remarkyt sidebar-mini">
<div class="wrapper" id="app">
    <div class="loader" v-bind:style="[inprocess ? {display:'block'} : {display:'none'}]">
        <div class="overlay"></div>
        <div class="loader-img loader-parent">
            <img class="faa-flash animated loader-img-1"  src="{{asset('/images/remarkyt-200X200.png')}}" />
        </div>
    </div>
    <!-- Head Navigation bar -->
    @include('layouts.smonk.partials.head-nav')
            <!-- Head Navigation bar -->

    <!-- Left side bar -->
    @include('layouts.smonk.partials.side-nav')
            <!-- Left side bar -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" onclick="controlSidebarClose()">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @if(isset($pageName) && is_array($pageName))
                    {{ isset($pageName[0]) ? $pageName[0] : ""}}
                    <small> {{isset($pageName[1])  ? $pageName[1] : ""}}</small>
                @endif
            </h1>
            <ol class="breadcrumb">
                @stack('buttons')
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright © 2018-2019 <a href="https://mercantilepacific.com/">Mercantile</a>.</strong> All rights
        reserved.
    </footer>
    <aside id="control-sidebar" class="control-sidebar control-sidebar-dark" style="height: 100%;overflow: scroll;width: 320px;">
        <h3 class="control-sidebar-heading" style="margin: 10px">Notifications<span class="fa fa-close" onclick="controlSidebarClose()"></span></h3>
        <ul class="control-sidebar-menu" style="margin: 0px">

            <notification v-bind:notifications="notifications"></notification>
            <li class="footer"><a href="{{route("admin::notify::index")}}" class="text-center btn btn-success">View All</a></li>


        </ul>
        <!-- /.control-sidebar-menu -->


    </aside>

    <!-- control sidebar -->


    <!-- control sidebar ends -->
    <div class="modal fade" id="custom-page-model" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="custom-page-model-body">
                <div class="modal-header">

                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>

    </div>

    <flash message="{{ session('flash') }}"></flash>
    <audio ref="audio" id="notification-sound" src="{{asset('audio/notification2.mp3')}}">
    <audio ref="audio" id="error" src="{{asset('audio/error.mp3')}}">

</div>
<script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    function getNewDeliveryRequest(reqid) {
        window.app.getNewDeliveryRequest(reqid);
    }

    function loadPageIntoModel(url) {

        $("#custom-page-model-body").load(url, function () {
            $('#custom-page-model').modal({show: true});

        });


    }
    
    $(document).on("submit", "#custom-page-model-body form", function (e) {

        e.preventDefault();
        var data = $(this).serialize();
        var url = $(this).attr("action");

        axios.post(url, data).then(function (data) {
                $('#custom-page-model').modal('hide');
                window.LaravelDataTables["dataTableBuilder"].draw('page');

            }
        ).catch(function (error) {
            $('#custom-page-model').modal('hide');
            if(error.response.data.errors!=undefined)
                $.each( error.response.data.errors, function( key, value ) {
                    $.each( value, function( key2, error ) {
                        notyf.alert(error);
                    });
                });

        });
    });


function controlSidebarClose()
{

    let targetElement = document.getElementById('control-sidebar');
    targetElement.classList.remove("control-sidebar-open");

}


</script>

@stack('scripts')
@yield('postscript')
</body>


</html>
