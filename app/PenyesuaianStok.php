<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenyesuaianStok extends Model
{
  protected $fillable = ['id_part', 'jenis', 'nilai', 'deskripsi'];

    //
  public function part(){
    return $this->belongsTo('App\Part', 'id_part');
  }

}
