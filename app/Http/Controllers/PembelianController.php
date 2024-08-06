<?php

namespace App\Http\Controllers;

use App\Models\pembelian;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nomor =1;
        $pem = Pembelian::all();
        return view('pembelian.index',compact('nomor','pem'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pembelian.form');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pem = new Pembelian();
        $pem->kode = $request->kode; 
        $pem->merk = $request->merk; 
        $pem->nama = $request->nama;
        $pem->beli = $request->beli;
        $pem->qty =$request->qty;
        $pem->save();

        return redirect('/pembelian/');
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
        $pem =Pembelian::find($id);
        return view('pembelian.edit',compact('pem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pem =Pembelian::find($id);

        $pem->kode = $request->kode; 
        $pem->merk = $request->merk; 
        $pem->nama =$request->nama;
        $pem->beli =$request->beli;
        $pem->qty =$request->qty;
        $pem->save();

        return redirect('/pembelian/');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
