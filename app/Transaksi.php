<?php

namespace App;
use App\Pelanggan;
use Carbon;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
	public function pelanggan(){
		return $this->belongsTo('App\Pelanggan', 'id_pelanggan');
	}

	public function montir(){
		return $this->belongsTo('App\Montir', 'id_montir');
	}

	public function detailPart(){
		return $this->hasMany('App\TransaksiDetailPart','id_transaksi','id');
	}

	public function detailService(){
		return $this->hasMany('App\TransaksiDetailService','id_transaksi','id');
	}

	public function getFromDateAttribute() {
		$value = Carbon::now();
    return \Carbon\Carbon::parse($value)->format('Y-m-d');
	}
}
