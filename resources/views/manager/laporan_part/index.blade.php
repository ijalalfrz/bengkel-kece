@extends('layouts.cms')

@section('content')
<div class="page-head">
	<h2 class="page=head-title">Laporan Part</h2>
	<ol class="breadcrumb page-head-nav">
		<li><a href="#">Home</a></li>
		<li class="active">Laporan Part</li>
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
      Laporan Penjualan Part
      <a href="{{ url('manager/laporan/umum') }}" class="btn btn-success" target="_blank">Cetak</a>
      <div class="clearfix"></div>
    </div>
	  <div class="panel-body">
	  	<table class="table" id="datatab">
	  		<thead>
	        <tr>
	          <th>No</th>
	          <th>Kode</th>
	          <th>Nama Part</th>
	          <th>Harga</th>
	          <th>Satuan</th>
	          <th>Stok</th>
	          <th>Jumlah Terjual</th>
	          <th>Pendapatan</th>
	        </tr>
	      </thead>
	      <tbody>
	      	@php
            $i = 1;
          @endphp
          @foreach ($data_part as $itm)
	      	<tr>
						<td> {{$i}} </td>	      		
						<td> {{$itm->kode}} </td>	      		
						<td> {{$itm->nama}} </td>	      		
						<td> {{$itm->harga}} </td>	      		
						<td> {{$itm->satuan}} </td>
						<td> </td>
						@foreach ($data_all as $element)
						@if ($element['id'] == $itm->id)
							@if ($element['status'] == 1)
						<td> {{$element['jumlah']}} </td>
						<td>Rp {{number_format($element['pend'], 0, '', '.')}}</td>
							@endif
						@endif
						@endforeach		
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
</script>
@endsection