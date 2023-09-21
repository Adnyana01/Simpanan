@extends('../template/index')
@section('content')
<?php

$userRole = Auth::user()->role;
$units = ["day","week","third-of-month",
        "month","quarter","year"
        ];
?>

<div class="container-fluid m-0 p-0">
    <div class="menuProduksi row justify-content-center bg-dark">
        <div class="col border border-white rounded t_o_button btn btn-dark" onclick="toggleAnimation({ '.addProduksiContainer' : ['selectedSlide', 'slided'],'.chartContainer' : ['slided', 'selectedSlide'], '.addDataProduksi' : ['selectedSlide', 'slided'], '.dataProduksiTabel' : ['selectedSlide', 'slided'], '.editProduksiContainer':['selectedSlide', 'slided']})">
            Tampilkan Chart
        </div>
        <div class="col border border-white rounded t_o_button btn btn-dark" onclick="toggleAnimation({'.chartContainer' : ['selectedSlide', 'slided'], '.addProduksiContainer' : ['selectedSlide', 'slided'], '.addDataProduksi' : ['slided', 'selectedSlide'], '.dataProduksiTabel' : ['slided', 'selectedSlide'], '.editProduksiContainer':['selectedSlide', 'slided']})">
            Data Table
        </div>
    </div>
    <div class="wrap" style="position: relative">
        <div class="row slided chartContainer">
            <div class="col p-3">
                <div class="row">
                    <div class="col-4">
                        <label for="tahun" class="form-label">Data Tahun</label>
                        <input type="number" class="form-control" placeholder="Data Tahun?" id="tahun">
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col">
                                <label for="unit" class="form-label">Data Unit</label>
                                <select name="unit" id="unit" class="form-select unitZoom">
                                    <option selected>Pilih Skala Unit</option>
                                    @foreach($units as $unit)
                                    <option value="{{ $unit }}">{{ $unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col">
                        <ul class="list-group data-info">
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div id="gantt_here"></div>
                    </div>
                </div>
            </div>
        </div>
        @if($userRole == 'Admin')
        <div class="row slided justify-content-center bg-dark addDataProduksi" style="position: relative;">
            <div class="col border border-white rounded t_o_button btn btn-dark m-0" onclick="toggleAnimation({'.addProduksiContainer' : ['slided', 'selectedSlide'], '.dataProduksiTabel' : ['selectedSlide', 'slided'], '.editProduksiContainer':['selectedSlide', 'slided']})">
                Tambah Data
            </div>
        </div>
        @endif
        <div class="container-fluid slided dataProduksiTabel p-3">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title text-dark">Tabel Data Neraca Produksi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="position:relative;">
                        <table id="nPTabel" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Jenis Kegiatan</th>
                                    <th>Neraca</th>
                                    <th>Kategori</th>
                                    <th>Kegiatan</th>
                                    <th>Total(Sample)</th>
                                    <th>Target(Sample)</th>
                                    <th>Keterangan</th>
                                    <th>TGL Mulai</th>
                                    <th>TGL Berakhir</th>
                                    @if($userRole == 'Admin')
                                    <th>Option</th>
                                    @endif
                                    <th>Data Lainnya</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($neraca->where('kategori_neraca_id', 1) as $data)
                                        <tr>
                                            <td>{{ $data->jenis_kegiatan }}</td>
                                            <td>{{ $data->nList->kategori_neraca }}</td>
                                            <td>{{ $data->kategori->kategori_kegiatan }}</td>
                                            <td>{{ $data->kegiatan }}</td>
                                            <td>{{ $data->total_sample }}</td>
                                            <td>{{ $data->target_sample }}</td>
                                            <td>{{ $data->keterangan }}</td>
                                            <td>{{ date_format(date_create($data->tanggal_mulai),"l, d-F-Y") }}</td>
                                            <td>{{ date_format(date_create($data->tanggal_berakhir),"l, d-F-Y") }}</td>
                                            @if($userRole == 'Admin')
                                            <td>
                                                <a href="updateDataProduksi{{ $data->id }}">
                                                    <img src="{{ asset('asset/img/edit.png') }}" alt="Edit Data" class="menuOption edit" width="25px" id="Data-{{ $data->id }}" style="cursor: pointer;">
                                                </a>
                                                
                                                <a href="deleteDataProduksi{{ $data->id }}" onclick="return confirm('Hapus?')">
                                                    <img src="{{ asset('asset/img/delete.png') }}" alt="Delete Data" class="menuOption delete" width="30px" id="Data-{{ $data->id }}">
                                                </a>
                                            </td>
                                            @endif
                                            <td>
                                                <table class="table table-bordered table-striped ">
                                                    <thead>
                                                        <tr>
                                                            <th>Kegiatan</th>
                                                            <th>Mulai</th>
                                                            <th>Berakhir</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($data->child as $child)
                                                    <tr>
                                                        <td style="color: black;">{{ " [ ".$child->kategori->kategori_kegiatan }}</td>
                                                        <td style="color: black;">{{ " ".date_format(date_create($child->start),"l, d-F-Y") ." "}}</td>
                                                        <td style="color: black;">{{ " ".date_format(date_create($child->end),"l, d-F-Y") ." ] " }}</td>
                                                    </tr> 
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Kegiatan</th>
                                                            <th>Mulai</th>
                                                            <th>Berakhir</th>
                                                        </tr>
                                                    </tfoot>
                                                    
                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Jenis Kegiatan</th>
                                    <th>Neraca</th>
                                    <th>Kategori</th>
                                    <th>Kegiatan</th>
                                    <th>Total(Sample)</th>
                                    <th>Target(Sample)</th>
                                    <th>Keterangan</th>
                                    <th>TGL Mulai</th>
                                    <th>TGL Berakhir</th>
                                    @if($userRole == 'Admin')
                                    <th>Option</th>
                                    @endif
                                    <th>Data Lainnya</th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid slided addProduksiContainer">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        <h1 class="m-0 h1 text-light">Tambah Data Neraca Produksi</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item active">Neraca produksi</li>
                        </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            {{-- main contet start --}}
            <div class="container-fluid">
                <div class="g-0 addFormContainer">
                    <form action="addProduksi" method="POST">
                        @csrf
                        <input type="hidden" name="nL" value="Produksi">
                        <div class="row">
                        <div class="col-8">
                            <label for="jenis_kegiatan" class="form-label">Jenis Kegiatan</label>
                            <input type="text" class="form-control" id="jenis_kegiatan" name="jenis_kegiatan" required>
                        </div>
                        <div class="col-4">
                            <label for="kategori_kegiatan" class="form-label">kategori</label>
                            <select class="form-select form-select-lg mb-3" id="kategori_kegiatan" name="kategori_kegiatan" required>
                            <option selected value="">Pilih Kategori Kegiatan</option>
                            @foreach($kategori as $value)
                            <option value="{{ $value->id }}">{{ $value->kategori_kegiatan }}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                <div class="col">
                                    <label for="kegiatan" class="form-label">Kegiatan</label>
                                    <input type="text" class="form-control" id="kegiatan" name="kegiatan" required>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="total_sampel" class="form-label">Total Sampel</label>
                                        <input type="number" class="form-control" id="total_sampel" name="total_sampel" value="0">
                                    </div>
                                    <div class="col-6">
                                        <label for="target_sampel" class="form-label">Target Sampel</label>
                                        <input type="number" class="form-control" id="target_sampel" name="target_sampel" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                <div class="col">
                                    <label for="tanggal_mulai">Tgl Mulai</label>
                                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col">
                                    <label for="tanggal_berakhir">Tgl Berakhir</label>
                                    <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir" required>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-floating">
                                <label for="keterangan">keterangan</label>
                                <textarea class="form-control" placeholder="......" id="keterangan" rows="4" name="keterangan" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center mt-3">
                                <p>Tambah Kegiatan lain untuk sesi ini</p>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center mb-3">
                            <div class="col-3 new_neraca_child">
                                <div class="row">
                                <div class="col d-flex justify-content-center">
                                    <input type="number" class="form-control d-inline-block child_repeat no-minusValue" placeholder="Berapa Form?">
                                </div>
                                </div>
                                <div class="row">
                                <div class="col d-flex justify-content-center">
                                    <button type="button" class="btn btn-light new_child_btn">Tambah</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        {{-- New Child --}}
                        <div class="row d-flex justify-content-center" id="new_child_here">
                        </div>
                        <div class="row mt-3">
                        <div class="col d-flex justify-content-center">
                            <button type="submit" class="btn btn-light">Submit Data</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if (session('idData'))
        <div class="container-fluid selectedSlide editProduksiContainer">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        <h1 class="m-0">Edit Data Neraca Produksi</h1>
                        </div>
                        <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item active">Neraca produksi</li>
                        </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="g-0 editFormContainer">
                    <form action="updateProduksi" method="POST">
                        @csrf
                        <div class="editContainerHere">
                            @foreach($neraca->where('id', session('idData')) as $data)
                            <input type='hidden' name='nL' value='Produksi'>
                            <input type='hidden' name='id' value='{{ $data->id }}'>
                            <div class='row'>
                            <div class='col-8'>
                                <label for='jenis_kegiatan' class='form-label'>Jenis Kegiatan</label>
                                <input type='text' class='form-control' id='jenis_kegiatan' name='jenis_kegiatan' value='{{ $data->jenis_kegiatan }}' required>
                            </div>
                            <div class='col-4'>
                                <label for='kategori_kegiatan' class='form-label'>kategori</label>
                                <select class='form-select form-select-lg mb-3' id='kategori_kegiatan' name='kategori_kegiatan' required>
                                @foreach($kategori as $value)
                                    @if($value->id == $data->kategori_id)
                                    <option selected value='{{ $value->id }}'>{{ $value->kategori_kegiatan }}</option>
                                    @else
                                    <option value='{{ $value->id }}'>{{ $value->kategori_kegiatan }}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                            </div>
                            <div class='row'>
                            <div class='col'>
                                <div class='row'>
                                <div class='col'>
                                    <label for='kegiatan' class='form-label'>Kegiatan</label>
                                    <input type='text' class='form-control' id='kegiatan' name='kegiatan' value='{{ $data->kegiatan }}' required>
                                </div>
                                </div>
                                <div class='row'>
                                <div class='col'>
                                    <label for='total_sampel' class='form-label'>Total Sampel</label>
                                    <input type='number' class='form-control' id='total_sampel' name='total_sampel' value='{{ $data->total_sample }}' value='0'>
                                </div>
                                </div>
                            </div>
                            <div class='col'>
                                <div class='row'>
                                <div class='col'>
                                    <label for='tanggal_mulai'>Tgl Mulai</label>
                                    <input type='date' class='form-control' id='tanggal_mulai' name='tanggal_mulai' value='{{ $data->tanggal_mulai }}' required>
                                </div>
                                </div>
                                <div class='row'>
                                <div class='col'>
                                    <label for='tanggal_berakhir'>Tgl Berakhir</label>
                                    <input type='date' class='form-control' id='tanggal_berakhir' name='tanggal_berakhir' value='{{ $data->tanggal_berakhir }}' required>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class='row'>
                            <div class='col'>
                                <div class='form-floating'>
                                <label for='keterangan'>keterangan</label>
                                <textarea class='form-control' id='keterangan' rows='4' name='keterangan' required>{{ $data->keterangan }}</textarea>
                                </div>
                            </div>
                            </div>
                            <div class='row'>
                            <div class='col-12 d-flex justify-content-center mt-3'>
                                <p>Kegiatan lain untuk data ini</p>
                            </div>
                            </div>
                            <div class='row d-flex justify-content-center mb-3'>
                                @foreach($data->child as $child)
                                    <div class='col-5 frame-child p-3 m-3'>
                                        <div class='row'>
                                            <div class='col'>
                                                <label for='child_kategori-kegiatan' class='form-label'>kategori</label>
                                                <select class='form-select form-select-lg mb-3' id='child_kategori-kegiatan' name='child_kategori_kegiatan[]' required>
                                                <option selected value=''>Pilih Kategori Kegiatan</option>
                                                @foreach($kategori as $value)
                                                    @if($value->id == $child->kategori_id)
                                                    <option selected value='{{ $value->id }}'>{{ $value->kategori_kegiatan }}</option>
                                                    @else
                                                    <option value='{{ $value->id }}'>{{ $value->kategori_kegiatan }}</option>
                                                    @endif
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col'>
                                            <label for='start'>Tgl Mulai</label>
                                            <input type='date' class='form-control' id='start' name='start[]' value='{{ $child->start }}' required>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col'>
                                            <label for='end'>Tgl Berakhir</label>
                                            <input type='date' class='form-control' id='end' name='end[]' value='{{ $child->end }}' required>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class='row mt-3'>
                                <div class='col d-flex justify-content-center'>
                                    <button type='submit' class='btn btn-light'>Submit Data</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </form>
                </div>      
            </div>
        </div>
        @endif
</div>


@if(session('success'))
<div class="infoOrStatus bg-success">
    <div class="massage-box">
        <ul>
        @foreach(session('success') as $msg)
            <li>{{ $msg }}</li>
        @endforeach
        </ul>
    </div>
</div>
@endif
@if($errors->any())
<div class="infoOrStatus bg-danger">
    <div class="massage-box">
        <ul>
        @foreach($errors->all() as $msg)
            <li>{{ $msg }}</li>
        @endforeach
        </ul>
    </div>
</div>
@endif
@endsection