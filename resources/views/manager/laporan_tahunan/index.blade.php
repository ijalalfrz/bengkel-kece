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
      <a href="{{ url('manager/laporan_tahunan/umum') }}" class="btn btn-success" target="_blank">Cetak</a>
    	<div class="clearfix"></div>
  	</div>
    <div class="panel-body">
      <table class="table">
        <tr>
          <th>Jumlah Service Terlaksana</th>
          <td> {{$grand_info['service']}} </td>
          <th>Jumlah Pendapatan Service</th>
          <td>Rp {{number_format($grand_info['pend_service'], 0, '', '.')}} </td>
        </tr>
        <tr>
          <th>Jumlah Pembelian Terlaksana</th>
          <td> {{$grand_info['part']}} </td>
          <th>Jumlah Pendapatan Pembelian</th>
          <td>Rp {{number_format($grand_info['pend_part'], 0, '', '.')}} </td>
        </tr>
        <tr>
          <th>Jumlah Transaksi</th>
          <td> {{$grand_info['total_transaksi']}} </td>
          <th>Total Pendapatan</th>
          <td>Rp {{number_format($grand_info['total_harga'], 0, '', '.')}}</td>
        </tr>
      </table>
    	<table class="table" id="datatab">
	    	<thead>
	        <tr>
	          <th>No</th>
	          <th>Tahun</th>
	          <th>Jumlah jasa service</th>
            <th>Pendapatan jasa service</th>
            <th>Jumlah pembelian</th>
            <th>Pendapatan pembelian</th>
            <th>Jumlah transaksi</th>
            <th>Total pendapatan</th>
	        </tr>
	      </thead>
	      <tbody>
          @php
            $i = 1;
            $data_all = collect($data_all)->sortBy('name')->reverse()->toArray();
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

</script>
@endsection
