@extends('layouts.cms-kasir')
@section('content')

<div class="main-content container-fluid">
  @if(\Session::has('msg'))
    <div role="alert" class="alert alert-success alert-dismissible">
      <button type="button" data-dismiss="alert" aria-label="Close" class="close">
      <span aria-hidden="true" class="mdi mdi-close"></span></button>
      <span>{{ \Session::get('msg') }}</span>
    </div>
  @endif

  @if($errors->any())
    <div role="alert" class="alert alert-danger alert-dismissible">
      <button type="button" data-dismiss="alert" aria-label="Close" class="close">
      <span aria-hidden="true" class="mdi mdi-close"></span></button>
      @foreach($errors->all() as $this_error)
          <p>{{$this_error}}</p>
      @endforeach
    </div>
  @endif
  <div class="panel panel-default">
    <div class="panel-heading panel-heading-divider">
      List transaksi
    </div>
    <div class="panel-body">
      <table id="datatab" class="table ">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Jenis</th>
            <th>Montir</th>
            <th>Total Harga</th>
            <th>Waktu</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @php
            $no=1;
          @endphp
          @foreach($transaksi as $data)
          <tr>
            <td>{{ $no }}</td>
            <td>{{ isset($data->pelanggan)?$data->pelanggan->nama:'UMUM' }}</td>
            <td>{{ $data->jenis }}</td>
            <td>{{ isset($data->montir)?$data->montir->nama:'' }}</td>
            <td>Rp. {{number_format($data->total_harga, 0, '', '.')}} </td>
            <td>{{ $data->created_at }}</td>
            <td>

              <div class="btn-group">

                <a href="{{ url('kasir/transaksi/'.$data->id.'/edit') }}" class="btn btn-primary">Servis/Sparepart</a>
                <a target="_blank" href="{{ url('kasir/transaksi/'.$data->id.'/done') }}" class="btn btn-success selesai" >Selesai & Cetak</a>
                <a href="{{ url('kasir/transaksi/'.$data->id.'/delete') }}" class="btn btn-danger">Hapus</a>
              </div>
            </td>
          </tr>
          @php
            $no++;
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
    $('#datatab').DataTable();
    $('.selesai').click(function(e){
      e.preventDefault();
      var uri = $(this).attr('href');
      window.open(uri,'_blank');
      window.location.reload();
    });
  });
</script>
@endsection
