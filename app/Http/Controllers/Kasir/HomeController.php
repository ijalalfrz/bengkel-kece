<?php

namespace App\Http\Controllers\Kasir;

use App\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //

    public function index()
    {

      $transaksi = Transaksi::where('status','ongoing')->limit(20)->get();

      return view('kasir.dashboard', ['transaksi' => $transaksi]);
    }
}
