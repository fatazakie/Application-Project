<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->string('id_penjualan')->primary();
            $table->date('tgl_penjualan');
            
            // Kalau ada pelanggan / user
            // $table->unsignedBigInteger('id_pelanggan')->nullable();
            // $table->foreign('id_pelanggan')->references('id')->on('pelanggans');

            $table->decimal('total', 15, 2)->default(0); // total transaksi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
