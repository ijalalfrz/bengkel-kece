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
                $total_transaksi += 1;
                $total += $itm->total_harga;

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

        $part = 0;
        $pend_part = 0;
        $service = 0;
        $pend_service = 0;
        $total_transaksi = 0;
        $total_harga = 0;

        foreach ($data_all as $itm) {
            $part += $itm['part'];
            $pend_part += $itm['pend_part'];
            $service += $itm['service'];
            $pend_service += $itm['pend_service'];
            $total_transaksi += $itm['total_transaksi'];
            $total_harga += $itm['total'];
        }

        $grand_info = array('part'=> $part,
            'pend_part'=> $pend_part,
            'service'=> $service,
            'pend_service'=> $pend_service,
            'total_transaksi'=> $total_transaksi,
            'total_harga'=> $total_harga);


        $tgl = Carbon::parse(Carbon::today())->format('Y-m-d');

        $tgl_show = Carbon::parse(Carbon::today())->format('Y');

        $info = array('tgl'=> $tgl,
                'tgl_show'=> $tgl_show);

        return view('manager.laporan_tahunan.index', ['info'=> $info, 'data_all'=> $data_all, 'grand_info'=> $grand_info]);
    }

    public function umum(){
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
                $total_transaksi += 1;
                $total += $itm->total_harga;

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

        $part = 0;
        $pend_part = 0;
        $service = 0;
        $pend_service = 0;
        $total_transaksi = 0;
        $total_harga = 0;

        foreach ($data_all as $itm) {
            $part += $itm['part'];
            $pend_part += $itm['pend_part'];
            $service += $itm['service'];
            $pend_service += $itm['pend_service'];
            $total_transaksi += $itm['total_transaksi'];
            $total_harga += $itm['total'];
        }

        $grand_info = array('part'=> $part,
            'pend_part'=> $pend_part,
            'service'=> $service,
            'pend_service'=> $pend_service,
            'total_transaksi'=> $total_transaksi,
            'total_harga'=> $total_harga);

        $tgl = Carbon::parse(Carbon::today())->format('Y-m-d');

        $tgl_show = Carbon::parse(Carbon::today())->format('Y');

        $info = array('tgl'=> $tgl,
                'tgl_show'=> $tgl_show);


        return view('manager.laporan_tahunan.cetak_umum', ['data_all'=> $data_all, 'grand_info'=> $grand_info]);

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
