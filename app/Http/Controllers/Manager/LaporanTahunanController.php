<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon;
use App\Transaksi;
use DB;

class LaporanTahunanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = Transaksi::distinct()->select(DB::raw('YEAR(created_at) year'))->get();    

        for ($i = 0; $i < sizeof($years) ; $i++) {
            $data = Transaksi::whereYear('created_at', '=', $years[$i]->year)->get();
            
            $part = 0;
            $pend_part = 0;
            $service = 0;
            $pend_service = 0;
            $total = 0;
            $total_transaksi = 0;
            $name = $years[$i]->year;

            foreach ($data as $itm) {
                if($itm->jenis == "service"){
                    $service += 1;
                    $pend_service += $itm->total_harga;
                }else{
                    $part += 1;
                    $pend_part += $itm->total_harga;
                }
                $total += $itm->total_harga;
                $total_transaksi += 1;
            }

            $info = array('part'=> $part,
                'pend_part'=> $pend_part,
                'service'=> $service,
                'pend_service'=> $pend_service,
                'total'=> $total,
                'total_transaksi'=> $total_transaksi,
                'name'=> $name);

            if($i == 0){
                $data_all = array($i=> $info);
            }else{
                $data_all = array_add($data_all, $i, $info);
            }
        }


        $tgl = Carbon::parse(Carbon::today())->format('Y-m-d');
        $year = Carbon::today()->year;
        $data = Transaksi::whereYear('created_at', '=',$year)->get();

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
            $total += $itm->total_harga;
            $total_transaksi += 1;
        }

        $tgl_show = Carbon::parse(Carbon::today())->format('Y');

        $info = array('tgl'=> $tgl,
                'tgl_show'=> $tgl_show,
                'year'=> $year,
                'part'=> $part,
                'pend_part'=> $pend_part,
                'service'=> $service,
                'pend_service'=> $pend_service,
                'total'=> $total,
                'total_transaksi'=> $total_transaksi);

        if($data_all != null){
            return view('manager.laporan_tahunan.index', ['transaksi'=> $data, 'info'=> $info, 'data_all'=> $data_all]);
        }else{
            return view('manager.laporan_tahunan.index', ['transaksi'=> $data, 'info'=> $info]);
        }
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
        //
        $years = Transaksi::distinct()->select(DB::raw('YEAR(created_at) year'))->get();    

        for ($i = 0; $i < sizeof($years) ; $i++) {
            $data = Transaksi::whereYear('created_at', '=', $years[$i]->year)->get();
            
            $part = 0;
            $pend_part = 0;
            $service = 0;
            $pend_service = 0;
            $total = 0;
            $total_transaksi = 0;
            $name = $years[$i]->year;

            foreach ($data as $itm) {
                if($itm->jenis == "service"){
                    $service += 1;
                    $pend_service += $itm->total_harga;
                }else{
                    $part += 1;
                    $pend_part += $itm->total_harga;
                }
                $total += $itm->total_harga;
                $total_transaksi += 1;
            }

            $info = array('part'=> $part,
                'pend_part'=> $pend_part,
                'service'=> $service,
                'pend_service'=> $pend_service,
                'total'=> $total,
                'total_transaksi'=> $total_transaksi,
                'name'=> $name);

            if($i == 0){
                $data_all = array($i=> $info);
            }else{
                $data_all = array_add($data_all, $i, $info);
            }
        }

        $year = $request->year;
        $data = Transaksi::whereYear('created_at', '=',$year)->get();

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

            $total += $itm->total_harga;
            $total_transaksi += 1;
            
        }

        $info = array('tgl_show'=> $year,
                'part'=> $part,
                'pend_part'=> $pend_part,
                'service'=> $service,
                'pend_service'=> $pend_service,
                'total'=> $total,
                'total_transaksi'=> $total_transaksi);

        if($data_all != null){
            return view('manager.laporan_tahunan.index', ['transaksi'=> $data, 'info'=> $info, 'data_all'=> $data_all]);
        }else{
            return view('manager.laporan_tahunan.index', ['transaksi'=> $data, 'info'=> $info]);
        }
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
