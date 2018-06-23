<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetailService extends Model
{
    //
  public function service(){
    return $this->belongsTo('App\Service', 'id_service');
  }
}
