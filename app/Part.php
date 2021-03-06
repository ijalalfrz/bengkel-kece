<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    //
  protected $fillable = ['nama', 'satuan', 'kode', 'harga', 'stok'];

  public function detail()
  {
      return $this->hasMany('App\DetailPart','id_part','id');
  }

  public function detail_transaksi()
  {
      return $this->hasMany('App\TransaksiDetailPart','id_part','id');
  }

  public function pembelian()
  {
      return $this->hasMany('App\PembelianPart','id_part','id');
  }


}
