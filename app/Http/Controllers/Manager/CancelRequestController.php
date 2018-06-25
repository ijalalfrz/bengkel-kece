<?php

namespace App\Http\Controllers\Manager;
use App\TransaksiCancelRequest;
use App\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CancelRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data_cancel = TransaksiCancelRequest::all();
        return view('manager.cancel_request.index', ['cancel' => $data_cancel]);
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

    public function approve($id){
        $cancel = TransaksiCancelRequest::findOrFail($id);

        $cancel->status = 'disetujui';

        if($cancel->save()){

            $transaksi = Transaksi::find($cancel->id_transaksi);
            if($transaksi!=null){
                $transaksi->status = 'ongoing';
                if($transaksi->save()){
                    \Session::flash('msg', "Sukses menyetujui pembatalan");
                }else{
                    return back()
                    ->withErrors(['sistem','Gagal menyetujui pembatalan'])
                    ->withInput();
                }
            }
            return redirect()->route('cancel_request.index');
        }else{
            return back()
            ->withErrors(['sistem','Gagal menyetujui pembatalan'])
            ->withInput();
        }
    }

    public function deny($id){
        $cancel = TransaksiCancelRequest::findOrFail($id);

        $cancel->status = 'ditolak';

        if($cancel->save()){

            $transaksi = Transaksi::find($cancel->id_transaksi);
            if($transaksi!=null){
                $transaksi->status = 'done';
                if($transaksi->save()){
                    \Session::flash('msg', "Sukses menolak pembatalan");
                }else{
                    return back()
                    ->withErrors(['sistem','Gagal menolak pembatalan'])
                    ->withInput();
                }
            }
            return redirect()->route('cancel_request.index');
        }else{
            return back()
            ->withErrors(['sistem','Gagal menolak pembatalan'])
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
