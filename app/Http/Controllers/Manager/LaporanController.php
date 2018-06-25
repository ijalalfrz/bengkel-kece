<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon;
use App\Transaksi;
use DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tgl = Carbon::parse(Carbon::today())->format('Y-m-d');
        $data = Transaksi::whereDate('created_at', $tgl)->get();

        $part = 0;
        $pend_part = 0;
        $service = 0;
        $pend_service = 0;
        $total = 0;
        $total_transaksi = 0;
        foreach ($data as $itm) {
            if($itm->jenis == "service"){
                $service += 1;
                $pend_service += $itm->total_harga;  
            }else{
                $part += 1;
                $pend_part += $itm->total_harga;
            }
            $total_transaksi += 1;
            $total += $itm->total_harga;
        }

        $tgl_show = Carbon::parse(Carbon::today())->format('d M Y');

        $info = array('tgl'=> $tgl,
                'tgl_show'=> $tgl_show,
                'part'=> $part,
                'pend_part'=> $pend_part,
                'service'=> $service,
                'pend_service'=> $pend_service,
                'total'=> $total,
                'total_transaksi'=> $total_transaksi);

        
        return view('manager.laporan.index', ['transaksi'=> $data, 'info'=> $info]);
       
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $tgl = $request->tgl;
        $data = Transaksi::whereDate('created_at', $tgl)->get();

        $part = 0;
        $pend_part = 0;
        $service = 0;
        $pend_service = 0;
        $total = 0;
        $total_transaksi = 0;
        foreach ($data as $itm) {
            if($itm->jenis == "service"){
                $service += 1;
                $pend_service += $itm->total_harga;  
            }else{
                $part += 1;
                $pend_part += $itm->total_harga;
            }
            $total_transaksi += 1;
            $total += $itm->total_harga;
        }

        $tgl_show = Carbon::parse($tgl)->format('d M Y');

        $tgl = Carbon::parse($tgl)->format('Y-m-d');

        $info = array('tgl'=> $tgl,
                'tgl_show'=> $tgl_show,
                'part'=> $part,
                'pend_part'=> $pend_part,
                'service'=> $service,
                'pend_service'=> $pend_service,
                'total'=> $total,
                'total_transaksi'=> $total_transaksi);

        return view('manager.laporan.index', ['transaksi'=> $data, 'info'=> $info]);
    }

    public function khusus($tgl)
    {
        $data = Transaksi::whereDate('created_at', $tgl)->get();

        $part = 0;
        $pend_part = 0;
        $service = 0;
        $pend_service = 0;
        $total = 0;
        $total_transaksi = 0;
        foreach ($data as $itm) {
            if($itm->jenis == "service"){
                $service += 1;
                $pend_service += $itm->total_harga;  
            }else{
                $part += 1;
                $pend_part += $itm->total_harga;
            }
            $total_transaksi += 1;
            $total += $itm->total_harga;
        }

        $tgl_show = Carbon::parse($tgl)->format('d M Y');

        $tgl = Carbon::parse($tgl)->format('Y-m-d');

        $info = array('tgl'=> $tgl,
                'tgl_show'=> $tgl_show,
                'part'=> $part,
                'pend_part'=> $pend_part,
                'service'=> $service,
                'pend_service'=> $pend_service,
                'total'=> $total,
                'total_transaksi'=> $total_transaksi);

        return view('manager.laporan.cetak_khusus', ['transaksi'=> $data, 'info'=> $info]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
