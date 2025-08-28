@extends('layouts.master')
@section('title','Tambah Hutang')
@section('heading','Form Tambah Data Hutang')

@section('bc')
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Hutang</li>
    </ol>
</div>
@endsection


@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-tools">
            <a href="/hutang/" class="btn-close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross-sm"></em>
            </a>
        </div>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('hutang.store') }}">
            @csrf
            <div class="mb-3">
                <label for="id_hutang" class="form-label">ID Hutang</label>
                <input type="text" name="id_hutang" class="form-control" value="{{ old('id_hutang') }}">
            </div>

            <div class="mb-3">
                <label for="tgl_hutang" class="form-label">Tanggal Pembelian</label>
                <input type="date" name="tgl_hutang" class="form-control" value="{{ old('tgl_hutang') }}">
            </div>
            <div class="mb-3">
                <label for="id_merk" class="form-label">Merk</label>
                <select name="id_merk" class="form-control" required>
                    <option value="">-- Pilih Merk --</option>
                    @foreach ($merks as $merk)
                        <option value="{{ $merk->id_merk }}" {{ old('id_merk') == $merk->id_merk ? 'selected' : '' }}>
                            {{ $merk->nm_merk }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="id_jenis" class="form-label">Jenis Barang</label>
                <select name="id_jenis" class="form-control" required>
                    <option value="">-- Pilih Jenis --</option>
                    @foreach ($jenis as $j)
                        <option value="{{ $j->id_jenis }}" {{ old('id_jenis') == $j->id_jenis ? 'selected' : '' }}>
                            {{ $j->jenis_brg }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="id_brg" class="form-label">Nama Barang</label>
                <select name="id_brg" class="form-control" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id_brg }}" {{ old('id_brg') == $barang->id_brg ? 'selected' : '' }}>
                            {{ $barang->nm_brg }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="jumlah_hutang" class="form-label">Jumlah Hutang</label>
                <input type="number" name="jumlah_hutang" value="{{ old('jumlah_hutang') }}" class="form-control" min="1" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/hutang" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
