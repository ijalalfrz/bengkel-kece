<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    //
  public function transaksi()
  {
    return $this->hasMany('App\Transaksi');
  }

}
