<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetailPart extends Model
{
    //
  public function part(){
    return $this->belongsTo('App\Part', 'id_part');
  }

  public function transaksi(){
    return $this->belongsTo('App\Transaksi', 'id_transaksi');
  }
}
