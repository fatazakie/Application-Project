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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->bigInteger('barangs_id');
            $table->string('merk');
            $table->string('nama');
            $table->string('beli');
            $table->string('modal');
            $table->string('jual');
            $table->string('qty');
            $table->string('total');
            $table->string('hutang');
            $table->string('laba');
            $table->string('zakat');
            $table->string('laba_bersih');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
