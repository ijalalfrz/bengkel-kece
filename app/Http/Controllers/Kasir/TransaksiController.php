<?php

namespace App\Http\Controllers\Kasir;
use App\User;
use App\Pelanggan;
use App\Montir;
use App\Part;
use App\Service;
use App\Transaksi;
use App\TransaksiDetailPart;
use App\TransaksiDetailService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pelanggan = Pelanggan::all();
        $montir = Montir::all();
        $part = Part::all();
        $service = Service::all();
        return view('kasir.transaksi.index', ['pelanggan' => $pelanggan, 'montir' => $montir, 'part' => $part, 'service' => $service]);
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
        $transaksi = new Transaksi();
        $transaksi->jenis = $request->jenis;
        $transaksi->total_harga = $request->total_grand;
        //detail part
        $arr_detail = [];
        if(isset($request->id_part)){

            for($i=0;$i<count($request->id_part);$i++){
                $detail_part = new TransaksiDetailPart();
                $detail_part->id_part = $request->id_part[$i];
                $detail_part->harga_jual = $request->harga_jual[$i];
                $detail_part->jumlah = $request->jumlah[$i];
                $detail_part->total_harga = $request->total_harga[$i];
                $arr_detail[] = $detail_part;
            }
        }

        if($request->jenis=='beli'){
            $transaksi->status = 'done';
        }else{
            $transaksi->status = 'ongoing';
            $transaksi->id_pelanggan = $request->id_pelanggan;
            $transaksi->id_montir = $request->id_montir;
            if(isset($request->id_service)){
                for($i=0;$i<count($request->id_service);$i++){
                    $detail_service = new TransaksiDetailService();
                    $detail_service->id_service = $request->id_service[$i];
                    $detail_service->harga_jual = $request->harga_jual_service[$i];
                    $arr_detail[] = $detail_service;
                }

            }
        }

        if(count($arr_detail)==0){
            return back()
            ->withErrors(['sistem', 'Data part/service tidak boleh kosong!'])
            ->withInput();
        }


        if($transaksi->save()){
            $request->session()->flash('msg', "Sukses menambahkan data transaksi");

            $err = false;
            for ($i=0; $i < count($arr_detail) ; $i++) {
                $arr_detail[$i]->id_transaksi = $transaksi->id;
                if(!$arr_detail[$i]->save()){ $err = true; }
                else{
                    if(isset($arr_detail[$i]->id_part)){
                        $id_part = $arr_detail[$i]->id_part;
                        $data_part = Part::find($id_part);
                        if($data_part!=null){
                            $data_part->stok = $data_part->stok - $arr_detail[$i]->jumlah;
                            $data_part->save();
                        }
                    }
                }
            }

            if($err){
                $data_delete = TransaksiDetailPart::where('id_transaksi', $transaksi->id);
                if($data_delete->count()>0){
                    foreach ($data_delete as $item) {
                        $item->delete();
                    }
                }

                $data_delete = TransaksiDetailService::where('id_transaksi', $transaksi->id);
                if($data_delete->count()>0){
                    foreach ($data_delete as $item) {
                        $item->delete();
                    }
                }
                $transaksi->delete();

                return back()
                ->withErrors(['sistem', 'Gagal menambahkan transaksi'])
                ->withInput();
            }else{

                if($transaksi->jenis=='beli'){
                    return redirect('/kasir/transaksi/'.$transaksi->id.'/invoice');
                }else{
                    return redirect()->route('kasir.home');

                }

            }

        }else{
            return back()
            ->withErrors(['sistem', 'Gagal menambahkan transaksi'])
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

    public function invoice($id)
    {
        //
        $transaksi = Transaksi::findOrFail($id);
        $part = Part::all();
        $service = Service::all();

        $tgl = Carbon::parse($transaksi->updated_at)->format('d M Y');
        $waktu = Carbon::parse($transaksi->updated_at)->format('H:i:s');

        return view('kasir.transaksi.invoice',['transaksi' => $transaksi,
            'service'=> $service,
            'part'=> $part,
            'tgl'=> $tgl,
            'waktu'=> $waktu]);
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

        $transaksi = Transaksi::findOrFail($id);
        $pelanggan = Pelanggan::all();
        $montir = Montir::all();
        $part = Part::all();
        $service = Service::all();

        return view('kasir.transaksi.edit', ['transaksi' => $transaksi, 'pelanggan' => $pelanggan, 'montir' => $montir, 'part' => $part, 'service' => $service]);

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
        $transaksi = Transaksi::findOrFail($id);

        $arr_detail = [];
        //detail part
        if(isset($request->id_part)){

            for($i=0;$i<count($request->id_part);$i++){
                $detail_part = new TransaksiDetailPart();
                $detail_part->id_part = $request->id_part[$i];
                $detail_part->harga_jual = $request->harga_jual[$i];
                $detail_part->jumlah = $request->jumlah[$i];
                $detail_part->total_harga = $request->total_harga[$i];
                $arr_detail[] = $detail_part;
            }
        }
        //detail service
        if($request->jenis=='service'){
            if(isset($request->id_service)){
                for($i=0;$i<count($request->id_service);$i++){
                    $detail_service = new TransaksiDetailService();
                    $detail_service->id_service = $request->id_service[$i];
                    $detail_service->harga_jual = $request->harga_jual_service[$i];
                    $arr_detail[] = $detail_service;
                }

            }
        }

        //check empty service and part
        if(count($arr_detail)==0 && $request->total_grand == 0 ){
            return back()
            ->withErrors(['sistem', 'Data part/service tidak boleh kosong!'])
            ->withInput();
        }

        $err = false;
        for ($i=0; $i < count($arr_detail) ; $i++) {
            $arr_detail[$i]->id_transaksi = $transaksi->id;
            if(!$arr_detail[$i]->save()){ $err = true; }
        }

        if($err){
            $data_delete = TransaksiDetailPart::where('id_transaksi', $transaksi->id);
            if($data_delete->count()>0){
                foreach ($data_delete as $item) {
                    $item->delete();
                }
            }

            $data_delete = TransaksiDetailService::where('id_transaksi', $transaksi->id);
            if($data_delete->count()>0){
                foreach ($data_delete as $item) {
                    $item->delete();
                }
            }
            $transaksi->delete();

            return back()
            ->withErrors(['sistem', 'Gagal menambahkan transaksi'])
            ->withInput();
        }else{
            if(isset($request->deleted_part)){
                for ($i=0; $i < count($request->deleted_part) ; $i++) {
                    $find = TransaksiDetailPart::find($request->deleted_part[$i]);
                    if($find!=null){
                        $find->delete();
                    }
                }
            }

            if(isset($request->deleted_service)){
                for ($i=0; $i < count($request->deleted_service) ; $i++) {
                    $find = TransaksiDetailService::find($request->deleted_service[$i]);
                    if($find!=null){
                        $find->delete();
                    }
                }
            }

            $transaksi->total_harga = $request->total_grand;
            $transaksi->save();

            $request->session()->flash('msg', "Sukses merubah service & part transaksi");
            return redirect()->route('kasir.home');
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


    public function getDetailPart($id)
    {
        $find = Part::find($id);
        return $find;
    }

    public function getDetailService($id)
    {
        $find = Service::find($id);
        return $find;
    }

    public function done($id){
        $find = Transaksi::findOrFail($id);

        $find->status ='done';
        if($find->save()){
           \Session::flash('msg', "Sukses melakukan transaksi");
            return redirect('/kasir/transaksi/'.$id.'/invoice');

        }else{
            return back()
            ->withErrors(['sistem', 'Gagal menambahkan data pelanggan'])
            ->withInput();
        }
    }

    public function delete($id){
        $transaksi = Transaksi::findOrFail($id);

        $data_delete = TransaksiDetailPart::where('id_transaksi', $transaksi->id);
        if($data_delete->count()>0){
            foreach ($data_delete as $item) {
                $item->delete();
            }
        }

        $data_delete = TransaksiDetailService::where('id_transaksi', $transaksi->id);
        if($data_delete->count()>0){
            foreach ($data_delete as $item) {
                $item->delete();
            }
        }


        if($transaksi->delete()){
           \Session::flash('msg', "Sukses menghapus transaksi");
            return back();
        }else{
            return back()
            ->withErrors(['sistem', 'Gagal menambahkan data pelanggan']);
        }

    }
}
