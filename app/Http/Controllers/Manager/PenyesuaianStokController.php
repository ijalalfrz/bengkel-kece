<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PenyesuaianStok;
use App\Part;
class PenyesuaianStokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data_penyesuaian = PenyesuaianStok::all();

        return view('manager.penyesuaian_stok.index',['penyesuaian_stok' => $data_penyesuaian]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data_part = Part::all();

        return view('manager.penyesuaian_stok.create', ['part' => $data_part]);
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
        $data = PenyesuaianStok::create($request->except('_method', '_token'));
        if($data->save()){
            $data_part = Part::find($data->id_part);
            if($data->jenis=='tambah'){
                $data_part->stok += $data->nilai;
            }else{
                $data_part->stok -= $data->nilai;
            }

            if($data_part->save()){
                $request->session()->flash('msg', "Sukses menambahkan data penyesuaian stok");
                return redirect()->route('penyesuaian_stok.index');
            }else{
                return back()
                ->withErrors(['sistem','Gagal menambahkan data penyesuaian stok'])
                ->withInput();
            }
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
