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
      Tambah Pembelian Part
    </div>
	  <div class="panel-body">
	  	<form method="POST" action="{{ url('/manager/pembelian_part') }}" >
	    	@csrf
	    	<div class="form-group">
	        <label>Part</label>
	        <select name="id_part" class="select2 form-control" required>
	        	<option disabled selected>Pilih part</option>
	        	@foreach ($data as $itm)
	        	<option value="{{$itm->id}}"> {{$itm->kode}} - {{$itm->nama}} ({{$itm->stok}})</option>
	        	@endforeach
	        </select>
	      </div>
	      <div class="form-group">
          <label>Harga Satuan</label>
          <input type="number" name="harga" class="form-control" required value="{{ old('harga') }}">
        </div>
        <div class="form-group">
          <label>Satuan</label>
          <input type="text" name="satuan" class="form-control" required value="{{ old('satuan')}}">
        </div>
        <div class="form-group">
          <label>Jumlah</label>
          <input type="number" name="jumlah" class="form-control" required value="{{ old('jumlah')}}">
        </div>
        <div class="form-group">
          <label>Supplier</label>
          <input type="text" name="supplier" class="form-control" required value="{{ old('supplier')}}">
        </div>
        <div class="form-group">
          <label>Total Harga</label>
          <input type="number" name="total_harga" class="form-control" required value="{{ old('total_harga') }}">
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
