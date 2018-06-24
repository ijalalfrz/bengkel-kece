@extends('layouts.main')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-borderless">
				<tr>
					<td><h2>PT. BENGKEL KECE</h2></td>
					<td style="text-align: right;"><h2>INVOICE</h2></td>
				</tr>
				<tr>
					<td>
						Jalan Setiabudhi No. 229, Isola, Sukasari,
						<br> Kota Bandung, Jawa Barat 40154
						<br> Telepon: (62-22) 2788289
					</td>
					<td style="text-align: right;">
						NOMOR TRANSAKSI: {{$transaksi->id}}
						<br> TANGGAL TRANSAKSI: {{$tgl}}
						<br> WAKTU TRANSAKSI: {{$waktu}}
					</td>
				</tr>
			</table>
		</div>
<<<<<<< HEAD
</div>
<div class="row">
		<div class="col-md-3">
			<table class="table table-borderless">
				<tr>
						@if ($transaksi->id_pelanggan != null)
					<td>NAMA PELANGGAN</td>
					<td>: {{$transaksi->pelanggan->nama}}</td>
						@endif
					
				</tr>
				@if ($transaksi->id_pelanggan != null)
				<tr>
					<td>NOMOR KENDARAAN</td>
					<td>: {{$transaksi->pelanggan->no_kendaraan}} </td>
				</tr>
				<tr>
					<td>MERK KENDARAAN</td>
					<td>: {{$transaksi->pelanggan->merk_kendaraan}} </td>
				</tr>
				<tr>
					<td>ALAMAT PELANGGAN</td>
					<td>: {{$transaksi->pelanggan->alamat}} </td>
				</tr>
				@endif
			</table>
		</div>
</div>
<hr>
<div class="row">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>NO</th>
					<th>KODE ITEM</th>
					<th>NAMA ITEM</th>
					<th>JUMLAH</th>
					<th>HARGA</th>
				</tr>
			</thead>
			<tbody>
				@php
      	  $i = 1;
      	@endphp

				@if ($transaksi->detailService != null)
				@foreach ($transaksi->detailService as $det_service)
      	<tr>
					<td> {{$i}} </td>
					<td> {{$det_service->service->kode}} </td>
					<td>Service {{$det_service->service->nama}} </td>
					<td>1</td>
					<td> Rp {{number_format($det_service->service->harga_jual, 0, '', '.')}} </td>
      	</tr>
				@php
      		$i++;
      	@endphp	
				@endforeach
				@endif

				@if ($transaksi->detailPart != null)
				@foreach ($transaksi->detailPart as $det_part)
				<tr>
					<td> {{$i}} </td>
					<td> {{$det_part->part->kode}} </td>
					<td> {{$det_part->part->nama}} </td>
					<td> {{$det_part->jumlah}} </td>
					<td> Rp {{number_format($det_part->part->harga, 0, '', '.')}} </td>
				</tr>
				@php
      		$i++;
      	@endphp	
				@endforeach
				@endif
				<tr>
					<th colspan="4" style="text-align: right;">TOTAL HARGA</th>
					<td> Rp {{number_format($transaksi->total_harga, 0, '', '.')}} </td>
				</tr>
			</tbody>
		</table>
</div>
<hr>
<div class="row">
		<div class="col-sm-offset-8 col-md-4">
			<center>
				Bandung, {{$tgl}} 
				<br>Hormat kami,
				<br>
				<br>
				<br>
				<br>PT. Bengkel Kece
			</center>
		</div>
=======
	</div>
	<div class="row">
			<div class="col-md-3">
				<table class="table table-borderless">
					<tr>
							@if ($transaksi->id_pelanggan != null)
						<td>NAMA PELANGGAN</td>
						<td>: {{$transaksi->pelanggan->nama}}</td>
							@endif

					</tr>
					@if ($transaksi->id_pelanggan != null)
					<tr>
						<td>NOMOR KENDARAAN</td>
						<td>: {{$transaksi->pelanggan->no_kendaraan}} </td>
					</tr>
					<tr>
						<td>MERK KENDARAAN</td>
						<td>: {{$transaksi->pelanggan->merk_kendaraan}} </td>
					</tr>
					<tr>
						<td>ALAMAT PELANGGAN</td>
						<td>: {{$transaksi->pelanggan->alamat}} </td>
					</tr>
					@endif
				</table>
			</div>
	</div>
	<hr>
	<div class="row">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>NO</th>
						<th>KODE ITEM</th>
						<th>NAMA ITEM</th>
						<th>JUMLAH</th>
						<th>HARGA</th>
					</tr>
				</thead>
				<tbody>
					@php
	      	  $i = 1;
	      	@endphp

					@if ($transaksi->detailService != null)
					@foreach ($transaksi->detailService as $det_service)
	      	<tr>
						<td> {{$i}} </td>
						<td> {{$det_service->service->kode}} </td>
						<td>Service {{$det_service->service->nama}} </td>
						<td>1</td>
						<td> Rp {{number_format($det_service->service->harga_jual, 0, '', '.')}} </td>
	      	</tr>
					@php
	      		$i++;
	      	@endphp
					@endforeach
					@endif

					@if ($transaksi->detailPart != null)
					@foreach ($transaksi->detailPart as $det_part)
					<tr>
						<td> {{$i}} </td>
						<td> {{$det_part->part->kode}} </td>
						<td> {{$det_part->part->nama}} </td>
						<td> {{$det_part->jumlah}} </td>
						<td> Rp {{number_format($det_part->part->harga, 0, '', '.')}} </td>
					</tr>
					@php
	      		$i++;
	      	@endphp
					@endforeach
					@endif

					<tr>
						<th colspan="4" style="text-align: right;">TOTAL HARGA</th>
						<td> Rp {{number_format($transaksi->total_harga, 0, '', '.')}} </td>
					</tr>
				</tbody>
			</table>
	</div>
	<hr>
	<div class="row">
			<div class="col-sm-offset-8 col-md-4">
				<center>
					Bandung, {{$tgl}}
					<br>Hormat kami,
					<br>
					<br>
					<br>
					<br>PT. Bengkel Kece
				</center>
			</div>
	</div>
>>>>>>> fb020540609e05ccb5da1116e147e1e1f3f70854
</div>

@endsection

@section('script')
<script type="text/javascript">
	$(function(){
		window.print();
	})
</script>
@endsection
