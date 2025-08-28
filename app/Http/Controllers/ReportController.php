<?php

namespace App\Http\Controllers;

use App\Models\report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    
   

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nomor = 1;
        $rep = report::all();
    
        // Hitung total pendapatan (misal dari kolom 'jumlah' di tabel report)
        $totalPendapatan = $rep->sum('jumlah'); // atau 'jual * qty'
    
        // Ambil total hutang dari tabel hutang
        $totalHutang = \App\Models\Hutang::sum('jumlah_hutang');
    
        // Hitung total modal dari kolom harga beli * qty (jika ada kolom 'modal')
        $modal = $rep->sum('modal'); // pastikan ini sesuai dengan kolom Anda
    
        // Hitung laba kotor
        $labaKotor = $totalPendapatan - $modal ;
    
        // Hitung zakat (2.5%)
        $zakat = $labaKotor * 0.025;
    
        // Hitung laba bersih
        $labaBersih = $labaKotor - $zakat -$totalHutang;
    
        return view('report.index', compact(
            'nomor',
            'rep',
            'totalPendapatan',
            'totalHutang',
            'labaKotor',
            'zakat',
            'labaBersih'
        ));
    }
    

public function print()
{
    $reports = Report::all();
    return view('report.print', compact('reports'));
}
public function sinkron()
{
    DB::table('reports')->truncate(); // kosongkan dulu kalau mau reset

    $penjualans = DB::table('penjualan_details')
        ->join('penjualans', 'penjualan_details.id_penjualan', '=', 'penjualans.id_penjualan')
        ->join('barangs', 'penjualan_details.id_brg', '=', 'barangs.id_brg')
        ->join('merks', 'barangs.id_merk', '=', 'merks.id_merk')
        ->join('jenis_barangs', 'barangs.id_jenis', '=', 'jenis_barangs.id_jenis')
        ->join('pembelian_details', 'penjualan_details.id_brg', '=', 'pembelian_details.id_brg') // ambil harga beli
        ->select(
            'penjualan_details.id_brg',
            'barangs.id_jenis',
            'barangs.id_merk',
            'jenis_barangs.jenis_brg',
            'merks.nm_merk',
            'barangs.nm_brg',
            DB::raw('MAX(pembelian_details.hrg_beli) as hrg_beli'), // ambil harga beli terakhir/tertinggi
            DB::raw('MAX(penjualan_details.hrg_jual) as hrg_jual'), // ambil harga jual terakhir
            DB::raw('SUM(penjualan_details.qty) as total_qty')
        )
        ->groupBy(
            'penjualan_details.id_brg',
            'barangs.id_jenis',
            'barangs.id_merk',
            'jenis_barangs.jenis_brg',
            'merks.nm_merk',
            'barangs.nm_brg'
        )
        ->get();

    foreach ($penjualans as $data) {
        $jumlah = $data->hrg_jual * $data->total_qty;
        $modal = $data->hrg_beli * $data->total_qty;
        $laba = $jumlah - $modal;
        $zakat = $laba * 0.025;
        $total_hutang = DB::table('hutangs')->where('id_brg', $data->id_brg)->sum('jumlah_hutang');
        $laba_bersih = $laba - $zakat - $total_hutang;

        DB::table('reports')->insert([
            'id_brg' => $data->id_brg,
            'id_jenis' => $data->id_jenis,
            'id_merk' => $data->id_merk,
            'jenis_brg' => $data->jenis_brg,
            'nm_merk' => $data->nm_merk,
            'nm_brg' => $data->nm_brg,
            'hrg_beli' => $data->hrg_beli,
            'hrg_jual' => $data->hrg_jual,
            'qty' => $data->total_qty,
            'jumlah' => $jumlah,
            'modal' => $modal,
            'laba' => $laba,
            'zakat' => $zakat,
            'laba_bersih' => $laba_bersih,
        ]);
    }

    return redirect()->back()->with('success', 'Report berhasil disinkronkan');
}
     

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
