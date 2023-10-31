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
        Schema::create('program_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('pamong_id')->nullable();
            $table->foreignId('dpl_id')->nullable();
            $table->string('nama_kegiatan')->nullable();
            $table->string('rencana_kegiatan')->nullable();
            $table->string('laporan_umum')->nullable();
            $table->string('laporan_akhir')->nullable();
            $table->text('catatan')->nullable();
            $table->date('waktu_mulai');
            $table->date('waktu_berakhir');
            $table->enum('status',[1,0])->default(0);
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
        Schema::dropIfExists('program_kegiatans');
    }
};
