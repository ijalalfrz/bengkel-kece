<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use App\Transaksi;
use App\TransaksiDetailPart;
use App\Montir;
use Illuminate\Http\Request;
use Carbon;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_tahun = Transaksi::distinct()->select(DB::raw('YEAR(created_at) year'))->get();
        $data_montir = Montir::all();

        return view('manager.dashboard', ['tahun' => $data_tahun, 'montir' => $data_montir]);
    }

    public function getData($month, $year){


        $last_day = (int) date('t', strtotime($year.'-'.$month.'-'.'1'));
        $days = [];
        $arr_data_date_beli = [];
        $arr_data_date_service = [];
        for ($i=1; $i <= $last_day ; $i++) {
            # code...
            //days
            $days[] = $i;

            //get transaksi beli
            $transaksi_beli = Transaksi::select(DB::raw('SUM(total_harga) total'))
                ->where('jenis','beli')
                ->whereDate('created_at', '=', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i)))
                ->get()->first();
            $arr_data_date_beli[] = $transaksi_beli->total==null?0:(int) $transaksi_beli->total;

            //get transaksi service
            $transaksi_service = Transaksi::select(DB::raw('SUM(total_harga) total'))
                ->where('jenis','service')
                ->whereDate('created_at', '=', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i)))
                ->get()->first();
            $arr_data_date_service[] =  $transaksi_service->total==null?0:(int) $transaksi_service->total;;
        }

        $result = [
            'days' => $days,
            'data' => [
                [
                    'name' => 'Pembelian',
                    'data' => $arr_data_date_beli
                ],
                [
                    'name' => 'Jasa Service',
                    'data' => $arr_data_date_service
                ]
            ],
        ];
        return $result;
    }

    public function getCount($month, $year){


        $last_day = (int) date('t', strtotime($year.'-'.$month.'-'.'1'));
        $days = [];
        $arr_data_date_beli = [];
        $arr_data_date_service = [];
        for ($i=1; $i <= $last_day ; $i++) {
            # code...
            //days
            $days[] = $i;

            //get transaksi beli
            $transaksi_beli = Transaksi::select(DB::raw('COUNT(total_harga) total'))
                ->where('jenis','beli')
                ->where('status','done')
                ->whereDate('created_at', '=', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i)))
                ->get()->first();
            $arr_data_date_beli[] = $transaksi_beli->total==null?0:(int) $transaksi_beli->total;

            //get transaksi service
            $transaksi_service = Transaksi::select(DB::raw('COUNT(total_harga) total'))
                ->where('jenis','service')
                ->where('status','done')

                ->whereDate('created_at', '=', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i)))
                ->get()->first();
            $arr_data_date_service[] =  $transaksi_service->total==null?0:(int) $transaksi_service->total;;
        }

        $result = [
            'days' => $days,
            'data' => [
                [
                    'name' => 'Pembelian',
                    'data' => $arr_data_date_beli
                ],
                [
                    'name' => 'Jasa Service',
                    'data' => $arr_data_date_service
                ]
            ],
        ];
        return $result;
    }

    public function getCountSparePart($month, $year){


        $last_day = (int) date('t', strtotime($year.'-'.$month.'-'.'1'));
        $days = [];
        $arr_data_date_beli = [];
        for ($i=1; $i <= $last_day ; $i++) {
            # code...
            //days
            $days[] = $i;

            //get transaksi beli
            $transaksi_beli = TransaksiDetailPart::with(['transaksi' => function($q){
                $q->where('jenis','beli')->where('status','done');
            }])->select(DB::raw('SUM(jumlah) total'))
                ->whereDate('created_at', '=', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i)))
                ->get()->first();
            $arr_data_date_beli[] = $transaksi_beli->total==null?0:(int) $transaksi_beli->total;


        }

        $result = [
            'days' => $days,
            'data' => [
                [
                    'name' => 'Pembelian',
                    'data' => $arr_data_date_beli
                ]
            ],
        ];
        return $result;
    }

    public function getDataYear($year){
        $arr_data_month_beli = [];
        $arr_data_month_service = [];

        for ($i=1; $i <=12 ; $i++) {
            $transaksi_beli = Transaksi::select(DB::raw('SUM(total_harga) total'))
                    ->where('jenis','beli')
                    ->where('status','done')
                    ->whereMonth('created_at', '=', $i)
                    ->whereYear('created_at', '=', $year)
                    ->get()->first();
            if($transaksi_beli->total==null){
                $arr_data_month_beli[] = 0;
            }else{
                $arr_data_month_beli[] = (int) $transaksi_beli->total;
            }
        }

        for ($i=1; $i <=12 ; $i++) {
            $transaksi_service = Transaksi::select(DB::raw('SUM(total_harga) total'))
                    ->where('jenis','service')
                    ->where('status','done')
                    ->whereMonth('created_at', '=', $i)
                    ->whereYear('created_at', '=', $year)
                    ->get()->first();
            if($transaksi_service->total==null){
                $arr_data_month_service[] = 0;
            }else{
                $arr_data_month_service[] = (int) $transaksi_service->total;
            }
        }

        $result = [
            [
                'name' => 'Pembelian',
                'data' => $arr_data_month_beli
            ],
            [
                'name' => 'Jasa Service',
                'data' => $arr_data_month_service
            ]
        ];


        return $result;
    }

    public function getCountYear($year){
        $arr_data_month_beli = [];
        $arr_data_month_service = [];

        for ($i=1; $i <=12 ; $i++) {
            $transaksi_beli = Transaksi::select(DB::raw('COUNT(total_harga) total'))
                    ->where('jenis','beli')
                    ->where('status','done')
                    ->whereMonth('created_at', '=', $i)
                    ->whereYear('created_at', '=', $year)
                    ->get()->first();
            if($transaksi_beli->total==null){
                $arr_data_month_beli[] = 0;
            }else{
                $arr_data_month_beli[] = (int) $transaksi_beli->total;
            }
        }

        for ($i=1; $i <=12 ; $i++) {
            $transaksi_service = Transaksi::select(DB::raw('COUNT(total_harga) total'))
                    ->where('jenis','service')
                    ->where('status','done')
                    ->whereMonth('created_at', '=', $i)
                    ->whereYear('created_at', '=', $year)
                    ->get()->first();
            if($transaksi_service->total==null){
                $arr_data_month_service[] = 0;
            }else{
                $arr_data_month_service[] = (int) $transaksi_service->total;
            }
        }

        $result = [
            [
                'name' => 'Pembelian',
                'data' => $arr_data_month_beli
            ],
            [
                'name' => 'Jasa Service',
                'data' => $arr_data_month_service
            ]
        ];


        return $result;
    }

    public function montirMonth($month, $year){
        $data_montir = Montir::all();
        $result_montir = [];

        $last_day = (int) date('t', strtotime($year.'-'.$month.'-'.'1'));
        $days = [];
        for ($i=1; $i <= $last_day ; $i++) {
            $days[] = $i;
        }
        foreach ($data_montir as $data) {

            $arr_service = [];
            for ($i=1; $i <= $last_day ; $i++) {

                $transaksi_service = Transaksi::select(DB::raw('COUNT(*) total'))
                    ->where('jenis','service')
                    ->where('status','done')
                    ->where('id_montir', $data->id)
                    ->whereDate('created_at', '=', date('Y-m-d', strtotime($year.'-'.$month.'-'.$i)))
                    ->get()->first();

                $arr_service[] = $transaksi_service->total;
            }

            $result_montir[] = [
                'name' => $data->nama,
                'data' => $arr_service
            ];
        }

        $result = [
            'days' => $days,
            'data' => $result_montir
        ];

        return $result;
    }


    public function montirYear($year){
        $data_montir = Montir::all();
        $result_montir = [];


        foreach ($data_montir as $data) {

            $arr_service = [];
            for ($i=1; $i <= 12 ; $i++) {

                $transaksi_service = Transaksi::select(DB::raw('COUNT(*) total'))
                    ->where('jenis','service')
                    ->where('status','done')
                    ->where('id_montir', $data->id)
                    ->whereYear('created_at','=',$year)
                    ->whereMonth('created_at','=',$i)
                    ->get()->first();

                $arr_service[] = $transaksi_service->total;
            }

            $result_montir[] = [
                'name' => $data->nama,
                'data' => $arr_service
            ];
        }



        return $result_montir;
    }
}
