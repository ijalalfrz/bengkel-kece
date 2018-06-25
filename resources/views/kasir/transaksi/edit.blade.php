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
                  <option value="{{$data->id}}">{{$data->kode}} - {{$data->nama}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="xs-mt-20">

            <button type="button" data-dismiss="modal" class="btn btn-lg btn-space btn-success btnTambahService">Tambah</button>
            <button type="button" data-dismiss="modal" class="btn btn-lg btn-space btn-default">Batal</button>
          </div>
        </div>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>

<div class="main-content container-fluid">
  @if($errors->any())
    <div role="alert" class="alert alert-danger alert-dismissible">
      <button type="button" data-dismiss="alert" aria-label="Close" class="close">
      <span aria-hidden="true" class="mdi mdi-close"></span></button>
      @foreach($errors->all() as $this_error)
          <p>{{$this_error}}</p>
      @endforeach
    </div>
  @endif
  <form action="{{ url('kasir/transaksi/'.$transaksi->id) }}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="PATCH">
    <div class="panel">
      <div class="panel-heading panel-heading-divider">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label><b>No Transaksi</b></label>
              <h2>{{$transaksi->id}}</h2>
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
              <select readonly class="form-control" name="jenis" id="jenis">
                <option {{$transaksi->jenis=='beli'?'selected':''}} value="beli">Pembelian Part</option>
                <option {{$transaksi->jenis=='service'?'selected':''}} value="service">Jasa Service</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Pelanggan</label>
              <select disabled class="select2" name="id_pelanggan">
                <option></option>
                @foreach($pelanggan as $data)
                <option {{$transaksi->id_pelanggan==$data->id?'selected':''}} value="{{$data->id}}">{{$data->nama}}</option>
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
                <option {{$transaksi->id_montir==$data->id?'selected':''}} value="{{$data->id}}">{{$data->nama}}</option>
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
          @php
            $total_sparepart = 0;
            $total_service = 0;
          @endphp
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
            @if($transaksi->detailPart()->count()>0)

              @foreach($transaksi->detailPart as $data)
                @php
                  $total_sparepart += $data->total_harga;
                @endphp

                <tr>
                  <td>{{$data->part->kode}} - {{$data->part->nama}}</td>
                  <td>{{(int) $data->harga_jual}}</td>
                  <td>{{$data->jumlah}}</td>
                  <td>{{$data->total_harga}}</td>
                  <td>
                    <input type="hidden" class="total_harga_part" value="{{$data->total_harga}}">
                    <button type='button' data-jenis='part' data-id="{{$data->id}}" class='btn pull-right btn-danger btnHapus'>Hapus</button>

                  </td>
                </tr>
              @endforeach
            @endif

            </tbody>

          </table>
          <h3>TOTAL SPAREPART : Rp. <span class="total_sparepart">{{number_format($total_sparepart, 0, '', '.')}}</span></h3>
        </div>
        <br>
        <hr>
        <br>

        @php
          $none = "";
          if($transaksi->jenis=='beli'){
            $none = "display:none";
          }
        @endphp
        <div id="service" style="{{$none}}">
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
            <tbody class="service-table-body">
              @if($transaksi->detailService()->count()>0)

                @foreach($transaksi->detailService as $data)
                  @php
                    $total_service += $data->harga_jual;
                  @endphp

                  <tr>
                    <td>{{$data->service->kode}} - {{$data->service->nama}}</td>
                    <td>{{(int) $data->harga_jual}}</td>
                    <td>{{(int) $data->harga_jual}}</td>
                    <td>
                      <input type="hidden" class="harga_jual_service" value="{{$data->harga_jual}}">
                      <button type='button' data-jenis='service' data-id="{{$data->id}}" class='btn pull-right btn-danger btnHapus'>Hapus</button>

                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
          <h3>TOTAL SERVICE : Rp. <span class="total_service">{{number_format($total_service, 0, '', '.')}}</span></h3>
        </div>

        <br>
        <hr>
        @php
          $total_grand = $total_sparepart + $total_service;
        @endphp
        <h3>TOTAL : Rp. <span class="total_grand">{{number_format($total_grand, 0, '', '.')}}</span></h3>
        <br>
        <div class="deleted">
        </div>
        <div>

          <input type="hidden" name="total_grand" value="{{$total_grand}}">
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
                <input type='hidden' name='id_part[]' value='${data.id}'>
                <input type='hidden' name='harga_jual[]' value='${harga}'>
                <input type='hidden' name='jumlah[]' value='${jum}'>
                <input type='hidden' class='total_harga_part' name='total_harga[]' value='${sub}'>
                <button type='button' class='btn pull-right btn-danger btnHapus'>Hapus</button>
              </td>
            </tr>
          `);

        }
        countPrice();

      }).fail(function(){

      });
    });

    $('.btnTambahService').click(function(){
      var id_service = $('.id_service').val();

      $.get(`{{ url('kasir/transaksi/service/') }}/${id_service}`, function(data){

      }).done(function(data,xhr){

        if(data){
          jumPart++;
          var harga = parseInt(data.harga_jual);
          $('.service-table-body').append(`
            <tr>
              <td>${data.kode} - ${data.nama}</td>
              <td>${harga}</td>
              <td>${harga}</td>
              <td>
                <input type='hidden' name='id_service[]' value='${data.id}'>
                <input type='hidden' class='harga_jual_service' name='harga_jual_service[]' value='${harga}'>
                <input type='hidden' name='total_harga_service[]' value='${harga}'>
                <button type='button' class='btn pull-right btn-danger btnHapus'>Hapus</button>
              </td>
            </tr>
          `);

        }
        countPrice();

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
        countPrice();
      }else{
        $("#service").slideDown();
        $('select[name=id_pelanggan]').removeAttr('disabled');
        $('select[name=id_montir]').removeAttr('disabled');
        $('select[name=id_pelanggan]').attr('required','');
        $('select[name=id_montir]').attr('required','');
        countPrice();
      }
    });
  });

  function countPrice() {
    var total = 0;
    var total_service = 0;
    $('.total_harga_part').each(function(i,el){
      total += parseInt($(el).val());
    });
    $(".total_sparepart").html(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
    if($('#jenis').val()=="service"){
      total_service=0;
      $('.harga_jual_service').each(function(i,el){
        total_service += parseInt($(el).val());
      });
      $(".total_service").html(total_service.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
    }
    var total_grand = total + total_service;
    $(".total_grand").html(total_grand.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

    $("input[name=total_grand]").val(total_grand);
  }

  $(document).on('click','.btnHapus', function(){
    $(this).parents('tr').remove();
    countPrice();
    var id = $(this).data('id');
    var jenis = $(this).data('jenis');
    if(jenis=='part'){
      $('.deleted').append(`<input type='hidden' name='deleted_part[]' value='${id}'>`);
    }else{
      $('.deleted').append(`<input type='hidden' name='deleted_service[]' value='${id}'>`);
    }
  });
</script>
@endsection
