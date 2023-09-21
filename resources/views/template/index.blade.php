<?php date_default_timezone_set("Asia/Jakarta"); ?>
<?php
use Illuminate\Support\Facades\Auth;
$userRole = Auth::user()->role;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Simpanan | BPS Karangasem</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
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
      body{
        overflow: hidden;
        margin: 0;
        padding: 0;
        font-family: Georgia, 'Times New Roman', Times, serif;
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
      p,h1,h2,h3,h4,h5,h6,a,li,label{
        color: whitesmoke;
      }
      table td,
      table label,
      table h1, 
      table h2, 
      table h3, 
      table h4, 
      table h5, 
      table a, 
      table label,  
      table li, 
      table span, 
      .data-info li{
        color: black;
      }
      .content-wrapper{
        background: hsla(0, 0%, 5%, 1);
        background: linear-gradient(45deg, hsla(0, 0%, 5%, 1) 0%, hsla(0, 0%, 64%, 1) 100%);
        background: -moz-linear-gradient(45deg, hsla(0, 0%, 5%, 1) 0%, hsla(0, 0%, 64%, 1) 100%);
        background: -webkit-linear-gradient(45deg, hsla(0, 0%, 5%, 1) 0%, hsla(0, 0%, 64%, 1) 100%);
        filter: progid: DXImageTransform.Microsoft.gradient( startColorstr="#0c0c0c", endColorstr="#a2a2a2", GradientType=1 );
      }
      .slided{
        transform: translateY(350vh);
        animation: slided 1s ease-in-out forwards ;
        position: absolute;
        width: 100%;
      }
      .selectedSlide{
        animation: selectedSlide 2s ease-in-out forwards ;
        position: absolute;
        width: 100%;
      }
      .hide,.show{
        position: absolute;
        width: 100%
      }
      select{
        width: 100%;
        height: 54%;
        border-radius: 5px;
      }
      #new_child_here .frame-child,
      .frame-child {
        /* border: solid 3px black; */
        border-radius: 10px;
        box-shadow: 3px 3px 5px black inset, 1px 1px 0px black;
        transition: 1s, box-shadow 0.1s;
      }
      #new_child_here .frame-child:hover,
      .frame-child:hover {
        /* border: solid 3px greenyellow; */
        box-shadow: 1px 1px 0px black inset, 3px 3px 5px black;
      }

      @media only screen and (min-width: 375px){
        .styleGridRow{
          font-size: 3px !important;
        }
        
        #new_child_here .frame-child,
        .frame-child {
          /* border: solid 3px black; */
          width: 90vw !important;
          border-radius: 10px;
          box-shadow: 3px 3px 5px black inset, 1px 1px 0px black;
          transition: 1s, box-shadow 0.1s;
        }
        #new_child_here .frame-child:hover,
        .frame-child:hover {
          /* border: solid 3px greenyellow; */
          width: 90vw !important;
          box-shadow: 1px 1px 0px black inset, 3px 3px 5px black;
        }
      }
      .ganttContainer{
        height: 75vh !important;
        overflow-y: scroll !important;
      }
      #gantt_here{
        margin: 5px auto;
        height: 75vh;
      }
      .t_o_button{
        cursor: pointer;
        border: 1px solid green;
        transition: 1s;
        transform: translate(0, 0);
      }
      .t_o_button:hover{
        transform: translate(-1px, -3px);
        border: 3px solid greenyellow;
      }
      .show{
        animation: show 1s forwards, showP 1s forwards 0.3s;
        z-index: 999;
      }
      .hide{
        animation: hide 1s forwards, hideP 1s forwards 0.3s;
      }
      .editProduksiContainer,
      .addProduksiContainer,
      .dataProduksiTabel,
      .editPengeluaranContainer,
      .addPengeluaranContainer,
      .dataPengeluaranTabel,
      .dataUsersTabel,
      .chartContainer{
        overflow-y: scroll;
        max-height: 75vh;
      }
      /* keyframes */
      @keyframes fade-in{
        0%{ transform: translateX(450px);}
        100%{ transform: translateX(0px);}
      }
      @keyframes fade-out{
        0%{ transform: translateX(0px);}
        100%{ transform: translateX(450px);}
      }
      @keyframes show{
        0%{ opacity: 0;}
        100%{ opacity: 1;}
      }
      @keyframes hide{
        0%{ opacity: 1;}
        100%{ opacity: 0;}
      }
      
      @keyframes hideP{
        0%{ position: relative;}
        100%{ position: absolute;}
      }
      
      @keyframes showP{
        0%{ position: absolute;}
        100%{ position: relative;}
      }
      @keyframes slided{
        0%{ transform: translateY(0px); z-index: 0;}
        100%{ transform: translateY(350vh);}
      }
      @keyframes selectedSlide{
        0%{ transform: translateY(350vh);}
        100%{ transform: translateY(0px); z-index: 999;}
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
                <a href="home" class="nav-link">
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

    <!-- Main content -->
    <section class="content-wrapper">
      @yield('content') 
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  {{-- <footer class="main-footer">
  </footer> --}}

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
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
    <!-- AdminLTE App -->
    <script src="{{ asset ('asset/dist/js/adminlte.js')}}"></script>
    <script>
      "use strict";
      
      $(function () {
        $("#nPTabel").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#nPTabel_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
        $("#usersTable").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false
        }).buttons().container().appendTo('#usersTable_wrapper .col-md-6:eq(0)');
        $('#tBM4').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    //  draw GanttChart
    function drawGanttChart(choosedYear){
        anychart.data.loadJsonFile(
          "api/dataProduksi",
          (raw) => {
            let usableData = [];
            let getPath = window.location.pathname;
            let path = getPath.split("/");
            let usablePath = path[path.length - 1];
            raw.data.forEach(getUsableData);
            function getUsableData(data){
              if(usablePath == "neracaProduksi" && new Date(data.periods[0].start).getFullYear() == choosedYear){
                if(data.neraca == "Produksi"){
                  usableData.push(data);
                  }
              }else if(usablePath == "neracaPengeluaran" && new Date(data.periods[0].start).getFullYear() == choosedYear){
                if(data.neraca == "Pengeluaran"){
                  usableData.push(data);
                }
              }
            };
            let chart = anychart.ganttResource();
            // create data tree using given data
            let treeData = anychart.data.tree(usableData, "as-table");
            // Set Header Format
            var scale = chart.xScale();
            // Set zoom levels.
            scale.zoomLevels([
                [
                    {unit: 'day', count: 1},
                    {unit: 'week', count: 1},
                    {unit: 'month', count: 1},
                    {unit: 'year', count: 1}
                ]
            ]);
            // configure the levels of the timeline header
            var header = chart.getTimeline().header();
            header.level(1).format((date) => {
              return (0 | date.value / 7) + 1;
            });

            // ===============================================
            // get chart data grid link to set column settings
            let dataGrid = chart.dataGrid();
            // get chart timeline
            let timeLine = chart.getTimeline();
            // ==============================================
            
            // ===============================Data Grid Column
            let column_1 = chart.dataGrid().column(0);
            column_1.setColumnFormat("J_K","text");
            column_1.title().useHtml(true);
            column_1.title("Jenis Kegiatan");
            let column_2 = chart.dataGrid().column(1);
            column_2.setColumnFormat("neraca","text");
            column_2.title().useHtml(true);
            column_2.title("Neraca");
            let column_3 = chart.dataGrid().column(2);
            column_3.setColumnFormat("kegiatan","text");
            column_3.title().useHtml(true);
            column_3.title("Kegiatan");
            let column_4 = chart.dataGrid().column(3);
            column_4.setColumnFormat("T_S","text");
            column_4.title().useHtml(true);
            column_4.title("Total Sampel");
            let column_5 = chart.dataGrid().column(4);
            column_5.setColumnFormat("keterangan","text");
            column_5.title().useHtml(true);
            column_5.title("Keterangan");

            // ===============================Timeline
            // Mengatur Tooltip timeline
            chart.getTimeline().tooltip().useHtml(true);
            chart.getTimeline().tooltip().format(
              "<span>"+
                "{%start}{dateTimeFormat:dd MMM} - {%end}{dateTimeFormat:dd MMM} <br>"+
                "{%kategori}"+
              "</span>"
            );
            
            // zoom to units
            $('.unitZoom').on('change', ()=>{
              let unit = $('.unitZoom').val();
              let countFactor = 2;
              let anchor = 'first-date';
              chart.zoomTo(unit, countFactor, anchor);
            });
            chart.listen("rowClick", (e)=>{
              $('.data-info').empty();
              let itemName = e.item.get('periods');
              itemName.forEach(test)

              function test(data){
                $('.data-info').append(
                  `<li class="list-group-item">${data.kategori} : ${data.start} sampai ${data.end}</li>`
                );
              }
            });
            
            // ===============================Create Gantt Chart
            if(usablePath == "neracaProduksi" || usablePath == "neracaPengeluaran"){
              chart.data(treeData);
              chart.getTimeline().scale().minimum(Date.UTC(choosedYear,0,1));
              chart.getTimeline().scale().maximum(Date.UTC(choosedYear,11,30));
              chart.container("gantt_here");
              chart.draw();
              chart.fitAll();
            }
          }
        );
    }
    // set range year to GanttChart
    $("#tahun").on('change', () =>{
      $('#gantt_here').empty();
      drawGanttChart(parseInt($("#tahun").val()));
    });

    // Make Child Form addDataProduksi
    var childPageCounter = 1;
    $(".new_child_btn").on("click", () => {
      let tag = $("#new_child_here");
      if($(".child_repeat").val() <= 0){
        $(".child_repeat").val(1)
      }else{
        for(let i = 0; i < $(".child_repeat").val(); i++) {
          tag.append(
              "<div class='col-5 frame-child p-3 m-3 child"+childPageCounter+"'>"+
                "<div class='row'>"+
                  "<div class='col'>"+
                      "<label for='child_kategori-kegiatan' class='form-label'>kategori</label>"+
                      "<select class='form-select form-select-lg mb-3' id='child_kategori-kegiatan' name='child_kategori_kegiatan[]' required>"+
                        "<option selected value=''>Pilih Kategori Kegiatan</option>"+
                        "@if(isset($kategori))"+
                        "@foreach($kategori as $value)"+
                        "<option value='{{ $value->id }}'>{{ $value->kategori_kegiatan }}</option>"+
                        "@endforeach"+
                        "@endif"+
                      "</select>"+
                  "</div>"+
                "</div>"+
                "<div class='row'>"+
                  "<div class='col'>"+
                    "<label for='start'>Tgl Mulai</label>"+
                    "<input type='date' class='form-control' id='start' name='start[]' required>"+
                  "</div>"+
                "</div>"+
                "<div class='row'>"+
                  "<div class='col'>"+
                    "<label for='end'>Tgl Berakhir</label>"+
                    "<input type='date' class='form-control' id='end' name='end[]' required>"+
                  "</div>"+
                "</div>"+
                "<div class='row'>"+
                  "<div class='col'>"+
                    "<p class='text-center fs-4 fw-bold'>"+childPageCounter+"</p>"+
                  "</div>"+
                "</div>"+
                "<div class='row'>"+
                  "<div class='col d-flex justify-content-center'>"+
                    "<button type='button' class='btn btn-light new_child_btn' onclick='deleteChild(\".child"+childPageCounter+"\")'><img src='{{ asset('asset/img/x_icon.png') }}' alt='Delete' width='30px'></button>"+
                  "</div>"+
                "</div>"+
              "</div>"
          );
          childPageCounter++;
        }
      }
    });
    // prevent minus value in input box
    $(".no-minusValue").on("change", () => {
      if($(".no-minusValue").val() <= 0){
        $(".no-minusValue").val(1);
      }
    });
    // Delete Child form 
    function deleteChild(id){
      $(id).remove();
    };
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
    function toggleOpacity(toggleElements){
    // iterate through object
      Object.entries(toggleElements).forEach(entry => {
        const [key, value] = entry;
        r_o_a(key, value);
        console.log(key, value);
      });
      
      // $("#" + arguments[0]).removeClass('hide');
      function r_o_a(key, value) {
        if(value == 'hide'){
          
          if($(key).hasClass('show')){
            $(key).removeClass('show');
            $(key).addClass('hide');
          }else{
            $(key).addClass('hide');
          }
        }else if(value == 'show'){
          if($(key).hasClass('hide')){
            $(key).removeClass('hide');
            $(key).addClass('show');
          }else{
            $(key).addClass('show');
          }
        }
      }
    }
    anychart.onDocumentReady(() => {
      let choosedYear = new Date().getFullYear();
      drawGanttChart(choosedYear);
    });
    
    </script>
</body>
</html>
