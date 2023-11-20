<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('judul');
            $table->string('sub_judul');
            $table->text('deskripsi_full');
        
            $table->string('sk_rektor')->nullable();
            $table->string('surat_pernyataan')->nullable();
            $table->string('petunjuk')->nullable();
            $table->string('format_rancangan')->nullable();
            $table->string('format_laporan_akhir')->nullable();
            $table->string('format_laporan_mata_kuliah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaturans');
    }
};
