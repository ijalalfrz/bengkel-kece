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
  @if ($data_all != null)
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
          @php
            $i = 1;
          @endphp
          @foreach ($data_all as $itm)
          <tr>
            <td> {{$i}} </td>
            <td> {{$itm['name']}}</td>   
            <td> {{$itm['service']}}</td>   
            <td> Rp {{number_format($itm['pend_service'], 0, '', '.')}}</td>   
            <td> {{$itm['part']}}</td>   
            <td> Rp {{number_format($itm['pend_part'], 0, '', '.')}}</td>   
            <td> {{$itm['total_transaksi']}}</td>   
            <td> Rp {{number_format($itm['total'], 0, '', '.')}}</td>   
          </tr>
          @php
            $i++;
          @endphp
          @endforeach
        </tbody>
    	</table>
    </div>
  </div>
  @endif
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
                @foreach ($data_all as $itm)
                  <option value="{{$itm['name']}}">{{$itm['name']}}</option>
                @endforeach
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
      <table id="datatab2" class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Pelanggan</th>
            <th>Nomor STNK</th>
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
              <td>{{$itm->created_at}}</td>
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
              <td>
                <p class="text-right">
                  <a href="javascript:void(0);" data-url="{{ url('/manager/transaksi/'.$itm->id) }}" data-toggle='modal' data-target='#modal-delete' class="btnDelete btn btn-danger"><span class="mdi mdi-delete"></span></a>

                </p>
              </td>
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
    $('#datatab').DataTable({});
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

  $(function(){
    $('#datatab2').DataTable({});
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
