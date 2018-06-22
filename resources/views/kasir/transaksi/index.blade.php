@extends('layouts.cms-kasir')
@section('content')

{{-- <div class="page-head">
  <h2 class="page-head-title">Transaksi</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Home</a></li>
    <li class="active">Transaksi</li>
  </ol>
</div> --}}

<div id="mod-sparepart" role="dialog" style="display: none;" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <h3>Tambah Sparepart</h3>
          <hr>
          <div class="row">
            <div class="col-md-8">

              <div class="form-group">
                <select class="id_part">
                  <option>Pilih Part</option>

                  @foreach($part as $data)
                  <option value="{{$data->id}}">{{$data->nama}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="number" class="qty_part form-control" placeholder="Qty">
              </div>
            </div>
          </div>
          <div class="xs-mt-20">

            <button type="button" data-dismiss="modal" class="btn btn-lg btn-space btn-success btnTambahPart">Tambah</button>
            <button type="button" data-dismiss="modal" class="btn btn-lg btn-space btn-default">Batal</button>
          </div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<div class="main-content container-fluid">
  <div class="panel">
    <div class="panel-heading panel-heading-divider">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label><b>No Transaksi</b></label>
            <h2>1</h2>
          </div>

        </div>
        <div class="col-md-4">
          <label><b>Tanggal</b></label>
          <h2>{{date("d, M Y")}}</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Jenis Transaksi</label>
            <select class="form-control" name="jenis" id="jenis">
              <option value="beli">Pembelian Part</option>
              <option value="service">Jasa Service</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Pelanggan</label>
            <select class="select2" name="id_pelanggan">
              <option></option>
              @foreach($pelanggan as $data)
              <option value="{{$data->id}}">{{$data->nama}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Montir</label>
            <select class="select2" name="id_montir">
              <option></option>
              @foreach($montir as $data)
              <option value="{{$data->id}}">{{$data->nama}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="panel-body">
      <div id="sparepart">
        <div>
          <h1>
            SPAREPART
            <button style="float: right;" data-toggle="modal" data-target="#mod-sparepart" type="button" class="btn btn-lg btn-space btn-success btnModalPart">Tambah Sparepart</button>
          </h1>
        </div>
        <table class="table table-striped table-borderless">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Harga Satuan</th>
              <th>Jumlah</th>
              <th>Sub Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="part-table-body">

          </tbody>
        </table>
        <h3>TOTAL SPARPART : <span class="total_sparepart"></span></h3>
      </div>
      <hr>
      <div style="display: none;" id="service">
        <h1>SERVICE</h1>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  $(function(){
    var jumPart = 0;
    $('.btnModalPart').click(function(){
      $('.qty_part').val(1);
      $(".id_part").select2().val("Pilih Part").trigger("change");
      $(".id_part").select2({
        placeholder: "Pilih Part",
        width: '100%'
      });
    });

    $('.btnTambahPart').click(function(){
      var id_part = $('.id_part').val();
      var jum = $('.qty_part').val();

      $.get(`{{ url('kasir/transaksi/part/') }}/${id_part}`, function(data){

      }).done(function(data,xhr){

        if(data){
          jumPart++;
          var harga = parseInt(data.harga);
          var sub = jum*harga;
          $('.part-table-body').append(`
            <tr>
              <td></td>
              <td>${data.nama}</td>
              <td>${harga}</td>
              <td>${jum}</td>
              <td>${sub}</td>
              <td>
                <button type='button' class='btn btn-danger'>Hapus</button
              </td>
            </tr>
          `);
        }
      }).fail(function(){

      });
    });
    $("#jenis").change(function(){
      var val = $(this).val();
      if(val=="beli"){
        $("#service").slideUp();
      }else{
        $("#service").slideDown();
      }
    });
  })
</script>
@endsection
