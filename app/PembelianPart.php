<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianPart extends Model
{
    //

  protected $fillable = ['id_part', 'harga', 'satuan', 'jumlah', 'supplier', 'total_harga', 'stok_awal', 'stok_akhir'];

	public function part(){
    return $this->belongsTo('App\Part', 'id_part');
  }
}
