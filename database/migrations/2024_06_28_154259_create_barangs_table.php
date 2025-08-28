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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('id_brg')->unique();
            $table->string('id_merk')->index();
            $table->string('id_jenis')->index();            
            $table->string('nm_brg');
            $table->string('nm_merk');
            $table->string('jenis_brg');
            $table->integer('hrg_beli')->nullable();
            $table->integer('hrg_jual')->nullable();
            $table->integer('qty'); // Mengubah dari string ke integer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
