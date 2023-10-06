<?php

$userRole = Auth::user()->role;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Simpanan | BPS Karangasem</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset ('asset/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/summernote/summernote-bs4.min.css')}}">
    {{-- any chart --}}
    <script src="https://cdn.anychart.com/releases/8.11.1/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.1/js/anychart-gantt.min.js" type="text/javascript"></script>
    <script src="https://cdn.anychart.com/releases/8.11.1/js/anychart-bundle.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.1/js/anychart-base.min.js"></script>
    <style>
      body {
        margin: 0;
        padding: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      }
      
      .homeContainer p {
        font-size: 1.5rem;
      }

      .homeContainer .logo {
        background: #0b59a1;
        z-index: 10;
      }
      .homeContainer .logo h1 {
        font-size: 5vw;
        font-family: Helvetica, sans-serif;
        font-weight: bolder;
        color: aliceblue;
      }

      .homeContainer .pembatas {
        background-color: black !important;
        width: 100%;
        height: 5px;
      }

      .homeContainer a {
        text-decoration: none;
        color: black;
      }

      .homeContainer .menuItem {
        opacity: 0;
        transform: translateX(-50px);
        transition: 1s;
      }
      .homeContainer .menuItem.show {
        opacity: 100;
        transform: translateX(0px);
        transition: 1s;
      }
      .homeContainer .menuItem.show p {
        font-family: "Montserrat";
        font-weight: bold;
      }
      .homeContainer .menuItem:hover {
        transform: translateY(-30px);
      }

      @media only screen and (min-width: 620px) {
        .homeContainer p {
          font-size: 2rem;
        }
        .homeContainer .menu-icon {
          width: 100px;
          margin-bottom: 7px;
        }
        .homeContainer .menu-title {
          justify-content: center;
        }
      }
      .styleGridRow {
        font-family: Georgia, "Times New Roman", Times, serif !important;
        font-size: 7px !important;
        font-weight: bold !important;
      }

      #pieChart, #lineChart {
        height: 300px;
        margin: 5px
      }

      select {
        width: 100%;
        height: 54%;
        border-radius: 5px;
      }

      .wrapper {
        overflow-x: hidden;
      }

      #new_child_here .frame-child:hover {
        transform: translate(50px, 50px);
      }/*# sourceMappingURL=mainStyle.css.map */
      .menu-home{
        height: 0px;
        overflow: hidden;
        transition: 1s;
      }
      .menu-home.active{
        height: 110px;
      }
      .show-table.hide{
        height: 0px;
        overflow: hidden;
        transition: 1s;
      }
      .show-table.show{
        height: 805px;
        overflow: hidden;
        transition: 1s;
      }
      .toggleHomeMenu {
        cursor: pointer;
      }
      .fa-angle-right{
        transform: rotate(0deg);
        transition: 1s;
      }
      .fa-angle-right.active{
        transform: rotate(90deg);
      }
      .infoOrStatus{
        z-index: 99999;
        position: fixed;
        right: 0;
        top: 0;
        width: 450px;
        padding: 5px;
        border: 3px solid hsla(130,100%,20%,1);
        border-radius: 5px;
        display: flex;
        justify-content: start;
        box-sizing: border-box;
        transform: translateX(450px);
        animation: fade-in 1.5s 1.5s ease-in-out forwards, fade-out 1.5s 7.5s ease-in-out forwards;
      }
      .infoOrStatus .massage-box{
        font-family: 'Times New Roman', Times, serif;
        font-size: 1.1em;
        font-weight: 100;
      }
      /* key frames */
      
      @keyframes fade-in{
        0%{ transform: translateX(450px);}
        100%{ transform: translateX(0px);}
      }
      @keyframes fade-out{
        0%{ transform: translateX(0px);}
        100%{ transform: translateX(450px);}
      }
      
      </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset ('asset/img/BPS_Logo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="https://www.bps.go.id" class="brand-link">
      <img src="{{ asset ('asset/img/BPS_Logo.png')}}" alt="PPS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Simpanan|BPS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-closed">
            <a href="#" class="nav-link">
              <img src="{{ asset('asset/img/neraca_icon.png') }}" alt="" class="nav-icon">
              <p>
                Neraca
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="neracaProduksi" class="nav-link">
                  <img src="{{ asset('asset/img/produksi_icon.png') }}" alt="" class="nav-icon">
                  <p>Neraca Produksi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="neracaPengeluaran" class="nav-link">
                  <img src="{{ asset('asset/img/pengeluaran_icon.png') }}" alt="" class="nav-icon">
                  <p>Neraca Pengeluaran</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-closed">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bars"></i>
              <p>Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              @if($userRole == 'Admin')
              <li class="nav-item">
                <a href="goToAddPemantau" class="nav-link">
                  <img src="{{ asset('asset/img/home_icon.png') }}" alt="" class="nav-icon">
                  <p>Tambah User</p>
                </a>
              </li>
              @endif
              <li class="nav-item">
                <a href="home" class="nav-link active">
                  <img src="{{ asset('asset/img/home_icon.png') }}" alt="" class="nav-icon">
                  <p>Home</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="log-out" class="nav-link">
                  <img src="{{ asset('asset/img/logout_icon.png') }}" alt="" class="nav-icon">
                  <p>Log Out</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content') 
  </div>

    <!-- Main content -->
    <section class="content">
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <form action="add" method="post">
            <label for=""></label>
            <input type="text" name="" id="" placeholder="" required>
          </form>
        </div>
      </div>
    </div>
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('asset/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('asset/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('asset/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('asset/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('asset/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{ asset('asset/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('asset/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('asset/plugins/moment/moment.min.js')}}"></script>
    <script src="{{ asset('asset/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{ asset('asset/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ('asset/dist/js/adminlte.js')}}"></script>
    {{-- Gouges Chart --}}
    <script src="https://cdn.anychart.com/releases/8.11.1/js/anychart-circular-gauge.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{  asset('asset/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{  asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{  asset('asset/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{  asset('asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{  asset('asset/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{  asset('asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{  asset('asset/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{  asset('asset/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{  asset('asset/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{  asset('asset/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{  asset('asset/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{  asset('asset/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script>
      "use strict";

      $(function(){
        $("#totalTable").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#totalTable_wrapper .col-md-6:eq(0)');
        $('#tBM1').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
        $("#targetTable").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#targetTable_wrapper .col-md-6:eq(0)');
        $('#tBM2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
        $("#progressTable").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#progressTable_wrapper .col-md-6:eq(0)');
        $('#tBM3').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });

        $(".toggleHomeMenu").on('click', function(){
          $(".menu-home").toggleClass('active');
          $(".fa-angle-right").toggleClass('active');
        });
      });

      function toggleAnimation(toggleElements){
      // iterate through object
      console.log(toggleElements);
        Object.entries(toggleElements).forEach(entry => {
          const [key, value] = entry;
          r_o_a(key, value);
        });
        function r_o_a(key, value) {
          if($(key).hasClass(value[0])){
              $(key).removeClass(value[0]);
              $(key).addClass(value[1]);
          }else{
            $(key).addClass(value[1]);
          }
        }
      }
      function hideTable(toggleElements){
      // iterate through object
      $(toggleElements).removeClass('show');
      $(toggleElements).addClass('hide');
      }
      
    </script>
</body>
</html>
