@extends('layouts.master')
@section('title','Edit Barang')
@section('judul','Edit Barang')
@section('bc')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/barang">Data Barang</a></li>
        <li class="breadcrumb-item active">Edit Barang</li>
    </ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-tools">
            <a href="/barang/" class="btn-close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross-sm"></em>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="/barang/{{ $bar->id_brg }}">

            @method('PUT')
            @csrf
            <div class="mb-3">
                <label class="form-label">ID Barang</label>
                <input type="text" readonly value="{{$bar->id_brg}}" class="form-control" name="id_brg">
            </div>
            <div class="mb-3">
                <label class="form-label">ID Jenis</label>
                <input type="text" value="{{$bar->id_jenis}}" class="form-control" name="id_jenis">
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Barang</label>
                <input type="text" value="{{$bar->jenis_brg}}" class="form-control" name="jenis_brg">
            </div>
            <div class="mb-3">
                <label class="form-label">ID Merk</label>
                <input type="text" value="{{$bar->id_merk}}" class="form-control" name="id_merk">
            </div>
            <div class="mb-3">
                <label class="form-label">Merk Barang</label>
                <input type="text" value="{{$bar->nm_merk}}" class="form-control" name="nm_merk">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" value="{{$bar->nm_brg}}" class="form-control" name="nm_brg">
            </div>
            <div class="mb-3">
                <label class="form-label">Harga Beli</label>
                <input type="number" value="{{$bar->hrg_beli}}" class="form-control" name="hrg_beli">
            </div>
            <div class="mb-3">
                <label class="form-label">Harga Jual</label>
                <input type="number" value="{{$bar->hrg_jual}}" class="form-control" name="hrg_jual">
            </div>
            <div class="mb-3">
                <label class="form-label">QTY</label>
                <input type="number" value="{{$bar->qty}}" class="form-control" name="qty">
            </div>
            <button type="submit" class="btn btn-primary">Edit Data</button>
        </form>
    </div>
</div>
@endsection
