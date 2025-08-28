<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\Merk;
use App\Models\JenisBarang;

class PembelianController extends Controller
{
    public function index()
    {
        $nomor = 1;
        $pem = Pembelian::with('details.barang','details.merk','details.jenis')->get();
        return view('pembelian.index', compact('pem', 'nomor'));
    }

    public function create()
    {
        $barangs = Barang::all();
        $merks   = Merk::all();
        $jenis   = JenisBarang::all();
        return view('pembelian.form', compact('barangs', 'merks', 'jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items.*.id_jenis' => 'required|exists:jenis_barangs,id_jenis',
            'items.*.id_brg'   => 'required|exists:barangs,id_brg',
            'items.*.id_merk'  => 'required|exists:merks,id_merk',
            'items.*.hrg_beli' => 'required|numeric|min:0',
            'items.*.qty'      => 'required|integer|min:1',
        ]);
        
    
        DB::beginTransaction();
        try {
            $idPembelian = 'PB-' . time();
        
            // simpan master
            $pembelian = Pembelian::create([
                'id_pembelian' => $idPembelian,
                'tgl_pembelian'=> $request->tgl_pembelian,
            ]);
        
            foreach ($request->items as $item) {
                // simpan detail melalui relasi
                $pembelian->details()->create([
                    'id_brg'   => $item['id_brg'],
                    'id_merk'  => $item['id_merk'],
                    'id_jenis' => $item['id_jenis'],
                    'qty'      => $item['qty'],
                    'hrg_beli' => $item['hrg_beli'],
                ]);
        
                // update stok barang jika perlu
                $barang = Barang::where('id_brg', $item['id_brg'])->first();
                if ($barang) {
                    $barang->qty += $item['qty'];
                    $barang->save();
                }
            }
        
            DB::commit();
            return redirect()->route('pembelian.index')->with('success','Pembelian berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error','Terjadi kesalahan: '.$e->getMessage());
        }
    }        

    public function edit($id)
    {
        $pem = Pembelian::with('details')->findOrFail($id);
        $barangs = Barang::all();
        $merks   = Merk::all();
        $jenis   = JenisBarang::all();
        return view('pembelian.edit', compact('pem', 'barangs', 'merks', 'jenis'));
    }

    public function update(Request $request, $id)
    {
        $pembelian = Pembelian::with('details')->findOrFail($id);

        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.id_brg'  => 'required|exists:barangs,id_brg',
            'items.*.qty'     => 'required|integer|min:1',
            'items.*.hrg_beli'=> 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Kembalikan stok lama
            foreach ($pembelian->details as $detail) {
                $barang = Barang::find($detail->id_brg);
                if ($barang) {
                    $barang->qty -= $detail->qty;
                    if ($barang->qty < 0) $barang->qty = 0;
                    $barang->save();
                }
            }

            // Hapus detail lama
            $pembelian->details()->delete();

            // Simpan detail baru & update stok
            foreach ($request->items as $item) {
                $barang = Barang::find($item['id_brg']);
                if (!$barang) {
                    throw new \Exception("Barang tidak ditemukan.");
                }

                $pembelian->details()->create([
                    'id_brg'   => $barang->id_brg,
                    'id_merk'  => $barang->id_merk,
                    'id_jenis' => $barang->id_jenis,
                    'hrg_beli' => $item['hrg_beli'],
                    'qty'      => $item['qty'],
                ]);

                $barang->qty += $item['qty'];
                $barang->save();
            }

            DB::commit();
            return redirect('/pembelian')->with('success', 'Data pembelian berhasil diperbarui dan stok diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    
   public function destroy($id)
   {
       $pembelian = Pembelian::findOrFail($id);
   
       // kalau ada relasi ke details, hapus dulu
       $pembelian->details()->delete();
   
       $pembelian->delete();
   
       return redirect()->route('pembelian.index')->with('success', 'Data Pembelian berhasil dihapus');
   }
   
   
   }
