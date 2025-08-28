<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Merk;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class BarangController extends Controller
{
    public function index()
    {
        $nomor = 1;
        $bar = Barang::all();
        return view('barang.index', compact('nomor', 'bar'));
    }

    public function create()
    {
        return view('barang.form');
    }

    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
        'id_brg'     => 'required|unique:barangs,id_brg',
        'id_merk'    => 'required|string',
        'nm_merk'    => 'required|string',
        'id_jenis'   => 'required|string',
        'jenis_brg'  => 'required|string',
        'nm_brg'     => 'required|string',
        'hrg_beli'  => 'required|numeric|min:0',
        'hrg_jual'  => 'required|numeric|min:0',
        'qty'        => 'required|integer|',
        ]);
    
        // Jika gagal, kirimkan respon JSON error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // // Jika valid, simpan data
        // $bar = new Barang();
        // $bar->id_brg     = $request->id_brg;
        // $bar->id_merk    = $request->id_merk;
        // $bar->id_jenis   = $request->id_jenis;
        // $bar->nm_brg     = $request->nm_brg;
        // $bar->nm_merk    = $request->nm_merk;
        // $bar->jenis_brg  = $request->jenis_brg;
        // $bar->harga_brg  = $request->harga_brg;
        // $bar->qty        = $request->qty;
        

        
        $validated = $validator->validated();

        try {
            // Simpan merk jika belum ada
            Merk::firstOrCreate(
                ['id_merk' => $validated['id_merk']],
                ['nm_merk' => $validated['nm_merk']]
            );
    
            // Simpan jenis jika belum ada
            JenisBarang::firstOrCreate(
                ['id_jenis' => $validated['id_jenis']],
                ['jenis_brg' => $validated['jenis_brg']]
            );
    
            // Simpan barang
            Barang::create($validated);
    
            return response()->json(['success' => 'Data Berhasil Ditambahkan']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

   

    public function edit(string $id)
    {
        $bar = Barang::find($id);
        return view('barang.edit', compact('bar'));
    }

    public function update(Request $request, $id)
    {
        $bar = Barang::find($id);
    
        if (!$bar) {
            return redirect('/barang')->with('error', 'Data tidak ditemukan');
        }
    
        $bar->update($request->only([
            'id_jenis', 'jenis_brg', 'id_merk', 'nm_merk', 'nm_brg', 'hrg_beli','hrg_jual', 'qty'
        ]));
    
        return redirect('/barang')->with('success', 'Data berhasil diupdate');
    }
    

    public function destroy(string $id)
    {
        $bar = Barang::find($id);
        $bar->delete();
        return redirect('/barang/');
    }
}
