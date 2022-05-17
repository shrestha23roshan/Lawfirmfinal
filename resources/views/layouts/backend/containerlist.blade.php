<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{!!  csrf_token() !!}" />
  <title>Dashboard | {!! env('APP_NAME') !!}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('backend/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/skins/_all-skins.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- formValidation -->
  <link href="{{ asset('backend/js/formValidation/formValidation.min.css') }}" rel="stylesheet">

  <!-- sweet alert -->
  <link href="{{ asset('backend/js/sweetalert/dist/sweetalert2.min.css') }}" rel="stylesheet">

  <!-- Custom Style -->
  <link rel="stylesheet" href="{!! asset('css/backend-style.css')!!}" />

   <!-- Custom css -->
   <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
   
  @yield('header_css')
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Top Bar -->
    @include('layouts.backend.header')
    <!-- #Top Bar -->

    <section>
      <!-- Left Sidebar -->
      @include('layouts.backend.sidebar')
      <!-- #END# Left Sidebar -->

      <!-- Right Sidebar -->

      <!-- #END# Right Sidebar -->
    </section>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-top:50px;">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          @include('layouts.backend.breadcrumb')
      </section>

      <!-- Main content -->
      <section class="content">
        @yield('dynamicdata')
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    @include('layouts.backend.footer')

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- Google Translator -->
  {{-- <script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ne'}, 'google_translate_element');
    } 
  </script> --}}

  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <!-- jQuery 3 -->
  <script src="{{ asset('backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- DataTables -->
  <script src="{{ asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <!-- SlimScroll -->
  <script src="{{ asset('backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('backend/bower_components/fastclick/lib/fastclick.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('backend/dist/js/demo.js') }}"></script>

  <!-- Bootstrap Notify Plugin Js -->
  <script src="{{ asset('backend/plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>
  <!-- sweet alert -->
  <script src="{{ asset('backend/js/sweetalert/dist/sweetalert2.min.js') }}"></script>

  <script src="{{ asset('backend/js/onload.js') }}"></script>

  @yield('footer_js')

</body>

</html>
