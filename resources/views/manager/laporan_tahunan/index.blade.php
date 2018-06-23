@extends('layouts.cms')

@section('content')
<div class="page-head">
	<h2 class="page=head-title">Laporan Tahunan</h2>
	<ol class="breadcrumb page-head-nav">
		<li><a href="#">Home</a></li>
		<li class="active">Laporan Tahunan</li>
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
  		Laporan Umum Tahunan
    	<div class="clearfix"></div>
  	</div>
    <div class="panel-body">
    	<table class="table" id="datatab">
	    	<thead>
	        <tr>
	          <th>No</th>
	          <th>Tahun</th>
	          <th>Service terlaksana</th>
	          <th>Pendapatan service</th>
	          <th>Part terjual</th>
	          <th>Pendapatan penjualan part</th>
	          <th>Total transaksi</th>
	          <th>Total pendapatan</th>
	        </tr>
	      </thead>
	      <tbody>
	      	<tr>
	      		
	      	</tr>
    	</table>
    </div>
  </div>
  <div class="panel panel-default">
  	<div class="panel-heading">
  		Laporan Tahun {{$info['tgl_show']}}
    	<div class="clearfix"></div>
  	</div>
    <div class="panel-body">
      <form method="POST" action="{{ url('/manager/laporan_tahunan') }}">
      	@csrf
        <label>Pilih tahun</label>
        <div class="form-group">
          <div class="row">
            <div class="col-md-2">
              <select name="year" class="form-control" required>
                <option disabled selected value>Pilih tahun</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-space btn-primary btn-lg">Terapkan</button>  
            </div>
          </div>
        </div>
      </form>
      <table class="table">
        <tr>
          <th>Jumlah Service Terlaksana</th>
          <td> {{$info['service']}} </td>
          <th>Jumlah Pendapatan Service</th>
          <td>Rp {{number_format($info['pend_service'], 0, '', '.')}} </td>
        </tr>
        <tr>
          <th>Jumlah Part Terjual</th>
          <td> {{$info['part']}} </td>
          <th>Jumlah Pendapatan Penjualan Part</th>
          <td>Rp {{number_format($info['pend_part'], 0, '', '.')}} </td>
        </tr>
        <tr>
          <th>Total Transaksi</th>
          <td> {{$info['total_transaksi']}} </td>
          <th>Total Pendapatan</th>
          <td>Rp {{number_format($info['total'], 0, '', '.')}} </td>
        </tr>
    	</table>	
    </div>
    <div class="panel-heading panel-heading-divider">
    	Daftar Transaksi Tahun {{$info['tgl_show']}}
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
    	<table class="table" id="datatab">
	    	<thead>
	        <tr>
	          <th>No</th>
	          <th>Tanggal</th>
	          <th>Nama Pelanggan</th>
	          <th>STNK</th>
	          <th>Nama Montir</th>
	          <th>Total Harga</th>
	          <th>Jenis</th>
	        </tr>
	      </thead>
	      <tbody>
	      	@php
            $i = 1;
          @endphp
          @foreach($transaksi as $itm)
	      	<tr>
	      		<td>{{$i}}</td>
            <td>{{$itm->created_at->format('d M Y H:i:s')}}</td>
            <td>
              @if ($itm->id_pelanggan != null)
                {{$itm->pelanggan->nama}}
              @else
                UMUM
              @endif
            </td>
            <td>
              @if ($itm->id_pelanggan != null)
                {{$itm->pelanggan->no_kendaraan}}
              @endif
            </td>
            <td>
              @if ($itm->id_montir != null)
                {{$itm->montir->nama}}
              @endif
            </td>
            <td>Rp {{number_format($itm->total_harga, 0, '', '.')}}</td>
            <td>{{$itm->jenis}}</td>
	      	</tr>
	      </tbody>
	      	@php
              $i++;
            @endphp
          @endforeach
    	</table>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $(function(){
    $('#datatab').DataTable({
      'aoColumnDefs': [{
        'bSortable': false,
        'aTargets': [-1, -1] /* 1st one, start by the right */
      }]
    });
    $('.btnDelete').click(function(){
      var url = $(this).data('url');
      $('#modal-delete').find('form').attr('action', url);
    });

    $('.btnStok').click(function(){
      var url = $(this).data('url');
      var stok = $(this).data('stok');
      $('#modal-stok').find('form').attr('action', url);
      $('#modal-stok').find('input').val(stok);
    });
  });
</script>
@endsection
