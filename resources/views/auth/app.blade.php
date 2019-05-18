@section('title','Sistem Presensi')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('css/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('css/assets/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!-- Scripts -->
  

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <!-- Styles -->
  
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="{{asset('css/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('css/assets/css/paper-dashboard.css?v=2.0.0')}}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{asset('css/assets/demo/demo.css')}}" rel="stylesheet" />
</head>
<body>
  <body class="">
    <div class="wrapper ">
      <div class="sidebar" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
      -->
      <div class="logo">
        <a href="{{ url('/admin') }}" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="{{asset('upload_gambar/im.png')}}">
          </div>
        </a>
        <a href="{{ url('/admin') }}" class="simple-text logo-normal">
          Sistem Presensi
          <!-- <div class="logo-image-big">
            <img src="css/assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
    </div>

    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">LOGIN</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            
            
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
      <!-- <div class="panel-header panel-header-lg">
  
  <canvas id="bigDashboardChart"></canvas>
  
  
  
</div> -->
@yield('content')
</main>
<!--   Core JS Files   -->
<script src="{{asset('css/assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('css/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('css/assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('css/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="{{asset('css/assets/js/plugins/chartjs.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('css/assets/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('css/assets/js/paper-dashboard.min.js?v=2.0.0')}}" type="text/javascript"></script>
<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('css/assets/demo/demo.js')}}"></script>
<script>
  $(document).ready(function() {
      // Javascript method's body can be found in css/assets/css/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
</body>
</html>
