<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon;
use App\Transaksi;
use App\TransaksiDetailPart;
use App\TransaksiDetailService;
use DB;

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

        $now = Carbon::parse(Carbon::now())->format('Y');
        $data_group = Transaksi::distinct()->select(DB::raw('MONTH(created_at) month, YEAR(created_at) year'))
            ->whereYear('created_at', '=', $now)
            ->get();

        for ($i = 0; $i < sizeof($data_group); $i++) {
            $data = Transaksi::whereYear('created_at', '=', $now)
                ->whereMonth('created_at', '=', $data_group[$i]->month)
                ->get();

            $part = 0;
            $pend_part = 0;

            $service = 0;
            $pend_service = 0;
            
            $total_transaksi = 0;
            $total_harga = 0;

            $date = $now . '-' . $data_group[$i]->month . '-' . '20';
            $month = Carbon::parse($date)->format('M');
            $name = $month . ' ' . $now;

            foreach ($data as $itm) {
                if($itm->jenis == "service"){
                    $service += 1;
                    $pend_service += $itm->total_harga;  
                }else{
                    $part += 1;
                    $pend_part += $itm->total_harga;
                }
                $total_transaksi += 1;
                $total_harga += $itm->total_harga;

            }

            $info = array('service'=> $service,
                'pend_service'=> $pend_service,
                'part'=> $part,
                'pend_part'=> $pend_part,
                'total_transaksi'=> $total_transaksi,
                'total_harga'=> $total_harga,
                'name'=> $name,
                'month'=> $month);

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
            $total_harga += $itm['total_harga'];
        }

        $grand_info = array('part'=> $part,
            'pend_part'=> $pend_part,
            'service'=> $service,
            'pend_service'=> $pend_service,
            'total_transaksi'=> $total_transaksi,
            'total_harga'=> $total_harga);

        $data = $data->sortBy('month')->values();

        $data = Transaksi::distinct()->select(DB::raw('YEAR(created_at) year'))->get();   


        for ($i = 0; $i < sizeof($data); $i++) {
            if($i == 0){
                $years = array($i=> $data[$i]->year);
            }else{
                $years = array_add($years, $i, $data[$i]->year);
            }
        }


        $info = array('tgl_show'=> $now,
                'years'=> $years);

        return view('manager.laporan_bulanan.index', ['data_all'=> $data_all, 'info'=> $info, 'grand_info'=> $grand_info]);
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

        $data_group = Transaksi::distinct()->select(DB::raw('MONTH(created_at) month, YEAR(created_at) year'))
            ->whereYear('created_at', '=', $request->year)
            ->get();

        for ($i = 0; $i < sizeof($data_group); $i++) {
            $data = Transaksi::whereYear('created_at', '=', $request->year)
                ->whereMonth('created_at', '=', $data_group[$i]->month)
                ->get();

            $part = 0;
            $pend_part = 0;

            $service = 0;
            $pend_service = 0;
            
            $total_transaksi = 0;
            $total_harga = 0;

            $date = $request->year . '-' . $data_group[$i]->month . '-' . '20';
            $month = Carbon::parse($date)->format('M');
            $name = $month . ' ' . $request->year;

            foreach ($data as $itm) {
                if($itm->jenis == "service"){
                    $service += 1;
                    $pend_service += $itm->total_harga;  
                }else{
                    $part += 1;
                    $pend_part += $itm->total_harga;
                }
                $total_transaksi += 1;
                $total_harga += $itm->total_harga;

            }

            $info = array('service'=> $service,
                'pend_service'=> $pend_service,
                'part'=> $part,
                'pend_part'=> $pend_part,
                'total_transaksi'=> $total_transaksi,
                'total_harga'=> $total_harga,
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
            $total_harga += $itm['total_harga'];
        }

        $grand_info = array('part'=> $part,
            'pend_part'=> $pend_part,
            'service'=> $service,
            'pend_service'=> $pend_service,
            'total_transaksi'=> $total_transaksi,
            'total_harga'=> $total_harga);

        $data = Transaksi::distinct()->select(DB::raw('YEAR(created_at) year'))->get();   


        for ($i = 0; $i < sizeof($data); $i++) {
            if($i == 0){
                $years = array($i=> $data[$i]->year);
            }else{
                $years = array_add($years, $i, $data[$i]->year);
            }
        }

        $info = array('tgl_show'=> $request->year,
                'years'=> $years);

        return view('manager.laporan_bulanan.index', ['data_all'=> $data_all, 'info'=> $info, 'grand_info'=> $grand_info]);
    }

    public function khusus($tgl){
        $data_group = Transaksi::distinct()->select(DB::raw('MONTH(created_at) month, YEAR(created_at) year'))
            ->whereYear('created_at', '=', $tgl)
            ->get();

        for ($i = 0; $i < sizeof($data_group); $i++) {
            $data = Transaksi::whereYear('created_at', '=', $tgl)
                ->whereMonth('created_at', '=', $data_group[$i]->month)
                ->get();

            $part = 0;
            $pend_part = 0;

            $service = 0;
            $pend_service = 0;
            
            $total_transaksi = 0;
            $total_harga = 0;

            $date = $tgl . '-' . $data_group[$i]->month . '-' . '20';
            $month = Carbon::parse($date)->format('M');
            $name = $month . ' ' . $tgl;

            foreach ($data as $itm) {
                if($itm->jenis == "service"){
                    $service += 1;
                    $pend_service += $itm->total_harga;  
                }else{
                    $part += 1;
                    $pend_part += $itm->total_harga;
                }
                $total_transaksi += 1;
                $total_harga += $itm->total_harga;

            }



            $info = array('service'=> $service,
                'pend_service'=> $pend_service,
                'part'=> $part,
                'pend_part'=> $pend_part,
                'total_transaksi'=> $total_transaksi,
                'total_harga'=> $total_harga,
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
            $total_harga += $itm['total_harga'];
        }

        $grand_info = array('part'=> $part,
            'pend_part'=> $pend_part,
            'service'=> $service,
            'pend_service'=> $pend_service,
            'total_transaksi'=> $total_transaksi,
            'total_harga'=> $total_harga);

        $data = Transaksi::distinct()->select(DB::raw('YEAR(created_at) year'))->get();   


        for ($i = 0; $i < sizeof($data); $i++) {
            if($i == 0){
                $years = array($i=> $data[$i]->year);
            }else{
                $years = array_add($years, $i, $data[$i]->year);
            }
        }

        $info = array('tgl_show'=> $tgl,
                'years'=> $years);

        return view('manager.laporan_bulanan.cetak_khusus', ['data_all'=> $data_all, 'info'=> $info, 'grand_info'=> $grand_info]);

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
