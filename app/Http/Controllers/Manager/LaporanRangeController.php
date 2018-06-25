<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon;
use App\Transaksi;
use DB;

class LaporanRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data_group = Transaksi::oldest()->first();

        $oldest = Carbon::parse($data_group->created_at)->format('Y-m-d');

        $data_group = Transaksi::latest()->first();

        $newest = Carbon::parse($data_group->created_at)->format('Y-m-d');


        $data_group = Transaksi::distinct()->select(DB::raw('DATE(created_at) date'))->get(); 
        for ($i = 0; $i < sizeof($data_group); $i++) {
            $data = Transaksi::whereDate('created_at', $data_group[$i]->date)->get();

            $part = 0;
            $pend_part = 0;
            $service = 0;
            $pend_service = 0;
            $total = 0;
            $total_transaksi = 0;

            $name = Carbon::parse($data_group[$i]->date)->format('d M Y');
            
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
        $oldest_show = Carbon::parse($oldest)->format('d M Y');
        $newest_show = Carbon::parse($newest)->format('d M Y');

        $infos = array('oldest'=> $oldest,
                'newest'=> $newest,
                'oldest_show'=> $oldest_show,
                'newest_show'=> $newest_show);


        if($data_all != null){

            $part = 0;
            $pend_part = 0;
            $service = 0;
            $pend_service = 0;
            $total = 0;
            $total_transaksi = 0;

            foreach ($data_all as $itm) {
                $part += $itm['part'];
                $pend_part += $itm['pend_part'];
                $service += $itm['service'];
                $pend_service += $itm['pend_service'];
                $total += $itm['total'];
                $total_transaksi += $itm['total_transaksi'];
            }

            $grand_info = array('part'=> $part,
                'pend_part'=> $pend_part,
                'service'=> $service,
                'pend_service'=> $pend_service,
                'total'=> $total,
                'total_transaksi'=> $total_transaksi);

            return view('manager.laporan_range.index', ['info'=> $info, 'data_all'=> $data_all, 'infos'=> $infos, 'grand_info'=> $grand_info]);
        }else{
            return view('manager.laporan_range.index', ['info'=> $info, 'infos'=> $infos]);
        }
    }

    public function cetak($oldest, $newest){
        $oldest = Carbon::parse($oldest)->format('Y-m-d 00:00:00');


        $newest = Carbon::parse($newest)->format('Y-m-d 23:59:59');


        $data_group = Transaksi::distinct()->select(DB::raw('DATE(created_at) date'))
            ->where('created_at', '>=', $oldest)
            ->where('created_at', '<=', $newest)
            ->get(); 

        for ($i = 0; $i < sizeof($data_group); $i++) {
            $data = Transaksi::whereDate('created_at', $data_group[$i]->date)
                ->get();

            $part = 0;
            $pend_part = 0;
            $service = 0;
            $pend_service = 0;
            $total = 0;
            $total_transaksi = 0;

            $name = Carbon::parse($data_group[$i]->date)->format('d M Y');
            
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
        $oldest = Carbon::parse($oldest)->format('Y-m-d');

        $newest = Carbon::parse($newest)->format('Y-m-d');

        $oldest_show = Carbon::parse($oldest)->format('d M Y');
        $newest_show = Carbon::parse($newest)->format('d M Y');

        $infos = array('oldest'=> $oldest,
                'newest'=> $newest,
                'oldest_show'=> $oldest_show,
                'newest_show'=> $newest_show);
        $part = 0;
        $pend_part = 0;
        $service = 0;
        $pend_service = 0;
        $total = 0;
        $total_transaksi = 0;

        foreach ($data_all as $itm) {
            $part += $itm['part'];
            $pend_part += $itm['pend_part'];
            $service += $itm['service'];
            $pend_service += $itm['pend_service'];
            $total += $itm['total'];
            $total_transaksi += $itm['total_transaksi'];
        }

        $grand_info = array('part'=> $part,
            'pend_part'=> $pend_part,
            'service'=> $service,
            'pend_service'=> $pend_service,
            'total'=> $total,
            'total_transaksi'=> $total_transaksi);



        return view('manager.laporan_range.cetak', ['data_all'=> $data_all, 'infos'=> $infos, 'grand_info'=> $grand_info]);
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

        $oldest = Carbon::parse($request->oldest)->format('Y-m-d 00:00:00');


        $newest = Carbon::parse($request->newest)->format('Y-m-d 23:59:59');


        $data_group = Transaksi::distinct()->select(DB::raw('DATE(created_at) date'))
            ->where('created_at', '>=', $oldest)
            ->where('created_at', '<=', $newest)
            ->get(); 

        for ($i = 0; $i < sizeof($data_group); $i++) {
            $data = Transaksi::whereDate('created_at', $data_group[$i]->date)
                ->get();

            $part = 0;
            $pend_part = 0;
            $service = 0;
            $pend_service = 0;
            $total = 0;
            $total_transaksi = 0;

            $name = Carbon::parse($data_group[$i]->date)->format('d M Y');
            
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
        $oldest = Carbon::parse($request->oldest)->format('Y-m-d');

        $newest = Carbon::parse($request->newest)->format('Y-m-d');

        $oldest_show = Carbon::parse($oldest)->format('d M Y');
        $newest_show = Carbon::parse($newest)->format('d M Y');

        $infos = array('oldest'=> $oldest,
                'newest'=> $newest,
                'oldest_show'=> $oldest_show,
                'newest_show'=> $newest_show);


        if($data_all != null){

            $part = 0;
            $pend_part = 0;
            $service = 0;
            $pend_service = 0;
            $total = 0;
            $total_transaksi = 0;

            foreach ($data_all as $itm) {
                $part += $itm['part'];
                $pend_part += $itm['pend_part'];
                $service += $itm['service'];
                $pend_service += $itm['pend_service'];
                $total += $itm['total'];
                $total_transaksi += $itm['total_transaksi'];
            }

            $grand_info = array('part'=> $part,
                'pend_part'=> $pend_part,
                'service'=> $service,
                'pend_service'=> $pend_service,
                'total'=> $total,
                'total_transaksi'=> $total_transaksi);

            return view('manager.laporan_range.index', ['info'=> $info, 'data_all'=> $data_all, 'infos'=> $infos, 'grand_info'=> $grand_info]);
        }else{
            return view('manager.laporan_range.index', ['info'=> $info, 'infos'=> $infos]);
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
