
@extends('layouts.master')
@section('title','Halaman Penjualan')
@section('heading','Halaman Penjualan')

@section('content')
    <div class="card">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item ms-3"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Penjualan</li>

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
            <a href="/penjualan/form/" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data Penjualan</a>
        </div>
        <div class="container-fluid">

            <!-- Page Heading -->
            {{-- <h1 class="h3 mb-2 text-gray-800">Tabel Penjualan</h1> --}}
            <!-- DataTales Example -->
            <div class="card shadow mb-4 mt-2">
                <div class="card py-3 ms-3">
                    <h6 class="m-0 font-weight-bold text-primary ms-3">Tabel Penjualan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1" width="100%" cellspacing="1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Penjualan</th>
                                    <th>Tanggal Penjualan</th>
                                    <th>Merk Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Harga jual</th>
                                    <th>QTY</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pen as $item )
                                @foreach ($item->details as $detail)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $item->id_penjualan }}</td>
                                        <td>{{ $item->tgl_penjualan }}</td>
                                        <td>{{ $detail->merk->nm_merk ?? '-' }}</td>
                                        <td>{{ $detail->barang->nm_brg ?? '-' }}</td>
                                        <td>{{ $detail->jenis->jenis_brg ?? '-' }}</td>
                                        <td>Rp {{ number_format($detail->hrg_jual, 0, ',', '.') }}</td>
                                        <td>{{ $detail->qty }}</td>
                                        <td>  <a href="{{ route('penjualan.edit', $item->id_penjualan) }}" class="btn btn-warning btn-sm">  <i class="fa fa-pencil-alt"></i></a>
                                          
                                        </a> </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus{{$item->id}}">
                                                <i class="fa fa-trash"></i>
                                            </button> </td>
                                
                                
                                        <!-- Modal -->
                                        <div class="modal fade" id="hapus{{ $item->id}}" tabindex="-1" aria-labelledby="hapusLabel{{ $item->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Yakin Data Penjualan {{ $item->barang->nm_brg ?? '-' }} ingin dihapus?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="/penjualan" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                                                        <form action="/penjualan/{{$item->id_penjualan}}" method="POST">
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
                            <td colspan="4">Tidak Ada Data</td>
                        </tr>
                        @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-footer-->
    </div>
@endsection


@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('js')
    <!-- DataTables  & Plugins -->
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

    <!-- Page specific script -->
    <script>
        $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        });
    </script>
@endsection