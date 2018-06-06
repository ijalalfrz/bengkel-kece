@extends('layouts.cms')

@section('content')

<div class="page-head">
  <h2 class="page-head-title">Montir</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Home</a></li>
    <li><a href="{{ url('/manager/montir') }}">Montir</a></li>
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
      Tambah Montir
    </div>
    <div class="panel-body">
      <form method="POST" action="{{ url('/manager/montir') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label>No KTP</label>
          <input type="text" name="no_ktp" class="numeric form-control" required value="{{ old('no_ktp') }}">
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="nama" class="form-control" required value="{{ old('nama') }}">
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="alamat" class="form-control" required value="{{ old('alamat') }}">
        </div>
        <div class="form-group">
          <label>No HP</label>
          <input type="text" name="no_hp" class="numeric form-control" required value="{{ old('no_hp') }}">
        </div>
        <div class="form-group">
          <label>Foto</label>
        </div>
        <div>
          <input type="file" name="foto" class="file-hidden" accept="image/*" required>
          <img src="{{ asset('img/photo.png') }}" width="250" class="img-prev" >
        </div>
        <p class="text-right">
          <button type="submit" class="btn btn-space btn-primary">Simpan</button>
          <a href="{{ url('/manager/montir') }}" class="btn btn-space btn-default">Kembali</a>
        </p>
      </form>
    </div>
  </div>
</div>
@endsection
