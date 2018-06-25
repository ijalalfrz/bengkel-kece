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
      Laporan Umum Bulanan Tahun {{$info['tgl_show']}}
      <a href="{{ url('manager/laporan_bulanan/'.$info['tgl_show'].'/khusus') }}" class="btn btn-success" target="_blank">Cetak</a>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <form method="POST" action="{{ url('/manager/laporan_bulanan') }}">
        @csrf
        <label>Pilih Tahun</label>
        <div class="form-group">
          <div class="row">
            <div class="col-md-2">
              <select name="year" class="form-control" required>
                <option disabled selected>Pilih tahun</option>
                @foreach ($info['years'] as $key=>$value)
                  @if ($value == $info['tgl_show'])
                    <option value="{{$value}}" selected>{{$value}}</option>
                  @else
                    <option value="{{$value}}">{{$value}}</option>
                  @endif
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
            <th>Bulan</th>
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

          @endphp
          @foreach ($data_all as $itm)
          <tr>
            <td> {{$i}} </td>
            <td> {{$itm['name']}}</td>   
            <td> {{$itm['service']}} </td>   
            <td> Rp {{number_format($itm['pend_service'], 0, '', '.')}} </td>   
            <td> {{$itm['part']}}</td>   
            <td> Rp {{number_format($itm['pend_part'], 0, '', '.')}}</td>   
            <td> {{$itm['total_transaksi']}} </td>   
            <td> Rp {{number_format($itm['total_harga'], 0, '', '.')}}</td>  
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