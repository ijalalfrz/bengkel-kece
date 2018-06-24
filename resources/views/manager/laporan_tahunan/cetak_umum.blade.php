@extends('layouts.main')

@section('content')
<center>
  <h1>Laporan Tahunan</h1>
  <h4>PT. BENGKEL KECE</h4>
</center>
<hr>
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
  })
</script>
@endsection
