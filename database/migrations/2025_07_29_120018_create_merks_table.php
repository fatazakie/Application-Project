<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hutangs', function (Blueprint $table) {
            $table->id();
            $table->string('id_hutang')->unique();
            $table->date('tgl_hutang');
            $table->string('id_merk');
            $table->string('id_jenis');
            $table->string('id_brg');
            $table->integer('jumlah_hutang');
        
            // Relasi
            $table->foreign('id_merk')->references('id_merk')->on('merks')->onDelete('cascade');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis_barangs')->onDelete('cascade');
            $table->foreign('id_brg')->references('id_brg')->on('barangs')->onDelete('cascade');
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merks');
    }
};
