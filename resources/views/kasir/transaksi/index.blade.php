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
                  <option value="{{$data->id}}">{{$data->kode}} - {{$data->nama}}</option>
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

<div id="mod-service" role="dialog" style="display: none;" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <h3>Tambah Service</h3>
          <hr>
          <div class="row">
            <div class="col-md-12">

              <div class="form-group">
                <select class="id_service">
                  <option>Pilih Service</option>
                  @foreach($service as $data)
                  <option value="{{$data->id}}">{{$data->nama}}</option>
                  @endforeach
                </select>
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
  <form action="{{ url('kasir/transaksi') }}" method="POST">
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
              <select disabled class="select2" name="id_pelanggan">
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
              <select disabled class="select2" name="id_montir">
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
                {{-- <th>No</th> --}}
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
          <h3>TOTAL SPAREPART : Rp. <span class="total_sparepart"></span></h3>
        </div>
        <br>
        <hr>
        <br>
        <div style="display: none;" id="service">
          <h1>
            SERVICE
            <button style="float: right;" data-toggle="modal" data-target="#mod-service" type="button" class="btn btn-lg btn-space btn-success btnModalService">Tambah Service</button>

          </h1>
           <table class="table table-striped table-borderless">
            <thead>
              <tr>
                {{-- <th>No</th> --}}
                <th>Nama</th>
                <th>Harga Jasa</th>
                <th>Sub Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody class="part-table-body">

            </tbody>
          </table>
          <h3>TOTAL SERVICE : Rp. <span class="total_sparepart"></span></h3>
        </div>

        <br>
        <hr>
        <h3>TOTAL : Rp. <span class="total_sparepart"></span></h3>
        <br>
        <div>
          <button type="submit" class="btn-full btn-primary">Simpan</button>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>

  </form>
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

    $('.btnModalService').click(function(){
      $(".id_service").select2().val("Pilih Service").trigger("change");
      $(".id_service").select2({
        placeholder: "Pilih Service",
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
              <td>${data.kode} - ${data.nama}</td>
              <td>${harga}</td>
              <td>${jum}</td>
              <td>${sub}</td>
              <td>
                <input type='hidden' name='id_part' value='${data.id}'>
                <input type='hidden' name='harga_jual' value='${harga}'>
                <input type='hidden' name='jumlah' value='${jum}'>
                <input type='hidden' name='total_harga' value='${sub}'>
                <button type='button' class='btn btn-danger btnHapus'>Hapus</button
              </td>
            </tr>
          `);

        }
        countSparepart();

      }).fail(function(){

      });
    });
    $("#jenis").change(function(){
      var val = $(this).val();
      if(val=="beli"){
        $("#service").slideUp();
        $('select[name=id_pelanggan]').attr('disabled','');
        $('select[name=id_montir]').attr('disabled','');
        $('select[name=id_pelanggan]').removeAttr('required');
        $('select[name=id_montir]').removeAttr('required');
      }else{
        $("#service").slideDown();
        $('select[name=id_pelanggan]').removeAttr('disabled');
        $('select[name=id_montir]').removeAttr('disabled');
        $('select[name=id_pelanggan]').attr('required','');
        $('select[name=id_montir]').attr('required','');
      }
    });
  });

  function countSparepart() {
    var total = 0;
    $('input[name=harga_jual]').each(function(i,el){
      total += parseInt($(el).val());
    });
    $(".total_sparepart").html(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
  }

  $(document).on('click','.btnHapus', function(){
    $(this).parents('tr').remove();
    countSparepart();

  });
</script>
@endsection
