<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PembelianPart;
use App\Part;

class PembelianPartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = PembelianPart::all();

        return view('manager.pembelian_part.index', ['data'=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = Part::all(); 
        return view('manager.pembelian_part.create', ['data'=> $data]);
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
        $data = new PembelianPart();
        $data->id_part = $request->id_part;
        $data->harga = $request->harga;
        $data->satuan = $request->satuan;
        $data->jumlah = $request->jumlah;
        $data->supplier = $request->supplier;
        $data->total_harga = $request->total_harga;

        $find = Part::where('id', $data->id_part)->first();
        $data->stok_awal = $find->stok;
        $data->stok_akhir = $find->stok + $data->jumlah;

        $find->stok = $data->stok_akhir;
        $find->save();



        if($data->save()){
            $request->session()->flash('msg', "Sukses menambahkan pembelian part");
            return redirect()->route('pembelian_part.index');
        }else{
            return back()->withInput();
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
        $data = PembelianPart::findOrFail($id);
        return view('manager.pembelian_part.edit', ['data'=>$data]);
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
        $data = PembelianPart::findOrFail($id);

        $data->harga = $request->harga;
        $data->satuan = $request->satuan;
        $data->jumlah = $request->jumlah;
        $data->supplier = $request->supplier;
        $data->total_harga = $request->total_harga;

        $find = Part::where('id', $data->id_part)->first();
        
        $selisih = $data->stok_akhir - $find->stok;
        $stok_real = $data->stok_awal + $data->jumlah - $selisih;

        $find->stok = $stok_real;
        $find->save();

        $data->stok_akhir = $stok_real;

        if($data->save()){
            $request->session()->flash('msg', "Sukses mengubah pembelian part");
            return redirect()->route('pembelian_part.index');
        }else{
            return back()
            ->withErrors(['sistem', 'Gagal mengubah pembelian part'])
            ->withInput();

        }
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
