<?php

$totalProduksi = 0;
$totalPengeluaran = 0;
$targetProduksi = 0;
$targetPengeluaran = 0;
foreach ($neracas->where('kategori_neraca_id', 1) as $neraca) {
    $totalProduksi += $neraca->total_sample;
    $targetProduksi += $neraca->target_sample;
}
foreach ($neracas->where('kategori_neraca_id', 2) as $neraca) {
    $totalPengeluaran += $neraca->total_sample;
    $targetPengeluaran += $neraca->target_sample;
}
// $progress = floor(($total / $target) * 100);

?>
@extends('template/index2')
@section('content')
<section class="homeContainer">
    <!-- Logo Container -->
    <div class="container-fluid logo pt-3 bg-dark"">
        <div class="row">
            <div class="col d-flex justify-content-center align-items-center">
                <img src="{{ asset('asset/img/BPS_Logo.png') }}" alt="" width="10%">
            </div>
        </div>
        <div class="row mt-3" >
            <div class="col d-flex justify-content-center align-items-center">
                <h1 class="h1">SIMPANAN</h1>
            </div>
        </div>
    </div>

    <div class="pembatas"></div>
    <div class="container-fluid position-relative bg-dark">
        <div class="row">
            <div class="col toggleHomeMenu ">
                <span>Option
                <i class="fas fa-angle-right"></i>
                </span>
            </div>
        </div>
        <div class="menu-home container-fluid m-3">
            <div class="row">
                <div class="col-lg-3">
                    <form action="dataTahunHome" method="post">
                        @csrf
                        <label for="tahun" class="form-label">Data Tahun</label>
                        <input type="number" name="tahun" class="form-control" id="tahun" >
                        <button type="submit" class="btn btn-light">Tetapkan</button>
                    </form>
                </div>
            </div>
        </div>
        
        <section class="content">
            <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row text-dark d-flex justify-content-center">
                <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
    
                    <div class="info-box-content">
                    <span class="info-box-text">Produksi</span>
                    <span class="info-box-number">
                        {{ $totalProduksi."/".$targetProduksi}}
                        <small>Sampel</small>
                    </span>
                    <button class="btn btn-dark" onclick="toggleAnimation({ '.table-total' : ['hide', 'show'], '.table-chart' : ['show', 'hide'], '.table-target' : ['show', 'hide']})">Tabel</button>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
    
                    <div class="info-box-content">
                    <span class="info-box-text">Pengeluaran</span>
                    <span class="info-box-number">
                        {{ $totalPengeluaran."/".$targetPengeluaran}}
                        <small>Sampel</small>
                    </span>
                    <button class="btn btn-dark" onclick="toggleAnimation({ '.table-target' : ['hide', 'show'], '.table-total' : ['show', 'hide'], '.table-progress' : ['show', 'hide']})">Tabel</button>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </div>
                <!-- /.col -->
    
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
    
                <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Chart</span>
                    <span class="info-box-number">
                    <small>2 Chart</small>
                    </span>
                    <button class="btn btn-dark" onclick="toggleAnimation({ '.table-chart' : ['hide', 'show'], '.table-total' : ['show', 'hide'], '.table-target' : ['show', 'hide']})">Tabel</button>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            </div><!--/. container-fluid -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col show-table table-total hide">
                        <button class="btn btn-light" onclick="hideTable('.table-total')">Close Table</button>
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">Tabel Data Neraca Produksi</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="position:relative;">
                            <table id="totalTable" class="table table-bordered table-striped text-dark">
                                <thead>
                                    <tr>
                                        <th>Jenis Kegiatan</th>
                                        <th>Kegiatan</th>
                                        <th>Keterangan</th>
                                        <th>Total(Sample)</th>
                                        <th>Target(Sample)</th>
                                        <th>Progres</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($neracas->where('kategori_neraca_id', 1) as $data)
                                            <tr>
                                                <td><b>{{ $data->jenis_kegiatan }}</b></td>
                                                <td>{{ $data->kegiatan }}</td>
                                                <td>{{ $data->keterangan }}</td>
                                                <td>{{ $data->total_sample }}</td>
                                                <td>{{ $data->target_sample }}</td>
                                                <td>
                                                    <?php $progress = ($data->total_sample / $data->target_sample) * 100 ?>
                                                        @if($progress <= 25)
                                                          <div><span class="badge bg-danger">{{ $progress."%" }}</span></div>
                                                          <div class="progress progress-xs"> 
                                                            <div class="progress-bar bg-danger" style="width: {{ $progress . "%" }}" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="{{ $data->target_sample }}"></div>
                                                          </div>
                                                        @elseif($progress >= 75)
                                                          <div><span class="badge bg-success">{{ $progress."%" }}</span></div>
                                                          <div class="progress progress-xs"> 
                                                            <div class="progress-bar bg-success" style="width: {{ $progress . "%" }}" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="{{ $data->target_sample }}"></div>
                                                          </div>
                                                        @else
                                                          <div><span class="badge bg-info">{{ $progress."%" }}</span></div>
                                                          <div class="progress progress-xs"> 
                                                            <div class="progress-bar bg-info" style="width: {{ $progress . "%" }}" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="{{ $data->target_sample }}"></div>
                                                          </div>
                                                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col show-table table-target hide">
                        <button class="btn btn-light" onclick="hideTable('.table-target')">Close Table</button>
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">Tabel Data Neraca Produksi</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="position:relative;">
                            <table id="targetTable" class="table table-bordered table-striped text-dark">
                                <thead>
                                    <tr>
                                        <th>Jenis Kegiatan</th>
                                        <th>Kegiatan</th>
                                        <th>Keterangan</th>
                                        <th>Total(Sample)</th>
                                        <th>Target(Sample)</th>
                                        <th>Progres</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($neracas->where('kategori_neraca_id', 2) as $data)
                                            <tr>
                                                <td><b>{{ $data->jenis_kegiatan }}</b></td>
                                                <td>{{ $data->kegiatan }}</td>
                                                <td>{{ $data->keterangan }}</td>
                                                <td>{{ $data->total_sample }}</td>
                                                <td>{{ $data->target_sample }}</td>
                                                <td>
                                                    <?php $progress = ($data->total_sample / $data->target_sample) * 100 ?>
                                                        @if($progress <= 25)
                                                          <div><span class="badge bg-danger">{{ $progress."%" }}</span></div>
                                                          <div class="progress progress-xs"> 
                                                            <div class="progress-bar bg-danger" style="width: {{ $progress . "%" }}" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="{{ $data->target_sample }}"></div>
                                                          </div>
                                                        @elseif($progress >= 75)
                                                          <div><span class="badge bg-success">{{ $progress."%" }}</span></div>
                                                          <div class="progress progress-xs"> 
                                                            <div class="progress-bar bg-success" style="width: {{ $progress . "%" }}" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="{{ $data->target_sample }}"></div>
                                                          </div>
                                                        @else
                                                          <div><span class="badge bg-info">{{ $progress."%" }}</span></div>
                                                          <div class="progress progress-xs"> 
                                                            <div class="progress-bar bg-info" style="width: {{ $progress . "%" }}" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="{{ $data->target_sample }}"></div>
                                                          </div>
                                                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col show-table table-chart hide">
                        <button class="btn btn-light" onclick="hideTable('.table-chart')">Close Table</button>
                        <div class="row">
                            <div class="col ">
                                <div id="pieChart"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col ">
                                <div id="lineChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @if(session('massage'))
    <div class="infoOrStatus bg-light">
        <div class="massage-box">
            <ul>
            @foreach(session('massage') as $msg)
                <li>{{ $msg }}</li>
            @endforeach
            </ul>
        </div>
    </div>
    @endif
