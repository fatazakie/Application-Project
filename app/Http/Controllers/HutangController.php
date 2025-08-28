<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hutang;
use App\Models\Barang;
use App\Models\Merk;
use App\Models\JenisBarang;

class HutangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hut = Hutang::with(['merk', 'jenis', 'barang'])->get();
        $nomor = 1;
        return view('hutang.index', compact('hut', 'nomor'));
    }
    
    public function create()
{
    $barangs = Barang::all();
    $merks = Merk::all();
    $jenis = JenisBarang::all();

    return view('hutang.form', compact('barangs', 'merks', 'jenis'));
}

    
    public function store(Request $request)
    {
        $request->validate([
            'id_brg' => 'required|exists:barangs,id_brg',
            'id_merk' => 'required|exists:merks,id_merk',
            'id_jenis' => 'required|exists:jenis_barangs,id_jenis',
            'jumlah_hutang' => 'required|integer|min:1',
        ]);
    
        Hutang::create([
            'id_hutang' => 'HT-' . time(),
            'tgl_hutang' => $request->tgl_hutang,
            'id_brg' => $request->id_brg,
            'id_merk' => $request->id_merk,
            'id_jenis' => $request->id_jenis,
            'jumlah_hutang' => $request->jumlah_hutang,
        ]);
    
        return redirect('/hutang')->with('success', 'Data hutang berhasil disimpan');
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
    public function edit($id)
    {
        $hutang = Hutang::findOrFail($id);
        $barangs = Barang::all();
        $merks = Merk::all();
        $jenis = JenisBarang::all();
    
        return view('hutang.edit', compact('hutang', 'barangs', 'merks', 'jenis'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'id_brg' => 'required',
        'id_merk' => 'required',
        'id_jenis' => 'required',
        'jumlah_hutang' => 'required|numeric|min:1',
    ], [
        'jumlah_hutang.min' => 'Jumlah hutang tidak boleh nol.',
    ]);

    $hutang = Hutang::findOrFail($id);
    $hutang->id_brg = $request->id_brg;
    $hutang->id_merk = $request->id_merk;
    $hutang->id_jenis = $request->id_jenis;
    $hutang->jumlah_hutang = $request->jumlah_hutang;
    $hutang->save();

    return redirect('/hutang')->with('success', 'Data hutang berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hutang = Hutang::findOrFail($id);
        $hutang->delete();
    
        return redirect('/hutang')->with('success', 'Data hutang berhasil dihapus.');
    }
    
}
