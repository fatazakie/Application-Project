<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\Pembelian;
use App\Models\Hutang;
use Illuminate\Support\Facades\DB;
use App\Models\PenjualanDetail;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalBarang = Barang::count();

        // total barang terjual bulan ini (pakai detail)
        $totalPenjualan = PenjualanDetail::whereMonth('created_at', now()->month)->sum('qty');

        // total pembelian masih tetap (kalau belum dipisah header-detail)
        $totalPembelian = Pembelian::whereMonth('tgl_pembelian', now()->month)->sum('qty');

        $totalHutang = Hutang::sum('jumlah_hutang'); 

        // Grafik Penjualan per Bulan (dari detail + join header)
        $penjualanPerBulan = PenjualanDetail::selectRaw('MONTH(penjualans.tgl_penjualan) as bulan, SUM(penjualan_details.qty) as total')
            ->join('penjualans', 'penjualans.id_penjualan', '=', 'penjualan_details.id_penjualan')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $bulanLabels = [];
        $penjualanData = [];

        foreach ($penjualanPerBulan as $data) {
            $bulanLabels[] = \Carbon\Carbon::create()->month($data->bulan)->format('F');
            $penjualanData[] = $data->total;
        }

        // Grafik Stok Menipis
        $stokMenipis = Barang::with('merk')->where('qty', '<', 10)->get();
        $stokLabels = $stokMenipis->map(function ($barang) {
            return $barang->nm_brg . ' - ' . $barang->merk->nm_merk;
        });

        $stokData = $stokMenipis->pluck('qty');

        return view('home', compact(
            'totalBarang',
            'totalPenjualan',
            'totalPembelian',
            'totalHutang',
            'bulanLabels',
            'penjualanData',
            'stokLabels',
            'stokData'
        ));
    }
}
