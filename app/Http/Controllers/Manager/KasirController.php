<?php

namespace App\Http\Controllers\Manager;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = User::where('role','kasir')->get();
        return view('manager.kasir.index',['kasir'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.kasir.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $find = User::where('email', $request->email)->count();
        if($find > 0){
            return back()
            ->withErrors(['sistem' => 'Kasir sudah ada!'])
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

        $data = new User();
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->name = $request->name;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->foto = $foto;
        $data->role = 'kasir';

        if($data->save()){
            $request->session()->flash('mgs', "Sukses menambahkan kasir");
            return redirect()->route('kasir.index');
        }else{
            return back()
            ->withErrors(['sistem', 'Gagal menambahkan kasir'])
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
        $data = User::findOrFail($id);
        return view('manager.kasir.edit',['kasir'=>$data]);
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
        $find = User::where('email', $request->email)->first();
        if($find != null && $find->id != $id){
            return back()
            ->withErrors(['sistem' => 'Kasir sudah ada!'])
            ->withInput();
        }

        $validatedData = $request->validate([
            'foto' => 'file|max:5000,
        ']);

        $data = User::findOrFail($id);
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

        $data->email = $request->email;
        $data->name = $request->name;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->foto = $foto;

        if($request->password != null){
            $data->password = bcrypt($request->password);
        }

        if($data->save()){
            $request->session()->flash('msg', "Sukses mengubah kasir");
            return redirect()->route('kasir.index');
        }else{
            return back()
            ->withErrors(['sistem', 'Gagal mengubah kasir'])
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
        $kasir = User::findOrFail($id);
        $foto = $kasir->foto;

        if(File::exists(public_path().$foto)){
            File::delete(public_path().$foto);
        }

        if($kasir->delete()){
            \Session::flash('msg', "Sukses menghapus kasir");
        }else{
            \Session::flash('msg', "Gagal menghapus kasir");
        }

        return redirect()->route('kasir.index');
    }
}
