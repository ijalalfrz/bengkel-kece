@extends('layouts.cms')

@section('content')

<div class="page-head">
  <h2 class="page-head-title">Penyesuaian Stok</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Home</a></li>
    <li><a href="{{ url('/manager/penyesuaian_stok') }}">Penyesuaian Stok</a></li>
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
      Tambah Penyesuaian Stok
    </div>
    <div class="panel-body">
      <form method="POST" action="{{ url('/manager/penyesuaian_stok') }}" >
        @csrf
        <div class="form-group">
          <label>Part</label>
          <select name="id_part" class="select2" required>
            @foreach($part as $data)
              <option {{old('id_part')==$data->id?'selected':''}} value="{{$data->id}}">{{$data->kode}} - {{$data->nama}}</option>
            @endforeach
          </select>

        </div>
        <div class="form-group">
          <label>Jenis</label>
          <select name="jenis" class="form-control" required>
            <option {{old('jenis')=='tambah'?'selected':''}} value="tambah">Tambah</option>
            <option {{old('jenis')=='kurang'?'selected':''}} value="kurang">Kurang</option>
          </select>
        </div>
        <div class="form-group">
          <label>Nilai</label>
          <input type="number" step="1" min="1" name="nilai" value="{{old('nilai')}}" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Deskripsi</label>
          <input type="text" name="deskripsi" value="{{old('deskripsi')}}" class="form-control" required>
        </div>
        <p class="text-right">
          <button type="submit" class="btn btn-space btn-primary">Simpan</button>
          <a href="{{ url('/manager/penyesuaian_stok') }}" class="btn btn-space btn-default">Kembali</a>
        </p>
      </form>
    </div>
  </div>
</div>
@endsection
