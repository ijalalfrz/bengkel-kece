<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon;
use App\Transaksi;

class LaporanBulananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tgl = Carbon::parse(Carbon::today())->format('Y-m-d');
        $year = Carbon::today()->year;
        $month = Carbon::today()->month;
        $data = Transaksi::whereYear('created_at', '=',$year)
                    ->whereMonth('created_at', '=',$month)
                    ->get();

        $part = 0;
        $pend_part = 0;
        $service = 0;
        $pend_service = 0;
        $total = 0;
        foreach ($data as $itm) {
            if($itm->jenis == "service"){
                $service += 1;
                $pend_service += $itm->total_harga;
            }else{
                $part += 1;
                $pend_part += $itm->total_harga;
            }

            $total += $itm->total_harga;
        }

        $tgl_show = Carbon::parse(Carbon::today())->format('M Y');
        $info = array('tgl'=> $tgl,
                'tgl_show'=> $tgl_show,
                'month'=> $month,
                'year'=> $year,
                'part'=> $part,
                'pend_part'=> $pend_part,
                'service'=> $service,
                'pend_service'=> $pend_service,
                'total'=> $total);

        return view('manager.laporan_bulanan.index', [
            'transaksi'=> $data,
            'info'=> $info]);
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
        
        $year = $request->year;
        $month = $request->month;
        $data = Transaksi::whereYear('created_at', '=',$year)
                    ->whereMonth('created_at', '=',$month)
                    ->get();

        $part = 0;
        $pend_part = 0;
        $service = 0;
        $pend_service = 0;
        $total = 0;
        foreach ($data as $itm) {
            if($itm->jenis == "service"){
                $service += 1;
                $pend_service += $itm->total_harga;
            }else{
                $part += 1;
                $pend_part += $itm->total_harga;
            }

            $total += $itm->total_harga;
            
        }

        $tgl = $year . '-' . $month . '-' . '20';
        $tgl_show = Carbon::parse($tgl)->format('M Y');

        $info = array('tgl'=> $tgl,
                'tgl_show'=> $tgl_show,
                'part'=> $part,
                'pend_part'=> $pend_part,
                'service'=> $service,
                'pend_service'=> $pend_service,
                'total'=> $total);

        return view('manager.laporan_bulanan.index', [
            'transaksi'=> $data,
            'info'=> $info]);
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
