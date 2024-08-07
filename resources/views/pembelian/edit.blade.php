@extends('layouts.master')
@section('title','Edit Pembelian')
@section('judul','Edit Pembelian')
@section('bc')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Data Pembelian</a></li>
        <li class="breadcrumb-item active">Edit Pembelian</li>
    </ol>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">


        <div class="card-tools">
          <a href="/pembelian/" class="btn-close" data-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross-sm"></em></a>

        </div>
        </div>
        <div class="card-body">
            <form method="POST" action="/pembelian/{{$pem->id}}">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label class="form-label">Kode</label>
                    <input type="text" readonly value="{{$pem->kode}}" class="form-control" name="kode">
                </div>
                <div class="mb-3">
                    <label class="form-label">Merk</label>
                    <input type="text"  value="{{$pem->merk}}" class="form-control" name="merk">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" value="{{$pem->nama}}" class="form-control" name="nama">
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga Beli</label>
                    <input type="text" value="{{$pem->beli}}" class="form-control" name="beli">
                </div>
                <div class="mb-3">
                    <label class="form-label">QTY</label>
                    <input type="number" value="{{$pem->qty}}" class="form-control" name="qty">
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