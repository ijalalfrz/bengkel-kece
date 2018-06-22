

@extends('layouts.cms')

@section('content')
<div class="page-head">
	<h2 class="page=head-title">Laporan Bulanan</h2>
	<ol class="breadcrumb page-head-nav">
		<li><a href="#">Home</a></li>
		<li class="active">Laporan Bulanan</li>
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
      Laporan Umum Bulan {{$info['tgl_show']}}
      <div class="clearfix"></div>
    </div>
      
    <div class="panel-body">
      <form method="POST" action="{{ url('/manager/laporan_bulanan') }}">
        @csrf
        <label>Pilih bulan</label>
          <div class="form-group">
            <div class="row">
              <div class="col-md-2">
                {{-- <input class="form-control" type="date" name="tgl" required value="{{ $info['tgl'] }}"> --}}
                <select name="month" class="form-control" required>
                  <option disabled selected value>Pilih bulan</option>
                  <option value="1">Januari</option>
                  <option value="2">Februari</option>
                  <option value="3">Maret</option>
                  <option value="4">April</option>
                  <option value="5">Mei</option>
                  <option value="6">Juni</option>
                  <option value="7">Juli</option>
                  <option value="8">Agustus</option>
                  <option value="9">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">Nopember</option>
                  <option value="12">Desember</option> 
                </select>
              </div>
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
          <td> {{$info['service']}} </td>
          <th>Jumlah Pendapatan Penjualan Part</th>
          <td>Rp {{number_format($info['pend_part'], 0, '', '.')}} </td>
        </tr>
        <tr>
          <th>Total Pelanggan</th>
          <td></td>
          <th>Total Pendapatan</th>
          <td>Rp {{number_format($info['total'], 0, '', '.')}}</td>
        </tr>
    	</table>	
  	</div>
    <div class="panel-heading panel-heading-divider">
      Daftar Transaksi Bulan {{$info['tgl_show']}}
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table id="datatab" class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Waktu</th>
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