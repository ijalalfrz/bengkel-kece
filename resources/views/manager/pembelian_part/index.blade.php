@extends('layouts.cms')

@section('content')
<div class="page-head">
	<h2 class="page=head-title">Pembelian Part</h2>
	<ol class="breadcrumb page-head-nav">
		<li><a href="#">Home</a></li>
		<li class="active">Pembelian Part</li>
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
  	<div class="panel-heading panel-heading-divider">
      Daftar Pembelian Part
      <a href="{{ url('/manager/pembelian_part/create') }}" class="btn btn-lg btn-success pull-right">Tambah</a>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table id="datatab" class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Part</th>
            <th>Nama Part</th>
            <th>Tanggal Beli</th>
            <th>Satuan</th>
            <th>Harga Satuan</th>
            <th>Jumlah</th>
            <th>Stok Awal</th>
            <th>Stok Akhir</th>
            <th>Supplier</th>
            <th>Total Harga</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i = 1;
          @endphp
          @foreach ($data as $itm)
            <tr>
              <td> {{$i}} </td>
              <td> {{$itm->part->kode}} </td>
              <td> {{$itm->part->nama}} </td>
              <td> {{$itm->created_at}} </td>
              <td> {{$itm->satuan}} </td>
              <td>Rp {{number_format($itm->harga, 0, '', '.')}}</td>
              <td> {{$itm->jumlah}} </td>
              <td> {{$itm->stok_awal}} </td>
              <td> {{$itm->stok_akhir}} </td>
              <td> {{$itm->supplier}} </td>
              <td>Rp {{number_format($itm->total_harga, 0, '', '.')}} </td>
              <td>
                <p class="text-right">
                  <a href="{{ url('/manager/pembelian_part/'.$itm->id.'/edit') }}" class="btn btn-info"><span class="mdi mdi-edit"></span></a>
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