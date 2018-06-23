<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use App\Transaksi;
use Illuminate\Http\Request;
use Carbon;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_tahun = Transaksi::distinct()->select(DB::raw('YEAR(created_at) year'))->get();


        return view('manager.dashboard', ['tahun' => $data_tahun]);
    }
}
