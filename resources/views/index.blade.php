<?php

$total = 0;
$target = 0;
foreach ($neracas as $neraca) {
    $total += $neraca->total_sample;
    $target += $neraca->target_sample;
}
$progress = floor(($total / $target) * 100);

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
                    <form action="" method="post">
                        <label for="tahun" class="form-label">Data Tahun</label>
                        <input type="number" name="tahun" class="form-control" id="tahun" >
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
                    <span class="info-box-text">Total(Sample)</span>
                    <span class="info-box-number">
                        {{ $total}}
                        <small>Sampel</small>
                    </span>
                    <button class="btn btn-dark" onclick="toggleAnimation({ '.table-total' : ['hide', 'show'], '.table-progress' : ['show', 'hide'], '.table-target' : ['show', 'hide']})">Tabel</button>
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
                    <span class="info-box-text">Target(Sample)</span>
                    <span class="info-box-number">
                        {{ $target}}
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
                    <span class="info-box-text">Progress</span>
                    <span class="info-box-number">
                        {{ $progress}}
                        <small>%</small>
                    </span>
                    <button class="btn btn-dark" onclick="toggleAnimation({ '.table-progress' : ['hide', 'show'], '.table-total' : ['show', 'hide'], '.table-target' : ['show', 'hide']})">Tabel</button>
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
                                        <th>Neraca</th>
                                        <th>Kegiatan</th>
                                        <th>Keterangan</th>
                                        <th>Total(Sample)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($neracas as $data)
                                            <tr>
                                                <td><b>{{ $data->jenis_kegiatan }}</b></td>
                                                <td>{{ $data->nList->kategori_neraca }}</td>
                                                <td>{{ $data->kegiatan }}</td>
                                                <td>{{ $data->keterangan }}</td>
                                                <td>{{ $data->total_sample }}</td>
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
                                        <th>Neraca</th>
                                        <th>Kegiatan</th>
                                        <th>Keterangan</th>
                                        <th>Target(Sample)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($neracas as $data)
                                            <tr>
                                                <td><b>{{ $data->jenis_kegiatan }}</b></td>
                                                <td>{{ $data->nList->kategori_neraca }}</td>
                                                <td>{{ $data->kegiatan }}</td>
                                                <td>{{ $data->keterangan }}</td>
                                                <td>{{ $data->target_sample }}</td>
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
                    <div class="col show-table table-progress hide">
                        <button class="btn btn-light" onclick="hideTable('.table-progress')">Close Table</button>
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">Tabel Data Neraca Produksi</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="position:relative;">
                            <table id="progressTable" class="table table-bordered table-striped text-dark">
                                <thead>
                                    <tr>
                                        <th>Jenis Kegiatan</th>
                                        <th>Neraca</th>
                                        <th>Kegiatan</th>
                                        <th>Keterangan</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($neracas as $data)
                                            <tr>
                                                <td><b>{{ $data->jenis_kegiatan }}</b></td>
                                                <td>{{ $data->nList->kategori_neraca }}</td>
                                                <td>{{ $data->kegiatan }}</td>
                                                <td>{{ $data->keterangan }}</td>
                                                <td>
                                                    <label for="progress">Progress:</label>
                                                    <progress id="progress" value="{{ $data->total_sample }}" max="{{ $data->target_sample }}"></progress>
                                                    <small>{{ $data->total_sample ."/". $data->target_sample }}</small>
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
            </div>
        </section>
    </div>

    @if(session('massage'))
    <div class="infoOrStatus bg-success">
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
@endsection
