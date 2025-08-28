@extends('layouts.master')

@section('title','Halaman Barang')
@section('heading','Halaman Barang')

@section('content')
<div class="card">
    <ol class="breadcrumb float-sm-right mt-3 me-3">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Barang</li>
    </ol>
    <div class="card-header">
        <a href="/barang/form" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
    </div>
    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Tabel Pembelian</h1> --}}
        <!-- DataTales Example -->
        <div class="card shadow mb-4 mt-2">
            <div class="card py-3 ms-3">
                <h6 class="m-0 font-weight-bold text-primary ms-3">Tabel Pembelian</h6>
            </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="DataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Barang</th>
                        <th>Jenis Barang</th>
                        <th>Merk Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>QTY</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $nomor = 1; @endphp
                    @forelse ($bar as $item)
                    <tr>
                        <td>{{ $nomor++ }}</td>
                        <td>{{ $item->id_brg }}</td>
                        <td>{{ $item->jenis_brg }}</td>
                        <td>{{ $item->nm_merk }}</td>
                        <td>{{ $item->nm_brg }}</td>
                        <td>Rp {{ number_format($item->hrg_beli, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->hrg_jual, 0, ',', '.') }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>
                            <a href="/barang/edit/{{ $item->id_brg }}" class="btn btn-info btn-sm">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id_brg }}">
                                <i class="fa fa-trash"></i>
                            </button>

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="hapus{{ $item->id_brg }}" tabindex="-1" aria-labelledby="hapusLabel{{ $item->id_brg }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Yakin ingin menghapus <strong>{{ $item->nm_brg }}</strong>? {{-- darimerk<strong>$item->nm_merk </strong>? --}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="/barang/{{ $item->id_brg }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data barang</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('js')
<!-- DataTables & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(function () {
        $('#DataTable').DataTable({
            responsive: true,
            autoWidth: false,
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']
        }).buttons().container().appendTo('#DataTable_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
