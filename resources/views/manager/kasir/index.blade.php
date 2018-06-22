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
  <h2 class="page-head-title">Kasir</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Home</a></li>
    <li class="active">Kasir</li>
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
      Daftar Kasir
      <a href="{{ url('/manager/kasir/create') }}" class="btn btn-lg btn-success pull-right">Tambah</a>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table id="datatab" class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>No Hp</th>
            <th>Foto</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i = 1;
          @endphp
          @foreach($kasir as $itm)
            <tr>
              <td>{{$i}}</td>
              <td>{{$itm->name}}</td>
              <td>{{$itm->email}}</td>
              <td>{{$itm->alamat}}</td>
              <td>{{$itm->no_hp}}</td>
              <td><img src="{{$itm->foto}}" height="100"> </td>
              <td>
                <p class="text-right">
                  <a href="{{ url('/manager/kasir/'.$itm->id.'/edit') }}" class="btn btn-info"><span class="mdi mdi-edit"></span></a>
                  <a href="javascript:void(0);" data-url="{{ url('/manager/kasir/'.$itm->id) }}" data-toggle='modal' data-target='#modal-delete' class="btnDelete btn btn-danger"><span class="mdi mdi-delete"></span></a>

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
