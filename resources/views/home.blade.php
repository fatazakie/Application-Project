@extends('layouts.master')

@section('title','Halaman Dashboard')
@section('heading','Halaman Dashboard')

{{-- @section('bc')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
@endsection --}}



@section('content')
    <div class="card">
        <div class="card-header">
        {{-- <h3 class="card-title">Title</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
            </button>
        </div> --}}
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Total Barang -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalBarang }}</h3>
                            <p>Total Barang</p>
                        </div>
                        <a href="/barang" class="small-box-footer">Lihat Barang<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            
                <!-- Total Penjualan -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalPenjualan }}</h3>
                            <p>Total Penjualan Bulan Ini</p>
                        </div>
                        <a href="/penjualan" class="small-box-footer">Lihat Penjualan <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            
                <!-- Total Pembelian -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $totalPembelian }}</h3>
                            <p>Total Pembelian Bulan Ini</p>
                        </div>
                        <a href="/pembelian" class="small-box-footer">Lihat Pembelian <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            
                <!-- Total Hutang -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $totalHutang }}</h3>
                            <p>Total Hutang</p>
                        </div>
                        <a href="/hutang" class="small-box-footer">Lihat Hutang <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
            
        <div class="card-body">
            <div class="row">
                <!-- Grafik Penjualan per Bulan -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">Grafik Penjualan per Bulan</div>
                        <div class="card-body">
                            <canvas id="penjualanChart"></canvas>
                        </div>
                    </div>
                </div>
            
                
                <!-- Grafik Stok Menipis -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-danger text-white">Barang dengan Stok < 10</div>
                        <div class="card-body">
                            <canvas id="stokChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
        <!-- /.card-body -->

    </div>
@endsection
<script>
    window.onload = function () {
        // Grafik Penjualan per Bulan
        const ctxPenjualan = document.getElementById('penjualanChart').getContext('2d');
        new Chart(ctxPenjualan, {
            type: 'bar',
            data: {
                labels: {!! json_encode($bulanLabels) !!},
                datasets: [{
                    label: 'Penjualan',
                    data: {!! json_encode($penjualanData) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                            callback: function(value) {
                                return Number.isInteger(value) ? value : null;
                            }
                        }
                    }]
                }
            }
        });

        // Grafik Stok Menipis
        const ctxStok = document.getElementById('stokChart').getContext('2d');
        new Chart(ctxStok, {
            type: 'bar',
            data: {
                labels: {!! json_encode($stokLabels) !!},
                datasets: [{
                    label: 'Stok',
                    data: {!! json_encode($stokData) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.7)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                            callback: function(value) {
                                return Number.isInteger(value) ? value : null;
                            }
                        }
                    }]
                }
            }
        });
    };
</script>
