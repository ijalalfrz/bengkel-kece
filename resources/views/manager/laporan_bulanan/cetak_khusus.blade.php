@extends('layouts.main')

@section('content')
<center>
  <h1>Laporan Bulanan Tahun {{$info['tgl_show']}}</h1>
  <h4>PT. BENGKEL KECE</h4>
</center>
<hr>
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
@endsection


@section('script')
<script type="text/javascript">
  $(function(){
    window.print();
    window.close();

  })
</script>
@endsection
