@extends('layouts.master')
@section('title','Edit Pembelian')
@section('judul','Edit Pembelian')

@section('bc')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/pembelian">Data Pembelian</a></li>
        <li class="breadcrumb-item active">Edit Pembelian</li>
    </ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-tools">
            <a href="/pembelian/" class="btn-close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross-sm"></em>
            </a>
        </div>
    </div>
    <div class="card-body">
        
        <form method="POST" action="{{ route('pembelian.update', $pem->id_pembelian) }}">
            @csrf
            @method('PUT')
        
        
            @foreach($pem->details as $i => $detail)
            <div class="barang-row mb-3 border p-3 rounded">
                <div class="mb-2">
                    <label>Pilih Barang</label>
                    <select name="items[{{ $i }}][id_brg]" class="form-control">
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id_brg }}" {{ $barang->id_brg == $detail->id_brg ? 'selected' : '' }}>
                                {{ $barang->nm_brg }}
                            </option>
                        @endforeach
                    </select>
                </div>
        
                <div class="mb-2">
                    <label>Pilih Merk</label>
                    <select name="items[{{ $i }}][id_merk]" class="form-control">
                        @foreach ($merks as $merk)
                            <option value="{{ $merk->id_merk }}" {{ $merk->id_merk == $detail->id_merk ? 'selected' : '' }}>
                                {{ $merk->nm_merk }}
                            </option>
                        @endforeach
                    </select>
                </div>
        
                <div class="mb-2">
                    <label>Pilih Jenis</label>
                    <select name="items[{{ $i }}][id_jenis]" class="form-control">
                        @foreach ($jenis as $j)
                            <option value="{{ $j->id_jenis }}" {{ $j->id_jenis == $detail->id_jenis ? 'selected' : '' }}>
                                {{ $j->jenis_brg }}
                            </option>
                        @endforeach
                    </select>
                </div>
        
                <div class="mb-2">
                    <label>Harga Jual</label>
                    <input type="number" name="items[{{ $i }}][hrg_beli]" class="form-control" value="{{ $detail->hrg_beli }}" readonly>
                </div>
        
                <div class="mb-2">
                    <label>Qty</label>
                    <input type="number" name="items[{{ $i }}][qty]" class="form-control" value="{{ $detail->qty }}">
                </div>
            </div>
            @endforeach
        
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
            </div>
</div>
@endsection
