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
            $table->bigIncrements('id_report');
            
            $table->string('id_jenis');
            $table->string('id_merk');
            $table->string('id_brg');

            $table->string('jenis_brg');
            $table->string('nm_merk');
            $table->string('nm_brg');

            $table->decimal('hrg_beli', 15, 2);
            $table->decimal('hrg_jual', 15, 2);
            $table->integer('qty');
            $table->decimal('jumlah', 15, 2);

            $table->decimal('modal', 15, 2)->nullable();
            $table->decimal('laba', 15, 2)->nullable();
            $table->decimal('zakat', 15, 2)->nullable();
            $table->decimal('laba_bersih', 15, 2)->nullable();

            $table->timestamps();

            // (Opsional) jika foreign key-nya ingin dihubungkan
            $table->foreign('id_brg')->references('id_brg')->on('barangs')->onDelete('cascade');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis_barangs')->onDelete('cascade');
            $table->foreign('id_merk')->references('id_merk')->on('merks')->onDelete('cascade');
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
