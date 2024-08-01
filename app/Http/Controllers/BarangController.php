<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nomor =1;
        $bar = Barang::all();
        return view('barang.index',compact('nomor','bar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.form');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bar = new Barang();
        $bar->kode = $request->kode; 
        $bar->merk = $request->merk; 
        $bar->nama = $request->nama;
        $bar->modal = $request->modal;
        $bar->qty =$request->qty;
        $bar->save();

        return redirect('/barang/');
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
        $bar =Barang::find($id);
        return view('barang.edit',compact('bar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bar =Barang::find($id);

        $bar->kode = $request->kode; 
        $bar->merk = $request->merk; 
        $bar->nama =$request->nama;
        $bar->modal =$request->modal;
        $bar->qty =$request->qty;
        $bar->save();

        return redirect('/barang/');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bar = Barang::find($id);
        $bar->delete();
        return redirect('/barang/');
    }
}
