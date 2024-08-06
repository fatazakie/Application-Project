@extends('layouts.master')
@section('title','Edit Penjualan')
@section('judul','Edit Penjualan')
@section('bc')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Data Penjualan</a></li>
        <li class="breadcrumb-item active">Edit Penjualan</li>
    </ol>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">


        <div class="card-tools">
        </div>
        </div>
        <div class="card-body">
            <form method="POST" action="/penjualan/{{$pen->id}}">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label class="form-label">Kode</label>
                    <input type="text" readonly value="{{$pen->kode}}" class="form-control" name="kode">
                </div>
                <div class="mb-3">
                    <label class="form-label">Merk</label>
                    <input type="text"  value="{{$pen->merk}}" class="form-control" name="merk">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" value="{{$pen->nama}}" class="form-control" name="nama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga Jual</label>
                    <input type="text" value="{{$pen->jual}}" class="form-control" name="jual">
                </div>
                <div class="mb-3">
                    <label class="form-label">QTY</label>
                    <input type="number" value="{{$pen->qty}}" class="form-control" name="qty">
                </div>
                
                <button type="submit" class="btn btn-primary">Edit Data</button>
            </form>
        </div>
        <!-- /.card-body -->
        {{-- <div class="card-footer">
        Footer
        </div> --}}
        <!-- /.card-footer-->
    </div>
@endsection