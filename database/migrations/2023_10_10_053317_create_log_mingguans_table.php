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
        Schema::create('log_mingguans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
        $table->foreignId('user_id');
            $table->dateTime('waktu');
            $table->text('deskripsi');
            $table->string('rencana_kegiatan');
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
        Schema::dropIfExists('log_mingguans');
    }
};
