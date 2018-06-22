

@extends('layouts.cms')

@section('content')
<div class="page-head">
	<h2 class="page=head-title">Laporan</h2>
	<ol class="breadcrumb page-head-nav">
		<li><a href="#">Home</a></li>
		<li class="active">Laporan</li>
	</ol>	
</div>

<div class="main-content container-fluid">
	@if(\Session::has('msg'))
    <div role="alert" class="alert alert-success alert-dismissible">
      <button type="button" data-dismiss="alert" aria-label="Close" class="close">
      <span aria-hidden="true" class="mdi mdi-close"></span></button>
      <span>{{ \Session::get('msg') }}</span>
    </div>
  @endif
  <div class="panel panel-default">   
  	<div class="panel-heading">
      Laporan Umum Per Hari
      <div class="clearfix"></div>
    </div>
      
    <div class="panel-body">
      <form method="POST" action="{{ url('/manager/laporan') }}">
        @csrf
        <label>Pilih tanggal</label>
          <div class="form-group">
            <div class="row">
              <div class="col-md-3">
                <input class="form-control" type="date" name="tgl" required value="{{ $tgl }}">
              </div>
              <div class="col-md-3">
                <button type="submit" class="btn btn-space btn-primary btn-lg">Terapkan</button>  
              </div>
            </div>
          </div>
      </form>
      <table class="table">
    		<tr>
    			<th>Jumlah Service Terlaksana</th>
    			<td> {{$service}} </td>
    			<th>Jumlah Pendapatan Service</th>
    			<td>Rp {{number_format($pend_service, 0, '', '.')}} </td>
    		</tr>
    		<tr>
    			<th>Jumlah Part Terjual</th>
    			<td> {{$part}} </td>
    			<th>Jumlah Pendapatan Part</th>
    			<td>Rp {{number_format($pend_part, 0, '', '.')}} </td>
    		</tr>
    		<tr>
    			<th>Total Pelanggan</th>
    			<td></td>
    			<th>Total Pendapatan</th>
    			<td>Rp {{number_format($total, 0, '', '.')}}</td>
    		</tr>
    	</table>	
  	</div>
    <div class="panel-heading panel-heading-divider">
      Daftar Transaksi
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Waktu</th>
            <th>Nama Pelanggan</th>
            <th>STNK</th>
            <th>Nama Montir</th>
            <th>Total Harga</th>
            <th>Jenis</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i = 1;
          @endphp
          @foreach($transaksi as $itm)
          <tr>
            <td>{{$i}}</td>
            <td>{{$itm->created_at->format('H:i:s')}}</td>
            <td>{{$itm->pelanggan->nama}}</td>
            <td>{{$itm->pelanggan->no_kendaraan}}</td>
            <td>{{$itm->montir->nama}}</td>
            <td>Rp {{number_format($itm->total_harga, 0, '', '.')}}</td>
            <td>{{$itm->jenis}}</td>
          </tr>
            @php
              $i++;
            @endphp
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection

@section('script')

@endsection