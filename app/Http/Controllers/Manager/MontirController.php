<?php

namespace App\Http\Controllers\Manager;
use App\Montir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class MontirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Montir::all();

        return view('manager.montir.index', ['montir'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('manager.montir.create');
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

        $find = Montir::where('no_ktp', $request->no_ktp)->count();
        if($find > 0){
            return back()
            ->withErrors(['sistem' => 'Nomor ktp sudah ada!'])
            ->withInput();
        }


        $validatedData = $request->validate([
            'foto' => 'required|file|max:5000',
        ]);


        $foto = "";
        if($request->hasfile('foto'))
        {
            $file = $request->file('foto');
            $foto = time().'.'.$file->extension();
            $file->move(public_path().'/uploads/', $foto);
            $foto = "/uploads/".$foto;
        }

        $data = new Montir();
        $data->no_ktp = $request->no_ktp;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->foto = $foto;

        if($data->save()){
            $request->session()->flash('msg', "Sukses menambahkan montir");
            return redirect()->route('montir.index');
        }else{
            return back()
            ->withErrors(['sistem', 'Gagal menambahkan montir'])
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
        $data = Montir::findOrFail($id);

        return view('manager.montir.edit',['montir'=>$data]);
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
        $find = Montir::where('no_ktp', $request->no_ktp)->first();
        if($find!=null && $find->id != $id){
            return back()
            ->withErrors(['sistem' => 'Nomor ktp sudah ada!'])
            ->withInput();
        }


        $validatedData = $request->validate([
            'foto' => 'file|max:5000',
        ]);

        $data = Montir::findOrFail($id);
        $foto = $data->foto;
        if($request->hasfile('foto'))
        {
            if (File::exists(public_path().$foto)) {
                File::delete(public_path().$foto);
            }

            $file = $request->file('foto');
            $foto = time().'.'.$file->extension();
            $file->move(public_path().'/uploads/', $foto);
            $foto = "/uploads/".$foto;
        }

        $data->no_ktp = $request->no_ktp;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->foto = $foto;

        if($data->save()){
            $request->session()->flash('msg', "Sukses mengubah montir");
            return redirect()->route('montir.index');
        }else{
            return back()
            ->withErrors(['sistem', 'Gagal mengubah montir'])
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
        $montir = Montir::findOrFail($id);
        $foto = $montir->foto;

        if (File::exists(public_path().$foto)) {
            File::delete(public_path().$foto);
        }
        if($montir->delete()){
            \Session::flash('msg', "Sukses menghapus montir");
        }else{
            \Session::flash('msg', "Gagal menghapus montir");
        }
        return redirect()->route('montir.index');
    }
}
