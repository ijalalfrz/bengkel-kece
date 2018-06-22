<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    //
  protected $fillable = ['nama', 'satuan', 'harga'];

  public function detail()
  {
      return $this->hasMany('App\DetailPart','id_part','id');
  }
}
