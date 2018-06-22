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

<div id="modal-stok" tabindex="-1" role="dialog" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <h3>Tambah Stok</h3>
          <div class="xs-mt-50">
            <form method="POST" >
              @csrf
              <input type="hidden" name="_method" value="PUT" >
              <div class="text-center">
                <label><strong>Nomor Part</strong></label>

                <input type="number" name="nomor_part" class="form-control">
              </div>
              <br>
              <button type="submit"  class="btn btn-lg btn-space btn-info">Simpan</button>

            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<div class="page-head">
  <h2 class="page-head-title">Sparepart</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Home</a></li>
    <li class="active">Sparepart</li>
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
      Daftar Sparepart
      <a href="{{ url('/manager/sparepart/create') }}" class="btn btn-lg btn-success pull-right">Tambah</a>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table id="datatab" class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Satuan</th>
            <th>Harga Satuan</th>
            <th>Stok</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i = 1;
          @endphp
          @foreach($part as $itm)
            <tr>
              <td>{{$i}}</td>
              <td>{{$itm->nama}}</td>
              <td>{{$itm->satuan}}</td>
              <td>Rp {{number_format($itm->harga, 0, '', '.')}}</td>
              <td>{{ $itm->detail()->count() }}</td>
              <td>
                <p class="text-right">
                  <a href="javascript:void(0);" data-url="{{ url('/manager/sparepart/'.$itm->id.'/stok') }}" title="Ganti Stok" data-toggle='modal' data-target='#modal-stok' class="btnStok btn btn-success"><span class="mdi mdi-plus"></span></a>
                  <a href="{{ url('/manager/sparepart/'.$itm->id.'/edit') }}" class="btn btn-info"><span class="mdi mdi-edit"></span></a>
                  <a href="javascript:void(0);" data-url="{{ url('/manager/sparepart/'.$itm->id) }}" data-toggle='modal' data-target='#modal-delete' class="btnDelete btn btn-danger"><span class="mdi mdi-delete"></span></a>

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
      $('#modal-stok').find('form').attr('action', url);
    });
  });
</script>
@endsection
