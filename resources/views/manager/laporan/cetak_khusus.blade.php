@extends('layouts.main')

@section('content')
<center>
  <h1>Laporan Umum Tanggal {{$info['tgl_show']}}</h1>
  <h4>PT. BENGKEL KECE</h4>
</center>
<hr>
<div class="panel-body">
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
 	    <td>Rp {{number_format($info['total'], 0, '', '.')}}</td>
 	  </tr>
	</table>
</div>
<div class="panel-heading panel-heading-divider">
  Daftar Transaksi Tanggal {{$info['tgl_show']}}
  <div class="clearfix"></div>
</div>
<div class="panel-body">
  <table id="datatab" class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Waktu</th>
        <th>Nama Pelanggan</th>
        <th>STNK</th>
        <th>Nama Montir</th>
        <th>Total Harga</th>
        <th>Jenis</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @php
        $i = 1;
      @endphp
      @foreach($transaksi as $itm)
      <tr>
        <td>{{$i}}</td>
        <td>{{$itm->created_at->format('H:i:s')}}</td>
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
        <td>{{$itm->status}}</td>
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
  })
</script>
@endsection
