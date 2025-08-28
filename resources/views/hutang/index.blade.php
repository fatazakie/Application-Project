@extends('layouts.master')
@section('title','Halaman Hutang')
@section('heading','Halaman Hutang')

@section('content')
<div class="card">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item ms-3"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Hutang</li>
    </ol>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-header">
        <a href="/hutang/form/" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data Hutang</a>
    </div>
    <div class="container-fluid">
        <div class="card shadow mb-4 mt-2">
            <div class="card py-3 ms-3">
                <h6 class="m-0 font-weight-bold text-primary ms-3">Tabel Hutang</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="DataTable" width="100%" cellspacing="1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Hutang</th>
                                <th>Tanggal Hutang</th>
                                <th>Merk</th>
                                <th>Nama Barang</th>
                                <th>Jenis</th>
                                <th>Jumlah Hutang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hut as $item )
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $item->id_hutang }}</td>
                                    <td>{{ $item->tgl_hutang }}</td>
                                    <td>{{ $item->merk->nm_merk ?? '-' }}</td>
                                    <td>{{ $item->barang->nm_brg ?? '-' }}</td>
                                    <td>{{ $item->jenis->jenis_brg ?? '-' }}</td>
                                    <td>{{ number_format($item->jumlah_hutang, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="/hutang/edit/{{$item->id}}" class="btn btn-info btn-sm">
                                            <em class="fa fa-pencil-alt"></em>
                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus{{$item->id}}">
                                            <em class="fa fa-trash"></em>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="hapus{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan</h1>
                                                        <a href="/hutang" class="btn-close" data-dismiss="modal" aria-label="Close"></a>
                                                    </div>
                                                    <div class="modal-body">
                                                        Yakin data hutang {{ $item->barang->nm_brg ?? '-' }} ingin dihapus?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="/hutang" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                                                        <form action="/hutang/{{$item->id}}" method="POST">
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
                            @empty
                                <tr>
                                    <td colspan="8">Tidak Ada Data</td>
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

@section('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script>
    $(function () {
        $('#DataTable').DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#DataTable_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
