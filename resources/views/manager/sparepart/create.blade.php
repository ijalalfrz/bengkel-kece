@extends('layouts.cms')

@section('content')

<div class="page-head">
  <h2 class="page-head-title">Sparepart</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Home</a></li>
    <li><a href="{{ url('/manager/sparepart') }}">Sparepart</a></li>
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
      Tambah Sparepart
    </div>
    <div class="panel-body">
      <form method="POST" action="{{ url('/manager/sparepart') }}" >
        @csrf
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="nama" class="form-control" required value="{{ old('nama') }}">
        </div>
        <div class="form-group">
          <label>Satuan</label>
          <input type="text" name="satuan" class="form-control" required value="{{ old('satuan')}}">
        </div>
        
        <input type="hidden" name="kode" class="form-control" required value="-">
        
        <div class="form-group">
          <label>Harga Satuan</label>
          <input type="number" name="harga" class="form-control" required value="{{ old('harga') }}">
        </div>
        <p class="text-right">
          <button step="1" min="1" type="submit" class="btn btn-space btn-primary">Simpan</button>
          <a href="{{ url('/manager/sparepart') }}" class="btn btn-space btn-default">Kembali</a>
        </p>
      </form>
    </div>
  </div>
</div>
@endsection
