<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penjualan_details', function (Blueprint $table) {
            $table->id(); // primary key auto increment
            $table->string('id_penjualan'); // relasi ke penjualans
            $table->string('id_brg');
            $table->string('id_merk');
            $table->string('id_jenis');
            $table->integer('qty');
            $table->integer('hrg_jual');
            $table->timestamps();

            // relasi ke tabel penjualans
            $table->foreign('id_penjualan')
                  ->references('id_penjualan')
                  ->on('penjualans')
                  ->onDelete('cascade');

            // relasi ke tabel barangs
            $table->foreign('id_brg')
                  ->references('id_brg')
                  ->on('barangs')
                  ->onDelete('cascade');

            // relasi ke tabel merks
            $table->foreign('id_merk')
                  ->references('id_merk')
                  ->on('merks')
                  ->onDelete('cascade');

            // relasi ke tabel jenis
            $table->foreign('id_jenis')
                  ->references('id_jenis')
                  ->on('jenis_barangs')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penjualan_details');
    }
};
