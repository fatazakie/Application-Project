<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nomor =1;
        $pen = Penjualan::all();
        return view('penjualan.index',compact('nomor','pen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penjualan.form');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pen = new Penjualan();
        $pen->kode = $request->kode; 
        $pen->merk = $request->merk; 
        $pen->nama = $request->nama;
        $pen->jual = $request->jual;
        $pen->qty =$request->qty;
        $pen->save();

        return redirect('/penjualan/');
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
        $pen =Penjualan::find($id);
        return view('penjualan.edit',compact('pen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pen =Penjualan::find($id);

        $pen->kode = $request->kode; 
        $pen->merk = $request->merk; 
        $pen->nama =$request->nama;
        $pen->jual =$request->jual;
        $pen->qty =$request->qty;
        $pen->save();

        return redirect('/penjualan/');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pen = Penjualan::find($id);
        $pen->delete();
        return redirect('/penjualan/');
    }
}
