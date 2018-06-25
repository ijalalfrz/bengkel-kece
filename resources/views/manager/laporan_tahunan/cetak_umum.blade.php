@extends('layouts.main')

@section('content')
<center>
  <h1>Laporan Tahunan</h1>
  <h4>PT. BENGKEL KECE</h4>
</center>
<hr>
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
<table class="table">
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
@endsection

@section('script')
<script type="text/javascript">
  $(function(){
    window.print();
    window.close();

  })
</script>
@endsection
