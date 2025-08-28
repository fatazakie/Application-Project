<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Merk;
use App\Models\JenisBarang;

class PenjualanController extends Controller
{
    public function index()
    {
        $nomor = 1;
        $pen  = Penjualan::with('details.barang','details.merk','details.jenis')->get();    
        return view('penjualan.index', compact('pen', 'nomor'));
    }

    public function create()
    {
        $barangs = Barang::all();
        $merks   = Merk::all();
        $jenis   = JenisBarang::all();
    
        return view('penjualan.form', compact('barangs', 'merks', 'jenis'));
    }
    
    

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.id_brg' => 'required|exists:barangs,id_brg',
            'items.*.qty' => 'required|integer|min:1',
        ]);
    
        DB::beginTransaction();
        try {
            // Buat header penjualan
            $penjualan = Penjualan::create([
                'id_penjualan' => 'PJ-' . time(),
                'tgl_penjualan' => $request->tgl_penjualan ?? now(),
            ]);
    
            // Loop barang yang dibeli
            foreach ($request->items as $item) {
                $barang = Barang::find($item['id_brg']);
    
                if (!$barang) {
                    throw new \Exception("Barang tidak ditemukan.");
                }
                if ($item['qty'] > $barang->qty) {
                    throw new \Exception("Stok barang {$barang->nm_brg} tidak cukup.");
                }
    
                // Insert ke detail
                $penjualan->details()->create([
                    'id_brg'   => $barang->id_brg,
                    'id_merk'  => $barang->id_merk,
                    'id_jenis' => $barang->id_jenis,
                    'hrg_jual' => $barang->hrg_jual,
                    'qty'      => $item['qty'],
                ]);
    
                // Kurangi stok
                $barang->qty -= $item['qty'];
                $barang->save();
            }
    
            DB::commit();
            return redirect('/penjualan')->with('success', 'Penjualan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
    
    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.id_brg' => 'required|exists:barangs,id_brg',
            'items.*.qty' => 'required|integer|min:1',
        ]);
    
        $penjualan = Penjualan::with('details')->findOrFail($id);
    
        DB::beginTransaction();
        try {
            // Kembalikan stok lama
            foreach ($penjualan->details as $detail) {
                $barang = Barang::find($detail->id_brg);
                if ($barang) {
                    $barang->qty += $detail->qty;
                    $barang->save();
                }
            }
    
            // Hapus detail lama
            $penjualan->details()->delete();
    
            // Simpan detail baru dan kurangi stok
            foreach ($request->items as $item) {
                $barang = Barang::find($item['id_brg']);
                if (!$barang) {
                    throw new \Exception("Barang tidak ditemukan.");
                }
                if ($item['qty'] > $barang->qty) {
                    throw new \Exception("Stok barang {$barang->nm_brg} tidak cukup.");
                }
    
                $penjualan->details()->create([
                    'id_brg'   => $barang->id_brg,
                    'id_merk'  => $barang->id_merk,
                    'id_jenis' => $barang->id_jenis,
                    'hrg_jual' => $item['hrg_jual'],
                    'qty'      => $item['qty'],
                ]);
    
                $barang->qty -= $item['qty'];
                $barang->save();
            }
            
            DB::commit();
            return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil diperbarui.');            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
    
    
    public function edit($id)
    {
        $pen = Penjualan::with('details')->findOrFail($id); // ambil header beserta detail
        $barangs = Barang::all();
        $merks   = Merk::all();
        $jenis   = JenisBarang::all();
    
        return view('penjualan.edit', compact('pen', 'barangs', 'merks', 'jenis'));
    }
    
    


   public function destroy($id)
{
    $penjualan = Penjualan::findOrFail($id);

    // kalau ada relasi ke details, hapus dulu
    $penjualan->details()->delete();

    $penjualan->delete();

    return redirect()->route('penjualan.index')->with('success', 'Data Penjualan berhasil dihapus');
}


}
