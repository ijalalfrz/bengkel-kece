@extends('layouts.cms-kasir')

@section('content')


<div id="mod-cancel" role="dialog" style="display: none;" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
      </div>
      <div class="modal-body">
        <div class="err">
        </div>
        <form method="POST" ">
          @csrf
          <div class="text-center">

            <h3>Request Pembatalan</h3>
            <hr>
            <div class="form-group">
              <label>Alasan</label>
              <input type="text" name="alasan" class="form-control" required>
            </div>
            <div class="xs-mt-20">


              <button type="submit" class="btn btn-lg btn-space btn-success ">Submit</button>
              <button type="button" data-dismiss="modal" class="btn btn-lg btn-space btn-default">Batal</button>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>


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
                <p class="text-center">
                  @if($itm->status != 'cancel_request')
                    <a href="{{ url('kasir/transaksi/'.$itm->id.'/done') }}" class="btn btn-success" target="_blank">Cetak Invoice</a>
                    <button data-toggle="modal" data-target="#mod-cancel" type="button"  data-url="{{ url('kasir/transaksi/'.$itm->id.'/cancel') }}" class="btn btn-warning btnCancel" >Batal Post</button>
                  @else
                    <span><b>Menunggu approval</b></span>
                  @endif
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

    $('.btnCancel').click(function(){
      var url = $(this).data('url');
      $('#mod-cancel').find('form').attr('action', url);

    });
  });
</script>
@endsection
