@extends('layouts.cms')

@section('content')

<div class="page-head">
  <h2 class="page-head-title">Pelanggan</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Home</a></li>
    <li><a href="{{ url('/manager/pelanggan') }}">Pelanggan</a></li>
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
      Tambah Pelanggan
    </div>
    <div class="panel-body">
      <form method="POST" action="{{ url('/manager/pelanggan') }}" >
        @csrf
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="nama" class="form-control" required value="{{ old('nama') }}">
        </div>
        <div class="form-group">
          <label>Nomor Polisi Kendaraan</label>
          <input type="text" name="no_kendaraan" class="form-control" required value="{{ old('no_kendaraan') }}">
        </div>
        <div class="form-group">
          <label>Merk Kendaraan</label>
          <input type="text" name="merk_kendaraan" class="form-control" required value="{{ old('merk_kendaraan') }}">
        </div>
        <div class="form-group">
          <label>Tahun</label>
          <input type="number" name="tahun" class="form-control" required value="{{ old('tahun') }}">
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="alamat" class="form-control" required value="{{ old('alamat') }}">
        </div>
        <div class="form-group">
          <label>No HP</label>
          <input type="text" name="no_hp" class="form-control numeric" required value="{{ old('no_hp') }}">
        </div>
        <p class="text-right">
          <button step="1" min="1" type="submit" class="btn btn-space btn-primary">Simpan</button>
          <a href="{{ url('/manager/pelanggan') }}" class="btn btn-space btn-default">Kembali</a>
        </p>
      </form>
    </div>
  </div>
</div>
@endsection
