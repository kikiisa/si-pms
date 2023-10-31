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
        Schema::create('dpls', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('username');
            $table->string('name');
            $table->string('email');
            $table->enum('roles',['dpl','mk']);
            $table->string('password');
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
        Schema::dropIfExists('dpls');
    }
};
