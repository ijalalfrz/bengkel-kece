<?php

namespace App\Http\Controllers\Manager;
use App\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pelanggan::all();
        return view('manager.pelanggan.index', ['pelanggan' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('manager.pelanggan.create');
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
        $data = new Pelanggan();
        $data->nama = $request->nama;
        $data->no_kendaraan = $request->no_kendaraan;
        $data->merk_kendaraan = $request->merk_kendaraan;
        $data->tahun = $request->tahun;
        $data->alamat = $request->alamat;

        if($data->save()){
            $request->session()->flash('msg', "Sukses menambahkan data pelanggan");
            return redirect()->route('pelanggan.index');
        }else{
            return back()
            ->withErrors(['sistem', 'Gagal menambahkan data pelanggan'])
            ->withInput();
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
        $pelanggan = Pelanggan::findOrFail($id);

        if($pelanggan->delete()){
            \Session::flash('msg', "Sukses menghapus pelanggan");
        }else{
            \Session::flash('msg', "Gagal menghapus pelanggan");
        }

        return redirect()->route('pelanggan.index');
    }
}
