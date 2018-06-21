@extends('layouts.cms')

@section('content')

<div class="page-head">
  <h2 class="page-head-title">Pelanggan</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Home</a></li>
    <li class="active">Pelanggan</li>
  </ol>
</div>
<div class="main-content container-fluid">
	@if(\Session::has('msg'))
    <div role="alert" class="alert alert-success alert-dismissible">
      <button type="button" data-dismiss="alert" aria-label="Close" class="close">
      <span aria-hidden="true" class="mdi mdi-close"></span></button>
      <span>{{ \Session::get('msg') }}</span>
    </div>
  @endif
    <div class="panel panel-default">
    <div class="panel-heading panel-heading-divider">
      Daftar Pelanggan
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table id="datatab" class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>No STNK</th>
            <th>Nama Montir</th>
            <th>Total Harga</th>
            <th>Jenis</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i = 1;
          @endphp
          @foreach($pelanggan as $itm)
            <tr>
              <td>{{$i}}</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <p class="text-right">
                  <a href="{{ url('/manager/pelanggan/'.$itm->id.'/edit') }}" class="btn btn-info"><span class="mdi mdi-edit"></span></a>
                  <a href="javascript:void(0);" data-url="{{ url('/manager/pelanggan/'.$itm->id) }}" data-toggle='modal' data-target='#modal-delete' class="btnDelete btn btn-danger"><span class="mdi mdi-delete"></span></a>

                </p>
              </td>
            </tr>
            @php
              $i++;
            @endphp
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
