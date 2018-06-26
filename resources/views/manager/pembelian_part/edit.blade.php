@extends('layouts.cms')

@section('content')
<div class="page-head">
  <h2 class="page-head-title">Pembelian Part</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Home</a></li>
    <li><a href="{{ url('/manager/pembelian_part') }}">Pembelian Part</a></li>
    <li class="active">Create</li>
  </ol>
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
  <div class="panel panel-default">
  	<div class="panel-heading panel-heading-divider">
      Edit Pembelian Part
    </div>
	  <div class="panel-body">
	  	<form method="POST" action="{{ url('/manager/pembelian_part/'.$data->id) }}" >
	    	@csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">

	        <label>Part</label>
          <input type="text" name="part" value="{{$data->part->kode}} - {{$data->part->nama}}" disabled class="form-control">
          <input type="hidden" name="id_part" value="{{$data->id_part}}">
	      </div>
	      <div class="form-group">
          <label>Harga Satuan</label>
          <input type="number" name="harga" class="form-control" required value="{{ (int) $data->harga }}">
        </div>
        <div class="form-group">
          <label>Satuan</label>
          <input type="text" name="satuan" class="form-control" required value="{{ $data->satuan}}">
        </div>
        <div class="form-group">
          <label>Jumlah</label>
          <input type="number" name="jumlah" class="form-control" required value="{{ $data->jumlah }}">
        </div>
        <div class="form-group">
          <label>Supplier</label>
          <input type="text" name="supplier" class="form-control" required value="{{ $data->supplier }}">
        </div>
        <div class="form-group">
          <label>Total Harga</label>
          <input type="number" name="total_harga" class="form-control" required value="{{ (int) $data->total_harga }}">
        </div>
        <p class="text-right">
          <button step="1" min="1" type="submit" class="btn btn-space btn-primary">Simpan</button>
          <a href="{{ url('/manager/pembelian_part') }}" class="btn btn-space btn-default">Kembali</a>
        </p>
	  	</form>
	  </div>
  </div>
</div>
@endsection
