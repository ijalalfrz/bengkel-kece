@extends('layouts.main')

@section('content')
<center>
  <h1>Laporan Penjualan Part</h1>
  <h4>PT. BENGKEL KECE</h4>
</center>
<hr>
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
      <td> {{$itm->stok}} </td>
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
@endsection

@section('script')
<script type="text/javascript">
  $(function(){
    window.print();
    window.close();

  })
</script>
@endsection
