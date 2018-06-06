<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    //
  protected $fillable = ['nomor_part','nama','harga'];

  public function detail()
  {
      return $this->hasOne('App\DetailPart','id_part','id');
  }
}
