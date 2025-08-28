<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembelian_details', function (Blueprint $table) {
            $table->id();
            $table->string('id_pembelian');   // FK ke pembelians.id_pembelian
            $table->string('id_brg');         // FK ke barangs.id_brg
            $table->string('id_merk');        // FK ke barangs.id_merk
            $table->string('id_jenis');       // FK ke barangs.id_jenis
            $table->integer('hrg_beli');
            $table->integer('qty');
            $table->timestamps();

            // Foreign key
            $table->foreign('id_pembelian')->references('id_pembelian')->on('pembelians')->onDelete('cascade');
            $table->foreign('id_brg')->references('id_brg')->on('barangs')->onDelete('cascade');
            $table->foreign('id_merk')->references('id_merk')->on('barangs')->onDelete('cascade');
            $table->foreign('id_jenis')->references('id_jenis')->on('barangs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembelian_details');
    }
};
