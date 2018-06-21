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
      Laporan Umum
      <div class="clearfix"></div>
    </div>
  	<div class="panel-body">
    	<table class="table">
    		<tr>
    			<th>Jumlah Service Terlaksana</th>
    			<td>a</td>
    			<th>Jumlah Pendapatan Service</th>
    			<td>a</td>
    		</tr>
    		<tr>
    			<th>Jumlah Part Terjual</th>
    			<td>a</td>
    			<th>Jumlah Pendapatan Part</th>
    			<td>a</td>
    		</tr>
    		<tr>
    			<th>Total Pelanggan</th>
    			<td>a</td>
    			<th>Total Pendapatan</th>
    			<td>a</td>
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
            <th>Nama Pelanggan</th>
            <th>STNK</th>
            <th>Nama Montir</th>
            <th>Total Harga</th>
            <th>Jenis</th>
            <th></th>
          </tr>
          <tbody>
          	<tr>
          		
          	</tr>
          </tbody>
        </thead>
      </table>
    </div>
  </div>
</div>

@endsection

@section('script')

@endsection