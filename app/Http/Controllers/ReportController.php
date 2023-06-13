<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dari = $request->input('dari');
        $sampai = $request->input('sampai');

        if ($dari > $sampai) {
            return response()->json([
                'message' => 'Invalid date range. The starting date must be earlier than or equal to the ending date.'
            ], 422);
        }

        $report = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.id_produk')
            ->selectRaw('nama_produk,  harga, SUM(jumlah) as jumlah_dibeli, SUM(total) as penjualan')
            ->whereDate('order_details.created_at', '>=', $dari)
            ->whereDate('order_details.created_at', '<=', $sampai)
            ->groupBy('id_produk', 'nama_produk', 'harga')
            ->get();

        return response()->json([
            'data' => $report
        ]);
    }

    
}
