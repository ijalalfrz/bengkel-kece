<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Part;

class LaporanPartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data_part = Part::all();

        if($data_part != null){
            for ($i = 0; $i < sizeof($data_part); $i++) {
                $status = 0;
                $jumlah = 0;
                $pend = 0;
                if($data_part[$i]->detail_transaksi != null){
                    foreach ($data_part[$i]->detail_transaksi as $value) {
                        $jumlah += $value->jumlah;           
                        $pend += $value->total_harga;

                    }
                    $status = 1;
                }
                $id = $data_part[$i]->id;

                $info = array('jumlah'=> $jumlah,
                    'pend'=> $pend,
                    'id'=> $id,
                    'status'=> $status);
                if($i == 0){
                    $data_all = array($i=> $info);
                }else{
                    $data_all = array_add($data_all, $i, $info);
                }
            }

        }

        // print_r($data_all);
        if($data_all != null){
            return view('manager.laporan_part.index', ['data_part'=> $data_part, 'data_all'=> $data_all]);
        }else{
            return view('manager.laporan_part.index', ['data_part'=> $data_part]);
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
