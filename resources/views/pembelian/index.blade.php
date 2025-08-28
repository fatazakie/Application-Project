@extends('layouts.master')
@section('title','Halaman Pembelian')
@section('heading','Halaman Pembelian')

@section('content')
<div class="card">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item ms-3"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Pembelian</li>
    </ol>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="card-header">
        <a href="{{ route('pembelian.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Tambah Data Pembelian
        </a>
    </div>

    <div class="container-fluid mt-2">
        <div class="card shadow mb-4">
            <div class="card py-3 ms-3">
                <h6 class="m-0 font-weight-bold text-primary ms-3">Tabel Pembelian</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="DataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Pembelian</th>
                                <th>Tanggal Pembelian</th>
                                <th>Merk Barang</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Harga Beli</th>
                                <th>QTY</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pem as $item )
                                @foreach ($item->details as $detail)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $item->id_pembelian }}</td>
                                        <td>{{ $item->tgl_pembelian }}</td>
                                        <td>{{ $detail->merk->nm_merk ?? '-' }}</td>
                                        <td>{{ $detail->barang->nm_brg ?? '-' }}</td>
                                        <td>{{ $detail->jenis->jenis_brg ?? '-' }}</td>
                                        <td>Rp {{ number_format($detail->hrg_beli, 0, ',', '.') }}</td>
                                        <td>{{ $detail->qty }}</td>
                                        <td> <a href="{{ route('pembelian.edit', $item->id_pembelian) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a> </td>
                                        <td>  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button> </td>
                                

                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="hapus{{ $item->id}}" tabindex="-1" aria-labelledby="hapusLabel{{ $item->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Yakin Data Pembelian ingin dihapus?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                       <form action="/pembelian/{{$item->id_pembelian}}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-primary">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Tidak Ada Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    