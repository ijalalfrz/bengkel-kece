@extends('layouts.main')

@section('content')
<center>
  <h1>Laporan Tanggal {{$infos['oldest_show']}} - {{$infos['newest_show']}} </h1>
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
      <th>Jumlah Part Terjual</th>
      <td> {{$grand_info['part']}} </td>
      <th>Jumlah Pendapatan Penjualan Part</th>
      <td>Rp {{number_format($grand_info['pend_part'], 0, '', '.')}} </td>
    </tr>
    <tr>
      <th>Total Transaksi</th>
      <td> {{$grand_info['total_transaksi']}} </td>
      <th>Total Pendapatan</th>
      <td>Rp {{number_format($grand_info['total'], 0, '', '.')}}</td>
    </tr>
  </table>
</div>
<hr>
<div class="panel-heading panel-heading-divider">
  Daftar Transaksi Tanggal {{$infos['oldest_show']}} - {{$infos['newest_show']}}
  <div class="clearfix"></div>
</div>
<table class="table">
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
@endsection

@section('script')
<script type="text/javascript">
  $(function(){
    window.print();
    window.location.href = '{{ url('/kasir/laporan') }}';

  })
</script>
@endsection
