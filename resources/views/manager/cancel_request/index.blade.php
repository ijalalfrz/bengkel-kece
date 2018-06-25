@extends('layouts.cms')

@section('content')
<div id="modal-delete" tabindex="-1" role="dialog" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
          <h3>Perhatian!</h3>
          <p>Apakah anda yakin menghapus data ini?</p>
          <div class="xs-mt-50">
            <form method="POST" >
              @csrf
              <input type="hidden" name="_method" value="DELETE" >
              <button type="submit"  class="btn btn-space btn-danger">Ya</button>
              <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Tidak</button>

            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<div class="page-head">
  <h2 class="page-head-title">Cancel Request Transaksi</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Home</a></li>
    <li class="active">Cancel Request Transaksi</li>
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
      Daftar Cancel Request Transaksi
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table id="datatab" class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Kasir</th>
            <th>Transaksi Milik</th>
            <th>Total Harga</th>
            <th>Alasan Cancel</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i = 1;
          @endphp
          @foreach($cancel as $itm)
            <tr>
              <td>{{$i}}</td>
              <td>{{$itm->kasir->name}}</td>
              <td>{{$itm->transaksi->id_pelanggan==null?'UMUM':$itm->transaksi->pelanggan->nama}}</td>
              <td>Rp {{number_format($itm->transaksi->total_harga, 0, '', '.')}}</td>
              <td>{{$itm->alasan}}</td>
              <td>
                @if($itm->status==null)
                <p class="text-right">
                  <a href="{{ url('/manager/cancel_request/'.$itm->id.'/approve') }}" class="btn btn-success">Setuju</a>
                  <a href="{{ url('/manager/cancel_request/'.$itm->id.'/deny') }}" class="btn btn-danger">Tolak</a>
                </p>
                @elseif($itm->status=='disetujui')
                  <b>Disetujui</b>
                @else
                  <b>Ditolak</b>
                @endif
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

  });
</script>
@endsection
