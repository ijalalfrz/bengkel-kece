@extends('layouts.cms-kasir')

@section('content')

<div class="page-head">
  <h2 class="page-head-title">Laporan</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Home</a></li>
    <li class="active">Laporan</li>
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
      Daftar Transaksi
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table id="datatab" class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Pelanggan</th>
            <th>Nomor STNK</th>
            <th>Nama Montir</th>
            <th>Total Harga</th>
            <th>Jenis</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i = 1;
          @endphp
          @foreach($transaksi as $itm)
            <tr>
              <td>{{$i}}</td>
              <td>{{$itm->created_at}}</td>
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
              <td>{{$itm->total_harga}}</td>
              <td>{{$itm->jenis}}</td>
              <td> {{$itm->status}} </td>
              
              <td>
                <p class="text-right">
                  <a href="{{ url('kasir/transaksi/'.$itm->id.'/done') }}" class="btn btn-success" target="_blank">Cetak Invoice</a>

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