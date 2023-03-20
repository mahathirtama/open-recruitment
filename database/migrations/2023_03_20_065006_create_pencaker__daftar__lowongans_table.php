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
        Schema::create('pencaker__daftar__lowongans', function (Blueprint $table) {
            $table->id();
              $table->foreignId('id_pencaker')->references('id')->on('pencakers');
            $table->foreignId('id_lowongan')->references('id')->on('lowongans');
             $table->text('lamaran');
             $table->string('cv');
             $table->string('status_lamaran');
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
        Schema::dropIfExists('pencaker__daftar__lowongans');
    }
};
