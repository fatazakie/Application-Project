
@extends('layouts.master')
@section('title','Halaman Barang')
@section('heading','Halaman Barang')

@section('content')
    <div class="card">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item ms-3"><a href="#">Home</a></li>
          </ol>
        <div class="card-header">
            <a href="/barang/form/" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
        </div>
        <div class="container-fluid">

            <!-- Page Heading -->
            {{-- <h1 class="h3 mb-2 text-gray-800">Tabel Barang</h1> --}}
            <!-- DataTales Example -->
            <div class="card shadow mb-4 mt-2">
                <div class="card py-3 ms-3">
                    <h6 class="m-0 font-weight-bold text-primary ms-3">Tabel Barang</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="DataTable" width="100%" cellspacing="1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Merk Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Modal Barang</th>
                                    <th>QTY</th>
                                    <th>Aksi</th>
                        
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bar as $item )
                                <tr>
                                    <td>{{ $nomor++ }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->merk }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->modal }}</td>
                                    <td>{{ $item->qty }}</td>
                                    
                                    <td>
                                        <a href="/barang/edit/{{$item->id}}" class="btn btn-info btn-sm"><em class="fa fa-pencil-alt"></em></a>

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
                                        <form action="/barang/{{$item->id}}" method="POST">
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