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

}