</section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <!-- Gantt Chart -->
    <script src="http://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <!-- My Js -->
    <script src="{{ asset('asset/js/mainJs.js') }}"></script>
    <script>
        // Pie Chart
        var pieChart = <?php
        $pieChart = ['chart' => [
            'type' => 'pie',
            'data' => [
                ['x' => 'Produksi', 'value' => $neracas->where('kategori_neraca_id', 1)->sum('target_sample'), 'fill' => 'green'],
                ['x' => 'Pengeluaran', 'value' => $neracas->where('kategori_neraca_id', 2)->sum('target_sample'), 'fill' => 'orange']
            ],
            'container' => 'pieChart'
        ]];
        echo json_encode($pieChart, JSON_NUMERIC_CHECK);
        
        ?>;
        var chart = anychart.fromJson(pieChart);
        chart.draw();

        // Line Chart
        var lineChart = <?php
            use App\Models\Neraca;
            
            $yearNow = idate('Y');
            $startYear = 2018;
            $lineChartData = [];
            for ($x = 0; $startYear <= $yearNow; $x++) {
            $lineChartData[$x] = [
                $startYear,
                Neraca::whereYear('tanggal_mulai', $startYear)->where('kategori_neraca_id', 1)->sum('target_sample'),
                Neraca::whereYear('tanggal_mulai', $startYear)->where('kategori_neraca_id', 2)->sum('target_sample')
            ];
            $startYear++;
            };
            echo json_encode($lineChartData, JSON_NUMERIC_CHECK);
        ?>;
        // create data set on our data
        var dataSet = anychart.data.set(lineChart);
        // map data for the first series, take x from the zero column and value from the first column of data set
        var firstSeriesData = dataSet.mapAs({ x: 0, value: 1 });

        // map data for the second series, take x from the zero column and value from the second column of data set
        var secondSeriesData = dataSet.mapAs({ x: 0, value: 2 });
        // create line chart
        var chart = anychart.line();
        // set chart padding
        chart.padding([10, 20, 5, 20]);
        // turn on the crosshair
        chart.crosshair().enabled(true).yLabel(false).yStroke(null);

        // set tooltip mode to point
        chart.tooltip().positionMode('point');

        // set chart title text settings
        chart.title(
        'Target Neraca Produksi dan Pengeluaran pada tiap tahun.'
        );

        // set yAxis title
        chart.yAxis().title('Target(Sample)');
        chart.xAxis().labels().padding(5);

        // create first series with mapped data
        var firstSeries = chart.line(firstSeriesData);
        firstSeries.name('Produksi');
        firstSeries.hovered().markers().enabled(true).type('circle').size(4);
        firstSeries
        .tooltip()
        .position('right')
        .anchor('left-center')
        .offsetX(5)
        .offsetY(5);

        // create second series with mapped data
        var secondSeries = chart.line(secondSeriesData);
        secondSeries.name('Pengeluaran');
        secondSeries.hovered().markers().enabled(true).type('circle').size(4);
        secondSeries
        .tooltip()
        .position('right')
        .anchor('left-center')
        .offsetX(5)
        .offsetY(5);

        // turn the legend on
        chart.legend().enabled(true).fontSize(13).padding([0, 0, 10, 0]);

        // set container id for the chart
        chart.container('lineChart');
        // initiate chart drawing
        chart.draw();
    </script>
@endsection
