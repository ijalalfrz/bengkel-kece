<?php

namespace App\Http\Controllers\Manager;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Service::all();

        return view('manager.servis.index',['servis'=>$data]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('manager.servis.create');
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
        $data = Service::create($request->except('_method', '_token'));
        if($data->save()){

            if($data->id >= 0 && $data->id <= 9){
                $data->kode = 'S' . '0000' . $data->id;
            }else if($data->id >= 10 && $data->id <= 99){
                $data->kode = 'S' . '000' . $data->id;
            }else if($data->id >= 100 && $data->id <= 999){
                $data->kode = 'S' . '00' . $data->id;
            }else if($data->id > 1000 && $data->id <= 9999){
                $data->kode = 'S' . '0' . $data->id;
            }else{
                $data->kode = 'S' . $data->id;
            }
            $data->save();

            $request->session()->flash('msg', "Sukses menambahkan data servis");
            return redirect()->route('servis.index');
        }else{
            return back()
            ->withErrors(['sistem','Gagal menambahkan data servis'])
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
        $data = Service::findOrFail($id);

        return view('manager.servis.edit', ['servis' => $data ]);
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
        $data = Service::findOrFail($id);
        $data->nama = $request->nama;
        $data->harga_jual = $request->harga_jual;
        if($data->save()){
            $request->session()->flash('msg', "Sukses mengubah data servis");
            return redirect()->route('servis.index');
        }else{
            return back()
            ->withErrors(['sistem', 'Gagal mengubah data servis'])
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
        $find = Service::findOrFail($id);
        if($find!=null){
            Service::destroy($id);
            \Session::flash('msg', "Sukses menghapus data servis");
        }

        return redirect()->route('servis.index');

    }
}
