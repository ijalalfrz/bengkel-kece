<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiCancelRequest extends Model
{
    //
  public function transaksi(){
    return $this->belongsTo('App\Transaksi', 'id_transaksi');
  }

  public function kasir(){
    return $this->belongsTo('App\User', 'id_user');
  }
}
