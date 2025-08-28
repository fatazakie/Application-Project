@extends('layouts.master')
@section('title','Halaman Report')
@section('heading','Halaman Report')


@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


@section('content')
    <div class="card">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item ms-3"><a href="/">Dashboard</a></li>
          </ol>
        {{-- <div class="card-header">
            <a href="/report/form/" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
        </div> --}}
        <div class="container-fluid">

            <!-- Page Heading -->
            {{-- <h1 class="h3 mb-2 text-gray-800">Tabel Barang</h1> --}}
            <!-- DataTales Example -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3 ">
                    <h2>Laporan Report</h2>
                    <a href="{{ route('report.print') }}" class="btn btn-primary" target="_blank">Print</a>
                   
                </div>
                <div class="card-body">
                    <a href="{{ route('report.sinkron') }}" class="btn btn-primary mb-3">
                        <i class="fa fa-sync-alt"></i> Sinkronkan Data Report
                    </a>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered" id="DataTable" width="100%" cellspacing="1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Jenis Barang</th>
                                    <th>Merk Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Modal Barang</th>
                                    <th>Harga Jual</th>
                                    <th>QTY</th>
                        
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rep as $item )
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $item->id_brg }}</td>
                                    <td>{{ $item->jenis_brg }}</td>
                                    <td>{{ $item->nm_merk }}</td>
                                    <td>{{ $item->nm_brg }}</td>
                                    <td>{{ number_format($item->hrg_beli, 0, ',', '.') }}</td>
                                    <td>{{ number_format($item->modal, 0, ',', '.') }}</td>
                                    <td>{{ number_format($item->hrg_jual, 0, ',', '.') }}</td>
                                    <td>{{ $item->qty }}</td>
                                    
                                    
                                    {{-- <td>
                                        <a href="/report/edit/{{$item->id}}" class="btn btn-info btn-sm"><em class="fa fa-pencil-alt"></em></a>

                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus{{$item->id}}">
                                    <em class="fa fa-trash"></em>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="hapus{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan</h1>
                                        <a href="barang" class="btn-close" data-dismiss="modal" aria-label="Close"></a>
                                        </div>
                                        <div class="modal-body">
                                        Yakin Data Barang {{$item->nama}} {{$item->merk}} Ingin Dihapus?
                                        </div>
                                        <div class="modal-footer">
                                        <a href="barang" class="btn btn-secondary" data-dismiss="modal">Batal</a>
                                        <form action="/report/{{$item->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            
                                            <button type="submit" class="btn btn-primary">Hapus</button>
                                        </form>

                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                            </td> --}}
                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">Tidak Ada Data</td>
                        </tr>
                        @endforelse
                        </tbody>
                        <table class="table table-bordered mt-4">
                            <thead class="bg-light">
                                <tr>
                                    <th>Total Pendapatan</th>
                                    <th>Hutang</th>
                                    <th>Laba Kotor</th>
                                    <th>Zakat (2.5%)</th>
                                    <th>Laba Bersih</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($totalHutang, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($labaKotor, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($zakat, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($labaBersih, 0, ',', '.') }}</td>
                                </tr>
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
            $("#DataTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#DataTable_wrapper .col-md-6:eq(0)');
        });
    </script>
    
@endsection