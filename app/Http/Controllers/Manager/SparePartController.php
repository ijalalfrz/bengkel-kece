<?php

namespace App\Http\Controllers\Manager;

use App\Part;
use App\DetailPart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SparePartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Part::all();
        return view('manager.sparepart.index', [ 'part' => $data ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('manager.sparepart.create');

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
        $find = Part::where('nama', $request->nama)->count();
        if($find > 0){
            return back()
            ->withErrors(['sistem' => 'Part sudah ada!'])
            ->withInput();
        }

        $data = Part::create($request->except('_method', '_token'));
        if($data->save()){
            $request->session()->flash('msg', "Sukses menambahkan sparepart");
            return redirect()->route('sparepart.index');
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
        $find = Part::findOrFail($id);

        return view('manager.sparepart.edit', ['part' => $find ]);
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
        $data = Part::findOrFail($id);
        $data->nama = $request->nama;
        $data->harga = $request->harga;
        if($data->save()){
            $request->session()->flash('msg', "Sukses mengubah sparepart");
            return redirect()->route('sparepart.index');
        }else{
            return back()
            ->withErrors(['sistem', 'Gagal mengubah sparepart'])
            ->withInput();
        }
    }

    public function updateStok(Request $request, $id)
    {
        //
        $data = new DetailPart();
        $data->id_part = $id;

        $data->nomor_part = $request->nomor_part;
        if($data->save()){
            $request->session()->flash('msg', "Sukses menambah stok");
            return redirect()->route('sparepart.index');
        }else{
            return back()
            ->withErrors(['sistem', 'Gagal menambah stok'])
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
        if(Part::destroy($id)){
            \Session::flash('msg', "Sukses menghapus sparepart");
        }
        return redirect()->route('sparepart.index');
    }
}
